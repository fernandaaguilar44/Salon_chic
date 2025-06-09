<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        // Iniciar la consulta base
        $query = Proveedor::query();

        // Filtro de búsqueda por nombre o empresa
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre_proveedor', 'like', "%{$search}%")
                    ->orWhere('nombre_empresa', 'like', "%{$search}%");
            });
        }

        // Ordenamiento dinámico por columnas permitidas
        $allowedSorts = ['nombre_proveedor', 'nombre_empresa', 'created_at'];
        $sort = $request->input('sort');
        $direction = $request->input('direction') === 'desc' ? 'desc' : 'asc';

        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Paginación
        $proveedores = $query->paginate(10)->appends($request->query());

        // Retornar la vista con los datos
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string|max:255',
            'telefono' => 'required|digits:8',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'nombre_empresa' => 'required|string|max:255',
            'empleado_encargado' => 'required|string|max:255',
            'telefono_empleado_encargado' => 'required|digits:8',
            'fecha_registro' => 'required|date',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $datos = $request->all();

        // Guardar imagen usando storage (disco 'public')
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('proveedores', 'public');
            $datos['imagen'] = $imagenPath; // Ej: 'proveedores/imagen.jpg'
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
            'nombre_proveedor' => 'required|string|max:255',
            'telefono' => 'required|digits:8',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:50',
            'nombre_empresa' => 'required|string|max:255',
            'empleado_encargado' => 'required|string|max:255',
            'telefono_empleado_encargado' => 'required|digits:8',
            'fecha_registro' => 'required|date',
            'imagen' => 'nullable|image|max:2048',
        ]);

        // Si se subió una nueva imagen
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($proveedor->imagen && Storage::disk('public')->exists($proveedor->imagen)) {
                Storage::disk('public')->delete($proveedor->imagen);
            }

            // Guardar la nueva imagen
            $imagenPath = $request->file('imagen')->store('proveedores', 'public');
            $proveedor->imagen = $imagenPath;
        }

        // Actualizar los demás campos
        $proveedor->update([
            'nombre_proveedor' => $request->nombre_proveedor,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'nombre_empresa' => $request->nombre_empresa,
            'empleado_encargado' => $request->empleado_encargado,
            'telefono_empleado_encargado' => $request->telefono_empleado_encargado,
            'fecha_registro' => $request->fecha_registro,
            'imagen' => $proveedor->imagen, // Se actualiza solo si hubo nueva
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }
}
