<?php

namespace App\Http\Controllers;

use App\Models\DetalleFacturaVenta;
use App\Models\FacturaVenta;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class FacturaVentaController extends Controller
{
    public function index(Request $request)
    {
        // Carga las facturas con la relación cliente
        $query = FacturaVenta::with('cliente')->orderBy('fecha', 'desc');

        // Filtro por nombre de cliente
        if ($request->filled('cliente')) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('nombre_empresa', 'like', '%' . $request->cliente . '%');
            });
        }

        // Filtro por rango de fechas
        if ($request->filled('fecha_rango')) {
            $dateRange = explode(' to ', $request->fecha_rango);
            if (count($dateRange) === 2) {
                $fechaInicio = $dateRange[0];
                $fechaFin = $dateRange[1];
                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            }
        }

        $ventas = $query->get();
        $totalResultados = $ventas->count();

        return view('facturaventa.index', compact('ventas', 'totalResultados'));
    }


    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();

        // Generar número de factura único con formato 000-001-01-0-XXXXXXX
        $prefijo = '000-001-01-0-';
        $parteUnica = '';
        for ($i = 0; $i < 7; $i++) {
            $parteUnica .= mt_rand(0, 9);
        }
        $numeroFactura = $prefijo . $parteUnica;

        return view('facturaventa.create', compact('clientes', 'productos', 'numeroFactura'));
    }
    public function show($id)
    {
        // Buscar la venta con cliente y detalles de productos
        $venta = FacturaVenta::with(['cliente', 'detalles.producto'])->findOrFail($id);

        // Enviar la venta a la vista show
        return view('facturaventa.show', compact('venta'));
    }



    public function search(Request $request)
    {
        $query = $request->query('query');
        $clientes = Cliente::where('nombre', 'like', "%{$query}%")->get();
        return response()->json($clientes);
    }

    public function store(Request $request)
    {
        // Decodificar el JSON que viene en "items"
        $items = json_decode($request->input('items'), true);

        if (!$items || !is_array($items)) {
            return back()->withErrors('Debe agregar al menos un producto válido.')->withInput();
        }

        // Reemplazar en el request para que la validación funcione
        $request->merge(['items' => $items]);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0.01',
            'items.*.tipo_impuesto' => 'required|string|in:exento,exonerado,gravado15',
        ], [
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists' => 'El cliente seleccionado no es válido.',
            'items.required' => 'Debe agregar al menos un producto a la venta.',
            'items.array' => 'Los productos de la venta deben estar en un formato válido.',
            'items.min' => 'Debe agregar al menos un producto a la venta.',
            'items.*.producto_id.required' => 'El producto es obligatorio.',
            'items.*.producto_id.exists' => 'El producto seleccionado no es válido.',
            'items.*.cantidad.required' => 'La cantidad del producto es obligatoria.',
            'items.*.cantidad.numeric' => 'La cantidad debe ser un número.',
            'items.*.cantidad.min' => 'La cantidad debe ser al menos :min.',
            'items.*.precio_unitario.required' => 'El precio unitario es obligatorio.',
            'items.*.precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'items.*.precio_unitario.min' => 'El precio unitario debe ser al menos :min.',
            'items.*.tipo_impuesto.required' => 'El tipo de impuesto es obligatorio.',
            'items.*.tipo_impuesto.in' => 'El tipo de impuesto seleccionado no es válido.',
        ]);

        try {
            DB::transaction(function () use ($request, &$numeroFactura) {
                // Generar número de factura único
                $prefijo = '000-001-01-0-';
                do {
                    $parteUnica = '';
                    for ($i = 0; $i < 7; $i++) {
                        $parteUnica .= mt_rand(0, 9);
                    }
                    $numeroFactura = $prefijo . $parteUnica;
                } while (FacturaVenta::where('numero_factura', $numeroFactura)->exists());

                // Calcular importes
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

                // Crear la venta
                $venta = FacturaVenta::create([
                    'numero_factura' => $numeroFactura,
                    'fecha' => $request->fecha ?? Carbon::now(),
                    'cliente_id' => $request->cliente_id,
                    'importe_exonerado' => $importeExonerado,
                    'importe_exento' => $importeExento,
                    'importe_gravado_15' => $importeGravado15,
                    'isv_15' => $isv15,
                    'total' => $total,
                    'notas' => $request->notas,
                ]);

                // Registrar detalles usando el modelo correcto
                foreach ($request->items as $item) {
                    $producto = Producto::whereKey($item['producto_id'])->lockForUpdate()->first();
                    $subtotal = $item['cantidad'] * $item['precio_unitario'];

                    $venta->detalles()->create([ // <-- detalles() debe estar en FacturaVenta
                        'producto_id' => $item['producto_id'],
                        'nombre_producto_manual' => $producto->nombre,
                        'tipo_impuesto' => $item['tipo_impuesto'],
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $item['precio_unitario'],
                        'subtotal' => $subtotal,
                    ]);

                    $producto->decrement('stock', $item['cantidad']);

                    if ($producto->stock < 0) {
                        throw new \Exception('Stock insuficiente para el producto: ' . $producto->nombre);
                    }
                }
            });

            return redirect()->route('facturaventa.index')->with('success', 'Venta registrada y stock actualizado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al registrar la venta: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al registrar la venta: ' . $e->getMessage())->withInput();
        }
    }

    public function checkUniqueNumeroFactura(Request $request)
    {
        $numeroFactura = $request->query('numero_factura');
        $ventaExists = FacturaVenta::where('numero_factura', $numeroFactura)->exists();
        return response()->json([
            'is_unique' => !$ventaExists
        ]);
    }
}
