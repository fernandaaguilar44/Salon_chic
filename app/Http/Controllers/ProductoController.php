<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $productos = Producto::orderBy('nombre')->paginate(8);
        $categoriasDisponibles = Producto::select('categoria')->distinct()->pluck('categoria');
        $todos = Producto::all(); // Agregado para la búsqueda completa en JS

        // Si la petición es AJAX (por paginación con JS), devuelve solo la tabla
        if ($request->ajax()) {
            return view('productos.partials.tabla', compact('productos'))->render();
        }

        // Vista completa si no es AJAX
        return view('productos.index', compact('productos', 'categoriasDisponibles', 'todos'));
    }


    public function buscar(Request $request)
    {
        $buscar = $request->buscar;
        $categoria = $request->categoria;

        // Total general sin filtros (todos los servicios)
        $totalGeneral = Producto::count();

        $query = Producto::query();

        if ($buscar) {
            // Buscar por nombre o código con OR
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('codigo', 'LIKE', '%' . $buscar . '%');
            });
        }
        if ($categoria) {
            $query->where('categoria', $categoria);
        }

        $totalFiltrado = $query->count();

        $productos = $query->orderBy('nombre')->paginate(8);

        return response()->json([
            'tabla' => view('productos.partials.tabla', compact('productos'))->render(),
            'totalFiltrado' => $totalFiltrado,
            'totalGeneral' => $totalGeneral,
        ]);
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('productos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'categoria' => ['required', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'marca' => ['required', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'codigo' => [
                'required',
                'max:9',
                'regex:/^[A-Z0-9\-]+$/',
                'unique:productos,codigo',
            ],
            'descripcion' => 'required|max:200',
            'imagen' => 'nullable|image|max:2048',
        ], [
            'codigo.required' => 'El código del producto es obligatorio.',
            'codigo.max' => 'El código no puede tener más de 9 caracteres.',
            'codigo.regex' => 'El código solo puede contener letras mayúsculas, números y guion (-).',
            'codigo.unique' => 'El código ya está en uso, por favor elige otro.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'categoria.regex' => 'La categoría solo puede contener letras y espacios.',
            'marca.regex' => 'La marca solo puede contener letras y espacios.',
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
            'nombre' => 'required|string|max:50|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'categoria' => 'required|string|max:50|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'marca' => 'required|string|max:50|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'codigo' => [
                'required',
                'max:9',
                'regex:/^[A-Z0-9\-]+$/',
                'unique:productos,codigo,' . $producto->id,
                [
                    'codigo.required' => 'El código del producto es obligatorio.',
                    'codigo.max' => 'El código no puede tener más de 9 caracteres.',
                    'codigo.regex' => 'El código solo puede contener letras mayúsculas, números y guion (-).',
                    'codigo.unique' => 'El código ya está en uso, por favor elige otro.',
                    'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
                    'categoria.regex' => 'La categoría solo puede contener letras y espacios.',
                    'marca.regex' => 'La marca solo puede contener letras y espacios.',]
            ]
        ]);

        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->marca = $request->marca;
        $producto->codigo = $request->codigo;
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
