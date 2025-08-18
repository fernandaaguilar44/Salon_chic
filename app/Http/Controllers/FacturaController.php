<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class FacturaController extends Controller
{
    public function index(Request $request)
    {
        $query = Factura::with('proveedor')->orderBy('fecha', 'desc');

        if ($request->filled('proveedor')) {
            $query->whereHas('proveedor', function ($q) use ($request) {
                $q->where('nombre_empresa', 'like', '%' . $request->proveedor . '%');
            });
        }

        if ($request->filled('fecha_rango')) {
            $dateRange = explode(' to ', $request->fecha_rango);
            if (count($dateRange) === 2) {
                $fechaInicio = $dateRange[0];
                $fechaFin = $dateRange[1];
                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            }
        }

        $facturas = $query->get();
        $totalResultados = $facturas->count();

        return view('facturas.index', compact('facturas', 'totalResultados'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('facturas.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        // Las validaciones son correctas y completas para todos los campos.
        $request->validate([
            'numero_factura' => 'required|string|max:50|unique:facturas,numero_factura',
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
            'notas' => 'nullable|string|max:200',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio_compra' => 'required|numeric|min:0.01',
            'items.*.precio_venta' => 'required|numeric|min:0.01',
            'items.*.tipo_impuesto' => 'required|string|in:exento,exonerado,gravado15',
        ], [
            'numero_factura.required' => 'El número de factura es obligatorio.',
            'numero_factura.max' => 'El número de factura no puede tener más de 50 caracteres.',
            'numero_factura.unique' => 'El número de factura ya ha sido registrado.',
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
            'fecha.required' => 'La fecha de la factura es obligatoria.',
            'fecha.date' => 'La fecha de la factura debe ser una fecha válida.',
            'notas.max' => 'Las notas no pueden exceder los 200 caracteres.',
            'items.required' => 'Debe agregar al menos un producto a la factura.',
            'items.array' => 'Los productos de la factura deben estar en un formato válido.',
            'items.min' => 'Debe agregar al menos un producto a la factura.',
            'items.*.producto_id.required' => 'El producto es obligatorio.',
            'items.*.producto_id.exists' => 'El producto seleccionado no es válido.',
            'items.*.cantidad.required' => 'La cantidad del producto es obligatoria.',
            'items.*.cantidad.numeric' => 'La cantidad debe ser un número.',
            'items.*.cantidad.min' => 'La cantidad debe ser al menos :min.',
            'items.*.precio_compra.required' => 'El precio de compra es obligatorio.',
            'items.*.precio_compra.numeric' => 'El precio de compra debe ser un número.',
            'items.*.precio_compra.min' => 'El precio de compra debe ser al menos :min.',
            'items.*.precio_venta.required' => 'El precio de venta es obligatorio.',
            'items.*.precio_venta.numeric' => 'El precio de venta debe ser un número.',
            'items.*.precio_venta.min' => 'El precio de venta debe ser al menos :min.',
            'items.*.tipo_impuesto.required' => 'El tipo de impuesto es obligatorio.',
            'items.*.tipo_impuesto.in' => 'El tipo de impuesto seleccionado no es válido.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $importeExonerado = 0;
                $importeExento = 0;
                $importeGravado15 = 0;

                foreach ($request->items as $item) {
                    // Se usa 'precio_compra' para los cálculos del subtotal de la factura de compra
                    $subtotal = $item['cantidad'] * $item['precio_compra'];
                    if ($item['tipo_impuesto'] === 'exonerado') {
                        $importeExonerado += $subtotal;
                    } elseif ($item['tipo_impuesto'] === 'exento') {
                        $importeExento += $subtotal;
                    } elseif ($item['tipo_impuesto'] === 'gravado15') {
                        $importeGravado15 += $subtotal;
                    }
                }

                $isv15 = $importeGravado15 * 0.15;
                $total = $importeExonerado + $importeExento + $importeGravado15 + $isv15;

                // Crear factura
                $factura = Factura::create([
                    'numero_factura' => $request->numero_factura,
                    'fecha' => $request->fecha, // Se usa la fecha del request que ahora es validada
                    'proveedor_id' => $request->proveedor_id,
                    'importe_exonerado' => $importeExonerado,
                    'importe_exento' => $importeExento,
                    'importe_gravado_15' => $importeGravado15,
                    'isv_15' => $isv15,
                    'total' => $total,
                    'notas' => $request->notas, // Se guarda el campo de notas
                ]);

                // Crear detalles y actualizar stock
                foreach ($request->items as $item) {
                    $producto = Producto::whereKey($item['producto_id'])->lockForUpdate()->first();
                    // El subtotal del detalle se calcula con el precio de compra del item
                    $subtotal = $item['cantidad'] * $item['precio_compra'];

                    $factura->detalles()->create([
                        'producto_id' => $item['producto_id'],
                        'nombre_producto' => $producto->nombre,
                        'tipo_impuesto' => $item['tipo_impuesto'],
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $item['precio_compra'], // Guardar el precio de compra como precio_unitario en el detalle
                        'subtotal' => $subtotal,
                    ]);

                    // --- La línea clave que faltaba para guardar los precios en el maestro de productos ---
                    // Actualiza el precio de compra y el precio de venta en la tabla de productos.
                    $producto->update([
                        'precio_compra' => $item['precio_compra'],
                        'precio_venta' => $item['precio_venta']
                    ]);
                    // --- Fin de la línea clave ---

                    // Actualizar stock (sumar cantidad de compra)
                    $producto->increment('stock', $item['cantidad']);
                }
            });

            return redirect()->route('facturas.index')->with('success', 'Factura registrada y stock actualizado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al registrar la factura: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al registrar la factura: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Factura $factura)
    {
        $factura->load('proveedor', 'detalles.producto');

        return view('facturas.show', [
            'factura' => $factura,
            'importeExento' => $factura->importe_exento,
            'importeExonerado' => $factura->importe_exonerado,
            'importeGravado15' => $factura->importe_gravado_15,
            'isv15' => $factura->isv_15,
            'total' => $factura->total,
        ]);
    }

    public function checkUniqueNumeroFactura(Request $request)
    {
        $numeroFactura = $request->query('numero_factura');

        $facturaExists = Factura::where('numero_factura', $numeroFactura)->exists();

        return response()->json([
            'is_unique' => !$facturaExists
        ]);
    }
}
