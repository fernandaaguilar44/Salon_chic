<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log; // Importa la fachada Log para depuración

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

    // --- INICIO: Nuevo método para la búsqueda de proveedores para el auto-completado ---
    public function buscarProveedores(Request $request)
    {
        $query = $request->input('query'); // El término de búsqueda del JavaScript

        // Opcional: Para depuración, puedes registrar la consulta
        // Log::info('API de búsqueda de proveedores - Query recibida: ' . $query);

        if (empty($query)) {
            return response()->json([]); // Si no hay query, devuelve un array vacío
        }

        $proveedores = Proveedor::where('nombre_empresa', 'like', '%' . $query . '%')
            ->orWhere('nombre_proveedor', 'like', '%' . $query . '%') // También puedes buscar por nombre de contacto si lo deseas
            ->select('id', 'nombre_empresa') // Selecciona solo los campos que necesitas en el frontend
            ->limit(10) // Limita el número de resultados para mejor rendimiento
            ->get();

        // Opcional: Para depuración, puedes registrar los resultados
        // Log::info('API de búsqueda de proveedores - Resultados encontrados: ' . $proveedores->toJson());

        return response()->json($proveedores);
    }
    // --- FIN: Nuevo método ---

    public function create()
    {
        $empresas = Proveedor::select('nombre_empresa')
            ->distinct()
            ->orderBy('nombre_empresa')
            ->pluck('nombre_empresa');

        return view('proveedores.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => ['required', 'string', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'telefono' => [
                'required',
                'digits:8',
                'regex:/^(?!([0-9])\1{7})([389])[0-9]{7}$/',
                'unique:proveedores,telefono',
            ],
            'direccion' => 'required|string|max:200',
            'ciudad' => ['required', 'string', 'max:35', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'nombre_empresa' => ['required', 'string', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'telefono_empleado_encargado' => [
                'required',
                'digits:8',
                'regex:/^(?!([0-9])\1{7})([389])[0-9]{7}$/',
                'unique:proveedores,telefono_empleado_encargado',
            ],
            'imagen' => 'required|image|max:2048',
        ], [
            'nombre_proveedor.required' => 'Por favor, agregue el nombre del vendedor.',
            'nombre_proveedor.regex' => 'El nombre del vendedor solo puede contener letras y espacios.',
            'nombre_proveedor.max' => 'El nombre del vendedor no debe exceder los 50 caracteres.',

            'telefono.required' => 'Por favor, agregue el número de teléfono del vendedor.',
            'telefono.digits' => 'El número de teléfono debe contener exactamente 8 dígitos.',
            'telefono.regex' => 'El número de teléfono debe comenzar con 3, 8 o 9.',
            'telefono.unique' => 'El número de teléfono ingresado ya está registrado.',

            'direccion.required' => 'Por favor, agregue la dirección de la empresa.',
            'direccion.max' => 'La dirección no debe exceder los 200 caracteres.',

            'ciudad.required' => 'Por favor, agregue la ciudad correspondiente.',
            'ciudad.regex' => 'La ciudad solo puede contener letras y espacios.',
            'ciudad.max' => 'El nombre de la ciudad no debe exceder los 25 caracteres.',

            'nombre_empresa.required' => 'Por favor, agregue el nombre de la empresa.',
            'nombre_empresa.regex' => 'El nombre de la empresa solo puede contener letras y espacios.',
            'nombre_empresa.max' => 'El nombre de la empresa no debe exceder los 50 caracteres.',

            'telefono_empleado_encargado.required' => 'Por favor, agregue el teléfono de la empresa.',
            'telefono_empleado_encargado.digits' => 'El número de teléfono debe contener exactamente 8 dígitos.',
            'telefono_empleado_encargado.regex' => 'El número de teléfono debe comenzar con 3, 8 o 9.',
            'telefono_empleado_encargado.unique' => 'El número de teléfono de la empresa ya está registrado.',

            'imagen.required' => 'Por favor, agregue una imagen del proveedor.',
            'imagen.image' => 'El archivo debe ser una imagen válida.',
            'imagen.max' => 'La imagen no debe exceder los 2MB de tamaño.',
        ]);

        if (!$request->hasFile('imagen') || !$request->file('imagen')->isValid()) {
            return back()->withErrors(['imagen' => 'Por favor, adjunte una imagen válida.'])->withInput();
        }

        $imagenPath = $request->file('imagen')->store('proveedores', 'public');

        Proveedor::create([
            'nombre_proveedor' => $request->nombre_proveedor,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'nombre_empresa' => $request->nombre_empresa,
            'telefono_empleado_encargado' => $request->telefono_empleado_encargado,
            'imagen' => $imagenPath,
        ]);
        return redirect()->route('facturas.create')->with('success', 'El proveedor ha sido registrado correctamente. Ahora puede registrar una factura.');

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
            'nombre_proveedor' => ['required', 'string', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'telefono' => [
                'required',
                'digits:8',
                'regex:/^(?!([0-9])\1{7})([389])[0-9]{7}$/',
                Rule::unique('proveedores', 'telefono')->ignore($proveedor->id),
            ],
            'direccion' => 'required|string|max:200',
            'ciudad' => ['required', 'string', 'max:35', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'nombre_empresa' => ['required', 'string', 'max:50', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
            'telefono_empleado_encargado' => [
                'required',
                'digits:8',
                'regex:/^(?!([0-9])\1{7})([389])[0-9]{7}$/',
                Rule::unique('proveedores', 'telefono_empleado_encargado')->ignore($proveedor->id),
            ],
            'imagen' => 'nullable|image|max:2048',
        ], [
            'nombre_proveedor.required' => 'Por favor, proporcione el nombre del vendedor.',
            'telefono.required' => 'Por favor, proporcione el número de teléfono del vendedor.',
            'direccion.required' => 'Por favor, proporcione la dirección de la empresa.',
            'ciudad.required' => 'Por favor, indique la ciudad correspondiente.',
            'nombre_empresa.required' => 'Por favor, proporcione el nombre de la empresa.',
            'telefono_empleado_encargado.required' => 'Por favor, indique el teléfono de la empresa.',
            'imagen.image' => 'El archivo debe ser una imagen válida.',
            'imagen.max' => 'La imagen no debe exceder los 2MB de tamaño.',
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
            'telefono_empleado_encargado' => $request->telefono_empleado_encargado,
            'imagen' => $proveedor->imagen,
        ]);

        return redirect()->route('proveedores.index')->with('success', 'El proveedor ha sido actualizado correctamente.');
    }
}
