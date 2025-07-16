<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// app/Http/Controllers/FacturaController.php
class FacturaController extends Controller
{
    public function index(Request $request)
    {
        $proveedor = $request->input('proveedor');
        $mes = $request->input('mes');
        $anio = $request->input('anio');

        $query = Factura::with(['productos', 'proveedor']);

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

        // Clonamos el query antes de paginar para contar resultados si hay filtros
        $totalResultados = null;
        if ($proveedor || $mes || $anio) {
            $totalResultados = $query->count();
        }

        $facturas = $query->orderBy('fecha', 'desc')->paginate(10);

        // Calcular importes por cada factura
        foreach ($facturas as $factura) {
            $importeExonerado = 0;
            $importeExento = 0;
            $importeGravado = 0;

            foreach ($factura->productos as $producto) {
                $subtotal = $producto->pivot->subtotal ?? ($producto->pivot->cantidad * $producto->pivot->precio_unitario);

                switch ($producto->tipo) {
                    case 'exonerado':
                        $importeExonerado += $subtotal;
                        break;
                    case 'exento':
                        $importeExento += $subtotal;
                        break;
                    default:
                        $importeGravado += $subtotal;
                        break;
                }
            }

            $isv = $importeGravado * 0.15;
            $totalConISV = $importeExonerado + $importeExento + $importeGravado + $isv;

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
        $proveedores = Proveedor::all();   // O el modelo que uses para proveedores
        $productos = Producto::all();      // O el modelo para productos

        return view('facturas.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request) {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'numero_factura' => 'required|unique:facturas|max:20',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'producto.*' => 'required|string|max:100',
            'cantidad.*' => 'required|integer|min:1',
            'precio_unitario.*' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $factura = Factura::create($request->only(['proveedor_id', 'numero_factura', 'fecha', 'total', 'notas']));

            foreach ($request->producto as $index => $producto) {
                DetalleFactura::create([
                    'factura_id' => $factura->id,
                    'producto' => $producto,
                    'cantidad' => $request->cantidad[$index],
                    'precio_unitario' => $request->precio_unitario[$index],
                    'subtotal' => $request->cantidad[$index] * $request->precio_unitario[$index],
                ]);
            }
        });

        return redirect()->route('facturas.index')->with('success', 'Factura registrada con éxito.');
    }

    public function show(Factura $factura)
    {
        $importeExonerado = 0;
        $importeExento = 0;
        $importeGravado = 0;

        foreach ($factura->productos as $producto) {
            $subtotal = $producto->pivot->subtotal ?? ($producto->pivot->cantidad * $producto->pivot->precio_unitario);

            switch ($producto->tipo) {
                case 'exonerado':
                    $importeExonerado += $subtotal;
                    break;
                case 'exento':
                    $importeExento += $subtotal;
                    break;
                default:
                    $importeGravado += $subtotal;
                    break;
            }
        }

        $isv = $importeGravado * 0.15;
        $totalConISV = $importeExonerado + $importeExento + $importeGravado + $isv;

        return view('facturas.show', compact('factura', 'importeExonerado', 'importeExento', 'importeGravado', 'isv', 'totalConISV'));
    }

}

