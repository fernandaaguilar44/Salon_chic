<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\LlamadoAtencion;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    public function show($id)
    {
        $empleado = Empleado::with(['llamados'])->findOrFail($id);
        return view('empleados.show')->with('empleado', $empleado);
    }

    public function update(Request $request, $id)
    {
        $modificarEmpleado = Empleado::findOrFail($id);

        $rules = [
            'nombre_empleado' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'numero_identidad' => [
                'required',
                'digits:13',
                'not_regex:/^0+$/',
                Rule::unique('empleados', 'numero_identidad')->ignore($modificarEmpleado->id)
            ],

            'telefono' => [
                'required',
                'regex:/^[23789]\d{7}$/',
                'not_regex:/^0+$/',
                'not_regex:/^(\d)\1{7}$/',
                Rule::unique('empleados', 'telefono')->ignore($modificarEmpleado->id)
            ],
            'correo' => [
                'required',
                'email',
                'max:50',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                Rule::unique('empleados', 'correo')->ignore($modificarEmpleado->id)
            ],
            'salario' => ['required', 'integer', 'between:10000,20000'],
            'contacto_emergencia_nombre' => ['required', 'string',  'max:50', 'regex:/^[\pL\s]+$/u'],
            'contacto_emergencia' => [
                'required',
                'regex:/^[23789]\d{7}$/',
                'not_regex:/^0+$/',
                'not_regex:/^(\d)\1{7}$/'
            ],
            'cargo' => ['required', Rule::in(['manicurista', 'estilista'])],
            'fecha_ingreso' => ['required', 'before_or_equal:today'],
            'estado' => ['required', Rule::in(['activo', 'inactivo'])],
            'direccion' => ['required', 'string', 'max:200', 'regex:/^[\pL0-9\s.,#\-]+$/u']
        ];

        $messages = [
            'nombre_empleado.required' => 'Debe ingresar el nombre del empleado.',
            'nombre_empleado.string' => 'El nombre del empleado debe ser texto válido.',
            'nombre_empleado.max' => 'El nombre del empleado no puede exceder 50 caracteres.',
            'nombre_empleado.regex' => 'El nombre solo puede contener letras y espacios.',

            'numero_identidad.required' => 'El número de identidad es obligatorio.',
            'numero_identidad.digits' => 'El número de identidad debe contener exactamente 13 dígitos.',
            'numero_identidad.not_regex' => 'El número de identidad no puede ser solo ceros.',
            'numero_identidad.regex' => 'El número de identidad no tiene un formato válido.',
            'numero_identidad.unique' => 'El número de identidad ya está registrado en el sistema.',

            'telefono.required' => 'Debe ingresar un número de teléfono.',
            'telefono.regex' => 'El teléfono debe comenzar con 2, 3, 7, 8 o 9 y contener 8 dígitos en total.',
            'telefono.not_regex' => 'El teléfono no puede ser solo ceros ni números repetidos.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',

            'correo.required' => 'Debe ingresar un correo electrónico.',
            'correo.email' => 'El correo electrónico debe tener un formato válido.',
            'correo.max' => 'El correo no puede superar los 50 caracteres.',
            'correo.regex' => 'El correo electrónico tiene un formato inválido.',
            'correo.unique' => 'El correo electrónico ya está registrado.',

            'salario.required' => 'Debe ingresar el salario del empleado.',
            'salario.integer' => 'El salario debe ser un número entero.',
            'salario.between' => 'El salario debe estar entre 10,000 y 20,000.',

            'contacto_emergencia_nombre.required' => 'Debe ingresar el nombre del contacto de emergencia.',
            'contacto_emergencia_nombre.string' => 'El nombre del contacto debe ser texto válido.',
            'contacto_emergencia_nombre.max' => 'El nombre del contacto no puede exceder 50 caracteres.',
            'contacto_emergencia_nombre.regex' => 'El nombre del contacto solo puede contener letras y espacios.',

            'contacto_emergencia.required' => 'Debe ingresar un número de contacto de emergencia.',
            'contacto_emergencia.regex' => 'El contacto de emergencia debe comenzar con 2, 3, 7, 8 o 9 y contener 8 dígitos.',
            'contacto_emergencia.not_regex' => 'El contacto de emergencia no puede ser solo ceros ni números repetidos.',

            'cargo.required' => 'Debe seleccionar un cargo para el empleado.',
            'cargo.in' => 'El cargo seleccionado no es válido.',

            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso.',
            'fecha_ingreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',

            'estado.required' => 'Debe seleccionar el estado del empleado.',
            'estado.in' => 'El estado seleccionado no es válido.',

            'direccion.required' => 'Debe ingresar la dirección.',
            'direccion.string' => 'La dirección debe ser texto válido.',
            'direccion.max' => 'La dirección no puede exceder 200 caracteres.',
            'direccion.regex' => 'La dirección contiene caracteres inválidos.',
        ];

        $request->validate($rules, $messages);

        // Actualizar campos
        $modificarEmpleado->nombre_empleado = $request->input('nombre_empleado');
        $modificarEmpleado->numero_identidad = $request->input('numero_identidad');
        $modificarEmpleado->telefono = $request->input('telefono');
        $modificarEmpleado->correo = $request->input('correo');
        $modificarEmpleado->salario = $request->input('salario');
        $modificarEmpleado->contacto_emergencia_nombre = $request->input('contacto_emergencia_nombre');
        $modificarEmpleado->contacto_emergencia = $request->input('contacto_emergencia');
        $modificarEmpleado->cargo = $request->input('cargo');
        $modificarEmpleado->fecha_ingreso = $request->input('fecha_ingreso');
        $modificarEmpleado->estado = $request->input('estado');
        $modificarEmpleado->direccion = $request->input('direccion');

        $actualizar = $modificarEmpleado->save();

        if ($actualizar) {
            return redirect()->route('empleados.index')
                ->with('mensaje', 'El empleado ha sido modificado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al actualizar el empleado.');
        }
    }

    public function deshabilitar($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->estado = 'inactivo';
        $empleado->save();

        return redirect()->route('empleados.index')->with('success', 'Empleado deshabilitado correctamente.');
    }

    public function edit($id)
    {
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return redirect()->route('empleados.index')->with('error', 'Empleado no encontrado.');
        }
        return view('empleados.edit', compact('empleado'));
    }

    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $empleados = Empleado::when($buscar, function ($query, $buscar) {
            return $query->where('nombre_empleado', 'like', "%$buscar%")
                ->orWhere('cargo', 'like', "%$buscar%");
        })->orderBy('fecha_ingreso', 'desc')->paginate(10);

        return view('empleados.index', compact('empleados'));
    }

    public function buscar(Request $request)
    {
        $buscar = $request->buscar;
        $estado = $request->estado;

        $empleados = Empleado::query()
            ->when($buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('nombre_empleado', 'like', "%$buscar%")
                        ->orWhere('cargo', 'like', "%$buscar%");
                });
            })
            ->when($estado, function ($query, $estado) {
                $query->where('estado', $estado);
            })
            ->orderBy('fecha_ingreso', 'desc')
            ->paginate(10);

        return view('empleados.partials.tabla', compact('empleados'))->render();
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre_empleado' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'numero_identidad' => 'required|digits:13|unique:empleados,numero_identidad',
            'telefono' => [
                'required',
                'regex:/^[23789]\d{7}$/',
                'not_regex:/^0+$/',
                'not_regex:/^(\d)\1{7}$/',
                'unique:empleados,telefono'
            ],
            'salario' => ['required', 'integer', 'between:10000,20000'],
            'contacto_emergencia_nombre' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'contacto_emergencia' => [
                'required',
                'regex:/^[23789]\d{7}$/',
                'not_regex:/^0+$/',
                'not_regex:/^(\d)\1{7}$/'
            ],
            'cargo' => ['required', Rule::in(['manicurista', 'estilista'])],
            'correo' => [
                'required',
                'email',
                'max:50',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:empleados,correo'
            ],
            'estado' => ['required', Rule::in(['activo', 'inactivo'])],
            'fecha_ingreso' => [
                'required',
                'date',
                'after_or_equal:' . now()->subDays(14)->toDateString(),
                'before_or_equal:today'
            ],
            'direccion' => ['required', 'string', 'max:200', 'regex:/^[\pL0-9\s.,#\-]+$/u'],
        ];

        $messages = [
            'nombre_empleado.required' => 'Debe ingresar el nombre del empleado.',
            'nombre_empleado.string' => 'El nombre del empleado debe ser texto válido.',
            'nombre_empleado.max' => 'El nombre del empleado no puede exceder 50 caracteres.',
            'nombre_empleado.regex' => 'El nombre solo puede contener letras y espacios.',

            'numero_identidad.required' => 'El número de identidad es obligatorio.',
            'numero_identidad.digits' => 'El número de identidad debe contener exactamente 13 dígitos.',
            'numero_identidad.not_regex' => 'El número de identidad no puede ser solo ceros.',
            'numero_identidad.regex' => 'El número de identidad no tiene un formato válido.',
            'numero_identidad.unique' => 'El número de identidad ya está registrado en el sistema.',

            'telefono.required' => 'Debe ingresar un número de teléfono.',
            'telefono.regex' => 'El teléfono debe comenzar con 2, 3, 7, 8 o 9 y contener 8 dígitos en total.',
            'telefono.not_regex' => 'El teléfono no puede ser solo ceros ni números repetidos.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',

            'correo.required' => 'Debe ingresar un correo electrónico.',
            'correo.email' => 'El correo electrónico debe tener un formato válido.',
            'correo.max' => 'El correo no puede superar los 50 caracteres.',
            'correo.regex' => 'El correo electrónico tiene un formato inválido.',
            'correo.unique' => 'El correo electrónico ya está registrado.',

            'salario.required' => 'Debe ingresar el salario del empleado.',
            'salario.integer' => 'El salario debe ser un número entero.',
            'salario.between' => 'El salario debe estar entre 10,000 y 20,000.',

            'contacto_emergencia_nombre.required' => 'Debe ingresar el nombre del contacto de emergencia.',
            'contacto_emergencia_nombre.string' => 'El nombre del contacto debe ser texto válido.',
            'contacto_emergencia_nombre.max' => 'El nombre del contacto no puede exceder 50 caracteres.',
            'contacto_emergencia_nombre.regex' => 'El nombre del contacto solo puede contener letras y espacios.',

            'contacto_emergencia.required' => 'Debe ingresar un número de contacto de emergencia.',
            'contacto_emergencia.regex' => 'El contacto de emergencia debe comenzar con 2, 3, 7, 8 o 9 y contener 8 dígitos.',
            'contacto_emergencia.not_regex' => 'El contacto de emergencia no puede ser solo ceros ni números repetidos.',

            'cargo.required' => 'Debe seleccionar un cargo para el empleado.',
            'cargo.in' => 'El cargo seleccionado no es válido.',

            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso.',
            'fecha_ingreso.after_or_equal' => 'La fecha de ingreso debe ser como mínimo 14 días antes del día actual.',
            'fecha_ingreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',

            'estado.required' => 'Debe seleccionar el estado del empleado.',
            'estado.in' => 'El estado seleccionado no es válido.',

            'direccion.required' => 'Debe ingresar la dirección.',
            'direccion.string' => 'La dirección debe ser texto válido.',
            'direccion.max' => 'La dirección no puede exceder 200 caracteres.',
            'direccion.regex' => 'La dirección contiene caracteres inválidos.',
        ];

        $request->validate($rules, $messages);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado agregado correctamente.');
    }
}