<?php

namespace App\Http\Controllers;
use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException; // Importar esto para manejar excepciones
use Illuminate\Support\Facades\Log; // Importar para usar Log::error

class FacturaController extends Controller
{
    public function checkUniqueNumeroFactura(Request $request)
    {
        $numeroFactura = $request->query('numero_factura');

        // Contar cuántas facturas tienen ese número
        $exists = Factura::where('numero_factura', $numeroFactura)->exists();

        // Devolver una respuesta JSON
        return response()->json(['is_unique' => !$exists]);
    }
    public function index(Request $request)
    {
        $proveedor = $request->input('proveedor');
        $mes = $request->input('mes');
        $anio = $request->input('anio');
        $query = Factura::with(['detallesFactura.producto', 'proveedor']);

// Aplicar filtros solo si se reciben

        if ($proveedor) {
            $query->whereHas('proveedor', function ($q) use ($proveedor) {
                $q->where('nombre_proveedor', 'like', '%' . $proveedor . '%');
            });
        }

        if ($mes) {
            $query->whereMonth('fecha', $mes);
        }

        if ($anio) {
            $query->whereYear('fecha', $anio);
        }

        $totalResultados = null;
        if ($proveedor || $mes || $anio) {
            $totalResultados = $query->count();
        }

        $facturas = $query->orderBy('fecha', 'desc')->paginate(10);
        foreach ($facturas as $factura) {
            $importeExonerado = 0;
            $importeExento = 0;
            $importeGravado = 0;

// Iterar sobre los detalles de la factura para obtener el tipo de impuesto
            foreach ($factura->detallesFactura as $detalle) {
                $subtotal = $detalle->subtotal ?? ($detalle->cantidad * $detalle->precio_unitario);
                $tipoImpuesto = $detalle->tipo_impuesto ?? 'gravado15'; // Usar el tipo_impuesto del detalle, con gravado15 como fallback
                switch ($tipoImpuesto) {
                    case 'exonerado':
                        $importeExonerado += $subtotal;
                        break;
                    case 'exento':
                        $importeExento += $subtotal;
                        break;
                    case 'gravado15': // Si el tipo es 'gravado15'
                    default: // Cualquier otro caso por defecto
                        $importeGravado += $subtotal;
                        break;
                }
            }

            $isv = $importeGravado * 0.15;
            $totalConISV = $importeExonerado + $importeExento + $importeGravado + $isv;

// Asignar los valores calculados a la factura para la vista
            $factura->importeExonerado = $importeExonerado;
            $factura->importeExento = $importeExento;
            $factura->importeGravado = $importeGravado;
            $factura->isv = $isv;
            $factura->totalConISV = $totalConISV;
        }

        return view('facturas.index', compact('facturas', 'totalResultados', 'proveedor', 'mes', 'anio'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('facturas.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
// 1. Validaciones
        $validatedData = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'numero_factura' => 'required|string|max:7|regex:/^[A-Z]{3}-\d{3}$/|unique:facturas,numero_factura', // Formato LLL-NNN
            'notas' => 'nullable|string|max:200',
            'importe_exonerado' => 'required|numeric|min:0',
            'importe_exento' => 'required|numeric|min:0',
            'importe_gravado_15' => 'required|numeric|min:0',
            'isv_15' => 'required|numeric|min:0',
            'gran_total' => 'required|numeric|min:0', // El total final de la factura
            'items' => 'required|array|min:1', // Asegura que haya al menos un producto
            'items.*.producto_id' => 'required|integer|exists:productos,id',
            'items.*.nombre_producto' => 'required|string|max:255', // Campo de solo lectura pero útil para validación
            'items.*.tipo_impuesto' => 'required|string|in:gravado15,exento,exonerado', // Nuevo campo de tipo de impuesto
            'items.*.cantidad' => 'required|integer|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0.01',
            'items.*.subtotal' => 'required|numeric|min:0',
        ], [

// Mensajes personalizados para una mejor retroalimentación al usuario
            'numero_factura.unique' => 'El número de factura ya está registrado. Por favor, ingrese uno diferente.',
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
            'numero_factura.required' => 'El número de factura es obligatorio.',
            'numero_factura.regex' => 'El formato del número de factura debe ser LLL-NNN (ej. ABC-123).',
            'importe_exonerado.required' => 'El importe exonerado es obligatorio.',
            'importe_exento.required' => 'El importe exento es obligatorio.',
            'importe_gravado_15.required' => 'El importe gravado es obligatorio.',
            'isv_15.required' => 'El ISV es obligatorio.',
            'gran_total.required' => 'El total de la factura es obligatorio.',
            'items.required' => 'Debe agregar al menos un producto a la factura.',
            'items.min' => 'Debe agregar al menos un producto a la factura.',
            'items.*.producto_id.required' => 'El ID del producto es obligatorio para cada ítem.',
            'items.*.producto_id.exists' => 'Uno de los productos seleccionados no es válido.',
            'items.*.tipo_impuesto.required' => 'El tipo de impuesto es obligatorio para cada producto.',
            'items.*.tipo_impuesto.in' => 'El tipo de impuesto seleccionado para un producto no es válido.',
            'items.*.cantidad.required' => 'La cantidad es obligatoria para cada producto.',
            'items.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'items.*.cantidad.min' => 'La cantidad de un producto debe ser al menos 1.',
            'items.*.precio_unitario.required' => 'El precio unitario es obligatorio para cada producto.',
            'items.*.precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'items.*.precio_unitario.min' => 'El precio unitario de un producto debe ser mayor a 0.',
            'items.*.subtotal.required' => 'El subtotal es obligatorio para cada producto.',
            'items.*.subtotal.numeric' => 'El subtotal debe ser un número.',
        ]);

        try {
            DB::transaction(function () use ($validatedData) {
// Crear la factura
                $factura = Factura::create([
                    'proveedor_id' => $validatedData['proveedor_id'],
                    'numero_factura' => $validatedData['numero_factura'],
                    'fecha' => now(), // Asigna la fecha actual del servidor
                    'total' => $validatedData['gran_total'], // Ahora 'total' en la DB es el 'gran_total' del frontend
                    'importe_exonerado' => $validatedData['importe_exonerado'],
                    'importe_exento' => $validatedData['importe_exento'],
                    'importe_gravado_15' => $validatedData['importe_gravado_15'],
                    'isv_15' => $validatedData['isv_15'],
                    'notas' => $validatedData['notas'] ?? null,
                ]);

// Crear los detalles de factura (productos)
                foreach ($validatedData['items'] as $item) {
                    DetalleFactura::create([
                        'factura_id' => $factura->id,
                        'producto_id' => $item['producto_id'],
                        'nombre_producto_manual' => $item['nombre_producto'] ?? null, // Usamos 'nombre_producto' del frontend
                        'tipo_impuesto' => $item['tipo_impuesto'], // Guardar el tipo de impuesto
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $item['precio_unitario'],
                        'subtotal' => $item['subtotal'],
                    ]);
                }
            });

            return redirect()->route('facturas.index')->with('success', 'Factura registrada con éxito.');
        } catch (ValidationException $e) {

// Si es un error de validación, redirige con los errores específicos

            return redirect()->back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte si cualquier otro error ocurre
            Log::error('Error al registrar factura: ' . $e->getMessage(), ['exception' => $e, 'request_data' => $request->all()]);

// Redirige de vuelta con un mensaje de error genérico
            return redirect()->back()->withInput()->withErrors(['error_general' => 'Hubo un problema al registrar la factura. Por favor, inténtalo de nuevo.']);
        }
    }

    public function show(Factura $factura)
    {
// Asegúrate de cargar los detalles de factura para los cálculos
        $factura->load('detallesFactura.producto');
        $importeExonerado = 0;
        $importeExento = 0;
        $importeGravado = 0;

// Iterar sobre los detalles de la factura para obtener el tipo de impuesto
        foreach ($factura->detallesFactura as $detalle) {
            $subtotal = $detalle->subtotal ?? ($detalle->cantidad * $detalle->precio_unitario);
            $tipoImpuesto = $detalle->tipo_impuesto ?? 'gravado15'; // Usar el tipo_impuesto del detalle, con gravado15 como fallback
            switch ($tipoImpuesto) {
                case 'exonerado':
                    $importeExonerado += $subtotal;
                    break;
                case 'exento':
                    $importeExento += $subtotal;
                    break;
                case 'gravado15': // Si el tipo es 'gravado15'
                default: // Cualquier otro caso por defecto
                    $importeGravado += $subtotal;
                    break;
            }
        }

        $isv = $importeGravado * 0.15;
        $totalConISV = $importeExonerado + $importeExento + $importeGravado + $isv;
        return view('facturas.show', compact('factura', 'importeExonerado', 'importeExento', 'importeGravado', 'isv', 'totalConISV'));
    }
}
