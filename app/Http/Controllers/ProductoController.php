<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('proveedor')->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('productos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'max:100', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'categoria' => ['required', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'marca' => ['required', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'codigo' => 'required|digits_between:1,9|unique:productos,codigo',
            'descripcion' => 'required|max:200',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $producto = new Producto($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|max:2048', // max 2MB
        ]);

        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->marca = $request->marca;
        $producto->descripcion = $request->descripcion;

        // Si hay nueva imagen
        if ($request->hasFile('imagen')) {
            // Opcional: borrar imagen vieja
            if ($producto->imagen && Storage::exists('public/' . $producto->imagen)) {
                Storage::delete('public/' . $producto->imagen);
            }

            $ruta = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $ruta;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

}
