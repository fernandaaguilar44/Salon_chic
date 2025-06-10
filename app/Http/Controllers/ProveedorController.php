<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $query = Proveedor::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre_proveedor', 'like', "%{$search}%")
                    ->orWhere('nombre_empresa', 'like', "%{$search}%");
            });
        }

        $allowedSorts = ['nombre_proveedor', 'nombre_empresa', 'created_at'];
        $sort = $request->input('sort');
        $direction = $request->input('direction') === 'desc' ? 'desc' : 'asc';

        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $proveedores = $query->paginate(10)->appends($request->query());

        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string|max:35',
            'telefono' => ['required', 'digits:8', 'regex:/^(?!([0-9])\1{7})[0-9]{8}$/'],
            'direccion' => 'required|string|max:100',
            'ciudad' => 'required|string|max:25|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'nombre_empresa' => 'required|string|max:25',
            'empleado_encargado' => 'required|string|max:35',
            'telefono_empleado_encargado' => ['required', 'digits:8', 'regex:/^(?!([0-9])\1{7})[0-9]{8}$/'],
            'fecha_registro' => 'required|date|before_or_equal:today',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $datos = $request->all();

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('proveedores', 'public');
            $datos['imagen'] = $imagenPath;
        }

        Proveedor::create($datos);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }

    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string|max:35',
            'telefono' => ['required', 'digits:8', 'regex:/^(?!([0-9])\1{7})[0-9]{8}$/'],
            'direccion' => 'required|string|max:100',
            'ciudad' => 'required|string|max:25|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'nombre_empresa' => 'required|string|max:25',
            'empleado_encargado' => 'required|string|max:35',
            'telefono_empleado_encargado' => ['required', 'digits:8', 'regex:/^(?!([0-9])\1{7})[0-9]{8}$/'],
            'fecha_registro' => 'required|date|before_or_equal:today',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($proveedor->imagen && Storage::disk('public')->exists($proveedor->imagen)) {
                Storage::disk('public')->delete($proveedor->imagen);
            }

            $imagenPath = $request->file('imagen')->store('proveedores', 'public');
            $proveedor->imagen = $imagenPath;
        }

        $proveedor->update([
            'nombre_proveedor' => $request->nombre_proveedor,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'nombre_empresa' => $request->nombre_empresa,
            'empleado_encargado' => $request->empleado_encargado,
            'telefono_empleado_encargado' => $request->telefono_empleado_encargado,
            'fecha_registro' => $request->fecha_registro,
            'imagen' => $proveedor->imagen,
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }
}
