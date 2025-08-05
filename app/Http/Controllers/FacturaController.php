<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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
        $request->validate([
            'numero_factura' => 'required|string|max:50|unique:facturas,numero_factura',
            'proveedor_id' => 'required|exists:proveedores,id',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0.01',
            'items.*.tipo_impuesto' => 'required|string|in:exento,exonerado,gravado15',
        ], [
            'numero_factura.required' => 'El número de factura es obligatorio.',
            'numero_factura.max' => 'El número de factura no puede tener más de 50 caracteres.',
            'numero_factura.unique' => 'El número de factura ya ha sido registrado.',
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
            'items.required' => 'Debe agregar al menos un producto a la factura.',
            'items.array' => 'Los productos de la factura deben estar en un formato válido.',
            'items.min' => 'Debe agregar al menos un producto a la factura.',
            'items.*.producto_id.required' => 'El producto es obligatorio.',
            'items.*.producto_id.exists' => 'El producto seleccionado no es válido.',
            'items.*.cantidad.required' => 'La cantidad del producto es obligatoria.',
            'items.*.cantidad.numeric' => 'La cantidad debe ser un número.',
            'items.*.cantidad.min' => 'La cantidad debe ser al menos :min.',
            'items.*.precio_unitario.required' => 'El precio unitario es obligatorio.',
            'items.*.precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'items.*.precio_unitario.min' => 'El precio unitario debe ser al menos :min.',
            'items.*.tipo_impuesto.required' => 'El tipo de impuesto es obligatorio.',
            'items.*.tipo_impuesto.string' => 'El tipo de impuesto debe ser una cadena de texto.',
            'items.*.tipo_impuesto.in' => 'El tipo de impuesto seleccionado no es válido.',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $importeExonerado = 0;
                $importeExento = 0;
                $importeGravado15 = 0;

                foreach ($request->items as $item) {
                    $subtotal = $item['cantidad'] * $item['precio_unitario'];
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

                $factura = Factura::create([
                    'numero_factura' => $request->numero_factura,
                    'fecha' => $request->fecha ?? Carbon::now(),
                    'proveedor_id' => $request->proveedor_id,
                    'importe_exonerado' => $importeExonerado,
                    'importe_exento' => $importeExento,
                    'importe_gravado_15' => $importeGravado15,
                    'isv_15' => $isv15,
                    'total' => $total,
                ]);

                foreach ($request->items as $item) {
                    // CORRECCIÓN: Obtener el nombre del producto de la base de datos es más seguro.
                    $producto = Producto::find($item['producto_id']);
                    $subtotal = $item['cantidad'] * $item['precio_unitario'];

                    $factura->detalles()->create([
                        'producto_id' => $item['producto_id'],
                        'nombre_producto' => $producto->nombre,
                        'tipo_impuesto' => $item['tipo_impuesto'],
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $item['precio_unitario'],
                        'subtotal' => $subtotal,
                    ]);
                }
            });

            return redirect()->route('facturas.index')->with('success', 'Factura registrada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al registrar la factura: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al registrar la factura.')->withInput();
        }
    }

    public function show(Factura $factura)
    {
        $factura->load('proveedor', 'detalles.producto');
        $importeExento = $factura->importe_exento;
        $importeExonerado = $factura->importe_exonerado;
        $importeGravado15 = $factura->importe_gravado_15;
        $importeGravado18 = 0;
        $isv15 = $factura->isv_15;
        $isv18 = 0;
        $total = $factura->total;

        return view('facturas.show', compact(
            'factura',
            'importeExento',
            'importeExonerado',
            'importeGravado15',
            'importeGravado18',
            'isv15',
            'isv18',
            'total'
        ));
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
