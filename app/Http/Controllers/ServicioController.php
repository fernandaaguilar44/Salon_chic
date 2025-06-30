<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $servicios = Servicio::orderBy('nombre_servicio')->paginate(8);
        $categoriasDisponibles = Servicio::select('categoria_servicio')->distinct()->pluck('categoria_servicio');

        // Si la petición es AJAX (por paginación con JS), devuelve solo la tabla
        if ($request->ajax()) {
            return view('servicios.partials.tabla', compact('servicios'))->render();
        }

        // Vista completa si no es AJAX
        return view('servicios.index', compact('servicios', 'categoriasDisponibles'));
    }




    public function buscar(Request $request)
    {
        $buscar = $request->buscar;
        $categoria = $request->categoria;
        $estado = $request->estado;

        $query = \App\Models\Servicio::query();

        if ($buscar) {
            $query->where('nombre_servicio', 'LIKE', '%' . $buscar . '%');
        }

        if ($categoria) {
            $query->where('categoria_servicio', $categoria);
        }

        if ($estado) {
            $query->where('estado', $estado);
        }

        $totalFiltrado = $query->count(); // 🔥 Total correcto sin paginación

        $servicios = $query->orderBy('nombre_servicio')->paginate(8);

        // 🔥 Devuelve JSON con el HTML de la tabla y el total filtrado
        return response()->json([
            'tabla' => view('servicios.partials.tabla', compact('servicios'))->render(),
            'totalFiltrado' => $totalFiltrado
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre_servicio' => ['required', 'string', 'max:40', 'min:5', 'regex:/^[\pL\s]+$/u'],
            'descripcion' => ['required', 'string', 'max:200', 'min:10', 'regex:/^[\pL\s]+$/u'],
            'codigo_servicio' => [
                'required',
                'string',
                'max:8',
                'min:5',
                'unique:servicios,codigo_servicio',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*-)[A-Z0-9-]{5,8}$/'
            ],
            'tipo_servicio' => ['required', 'in:cabello,manicure,pedicure'],
            'precio_base' => ['required', 'integer', 'min:30', 'max:9999'], // Cambiado min:1 para evitar cero
            'duracion_estimada' => ['required', 'integer', 'min:5', 'max:240'],


            // 🆕 REGLA NUEVA
            'categoria_servicio' => ['required', 'in:basico,intermedio,avanzado'],




        ];

        $messages = [
            // NOMBRE SERVICIO
            'nombre_servicio.required' => 'El nombre del servicio es obligatorio.',
            'nombre_servicio.string' => 'El nombre del servicio debe ser texto.',
            'nombre_servicio.max' => 'El nombre no debe tener más de 40 caracteres.',
            'nombre_servicio.min' => 'El nombre del servicio debe tener al menos 5 caracteres.',
            'nombre_servicio.regex' => 'El nombre solo puede contener letras y espacios.',

            // DESCRIPCIÓN
            'descripcion.required' => 'La descripción del servicio es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción no puede exceder los 200 caracteres.',
            'descripcion.regex' => 'La descripción solo puede contener letras y espacios, sin números ni símbolos.',


            // CÓDIGO SERVICIO
            'codigo_servicio.required' => 'El código del servicio es obligatorio.',
            'codigo_servicio.string' => 'El código debe ser texto.',
            'codigo_servicio.min' => 'Debe tener al menos 5 caracteres.',
            'codigo_servicio.max' => 'No puede tener más de 8 caracteres.',
            'codigo_servicio.unique' => 'Este código ya está registrado.',
            'codigo_servicio.regex' => 'El código debe contener al menos una letra mayúscula, un número y un guion (ej: CAB-001).',


            // TIPO Y CARGO
            'tipo_servicio.required' => 'Debe seleccionar un tipo de servicio.',
            'tipo_servicio.in' => 'El tipo de servicio no es válido.',


            'precio_base.required' => 'El precio base es obligatorio.',
            'precio_base.integer' => 'El precio base debe ser un número entero.',
            'precio_base.min' => 'El precio base no puede ser menor a L. 30.',
            'precio_base.max' => 'El precio base no puede superar L. 9999.',


            // DURACIÓN
            'duracion_estimada.required' => 'La duración estimada es obligatoria.',
            'duracion_estimada.integer' => 'La duración estimada debe ser un número entero.',
            'duracion_estimada.min' => 'La duración estimada debe ser de al menos 5 minutos.',
            'duracion_estimada.max' => 'La duración estimada no puede superar los 240 minutos.',

            // 🆕 MENSAJES NUEVOS
            'categoria_servicio.required' => 'Debe seleccionar una categoría para el servicio.',
            'categoria_servicio.in' => 'La categoría seleccionada no es válida. Debe ser: Básico, Intermedio o Avanzado.',




        ];



        // Validar datos
        $validated = $request->validate($rules, $messages);

        // Forzar estado a 'activo'
        $validated['estado'] = 'activo';

        // Crear el servicio con datos validados y ajustados
        Servicio::create($validated);

        // Redirigir a la vista index con mensaje
        return redirect()->route('servicios.index')->with('success', 'El servicio se creó exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {

        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        $rules = [
            'nombre_servicio' => ['required', 'string', 'max:40', 'min:5', 'regex:/^[\pL\s]+$/u'],
            'descripcion' => ['required', 'string', 'max:200','min:10', 'regex:/^[\pL\s]+$/u'],
            'codigo_servicio' => [
                'required',
                'string',
                'max:8',
                'min:5',
                Rule::unique('servicios', 'codigo_servicio')->ignore($servicio->id),
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*-)[A-Z0-9-]{5,8}$/'
            ],
            'tipo_servicio' => ['required', 'in:cabello,manicure,pedicure'],
            'precio_base' => ['required', 'integer', 'min:30', 'max:9999'],
            'duracion_estimada' => ['required', 'integer', 'min:5', 'max:240'],
            'categoria_servicio' => 'required|in:basico,intermedio,avanzado',
            'estado' => ['required', 'in:activo,inactivo,temporalmente_suspendido'],
        ];

        $messages = [
            'nombre_servicio.required' => 'El nombre del servicio es obligatorio.',
            'nombre_servicio.string' => 'El nombre del servicio debe ser texto.',
            'nombre_servicio.max' => 'El nombre no debe tener más de 70 caracteres.',
            'nombre_servicio.min' => 'El nombre del servicio debe tener al menos 5 caracteres.',
            'nombre_servicio.regex' => 'El nombre solo puede contener letras y espacios.',

            // DESCRIPCIÓN
            'descripcion.required' => 'La descripción del servicio es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción no puede exceder los 200 caracteres.',
            'descripcion.regex' => 'La descripción solo puede contener letras y espacios, sin números ni símbolos.',


            // CÓDIGO SERVICIO
            'codigo_servicio.required' => 'El código del servicio es obligatorio.',
            'codigo_servicio.string' => 'El código debe ser texto.',
            'codigo_servicio.min' => 'Debe tener al menos 5 caracteres.',
            'codigo_servicio.max' => 'No puede tener más de 8 caracteres.',
            'codigo_servicio.unique' => 'Este código ya está registrado.',
            'codigo_servicio.regex' => 'El código debe contener al menos una letra mayúscula, un número y un guion (ej: CAB-001).',


            'tipo_servicio.required' => 'Debe seleccionar un tipo de servicio.',
            'tipo_servicio.in' => 'El tipo de servicio no es válido.',

            'precio_base.required' => 'El precio base es obligatorio.',
            'precio_base.integer' => 'El precio base debe ser un número entero.',
            'precio_base.min' => 'El precio base no puede ser menor a L. 30.',
            'precio_base.max' => 'El precio base no puede superar L. 9999.',


            // DURACIÓN
            'duracion_estimada.required' => 'La duración estimada es obligatoria.',
            'duracion_estimada.integer' => 'La duración estimada debe ser un número entero.',
            'duracion_estimada.min' => 'La duración estimada debe ser de al menos 5 minutos.',
            'duracion_estimada.max' => 'La duración estimada no puede superar los 240 minutos.',


            'categoria_servicio.required' => 'Debe seleccionar una categoría para el servicio.',
            'categoria_servicio.in' => 'La categoría seleccionada no es válida. Debe ser: Básico, Intermedio o Avanzado.',

            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser activo, inactivo o temporalmente suspendido.',
        ];

        $validated = $request->validate($rules, $messages);

        $servicio->update($validated);

        return redirect()->route('servicios.index')->with('mensaje', 'Servicio actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        //
    }
}
