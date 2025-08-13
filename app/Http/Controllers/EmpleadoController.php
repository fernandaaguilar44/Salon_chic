<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\LlamadoAtencion;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    private $municipiosPorDepto = [
        '01' => 18,
        '02' => 28,
        '03' => 21,
        '04' => 16,
        '05' => 23,
        '06' => 16,
        '07' => 19,
        '08' => 28,
        '09' => 16,
        '10' => 28,
        '11' => 12,
        '12' => 28,
        '13' => 28,
        '14' => 23,
        '15' => 28,
        '16' => 28,
        '17' => 28,
        '18' => 28,
    ];

    public function show($id)
    {
        $empleado = Empleado::with(['llamados'])->findOrFail($id);
        return view('empleados.show')->with('empleado', $empleado);
    }

    private function getValidacionIdentidad()
    {
        return function ($attribute, $value, $fail) {
            $value = preg_replace('/[\s-]/', '', $value);
            if (!preg_match('/^\d{13}$/', $value)) {
                return $fail('El número de identidad debe contener exactamente 13 dígitos numéricos.');
            }
            $departamento = substr($value, 0, 2);
            $municipio = intval(substr($value, 2, 2));
            $anioNumerico = intval(substr($value, 4, 4));
            $correlativo = substr($value, 8, 5);

            if (!array_key_exists($departamento, $this->municipiosPorDepto)) {
                return $fail('El código de departamento no es válido.');
            }
            if ($municipio < 1 || $municipio > $this->municipiosPorDepto[$departamento]) {
                return $fail('El código de municipio no es válido para el departamento especificado.');
            }
            $anioActual = intval(date('Y'));
            $anioMinimoPermitido = $anioActual - 21;
            if ($anioNumerico == 0 || $anioNumerico < 1900 || $anioNumerico > $anioMinimoPermitido) {
                return $fail('Debe tener al menos 21 años para poder registrarse. Año de nacimiento no válido.');
            }
            if (preg_match('/^(.)\1{12}$/', $value)) {
                return $fail('La identidad no puede tener todos los números repetidos.');
            }
            if ($correlativo === '00000') {
                return $fail('El correlativo de la identidad no puede ser 00000.');
            }
        };
    }

    public function update(Request $request, $id)
    {
        $modificarEmpleado = Empleado::findOrFail($id);
        $rules = [
            'nombre_empleado' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'numero_identidad' => [
                'required', 'digits:13',
                Rule::unique('empleados', 'numero_identidad')->ignore($modificarEmpleado->id),
                $this->getValidacionIdentidad()
            ],
            'telefono' => [
                'required', 'regex:/^[2389]\d{7}$/', 'not_regex:/^0+$/', 'not_regex:/^(\d)\1{7}$/',
                Rule::unique('empleados', 'telefono')->ignore($modificarEmpleado->id)
            ],
            'correo' => [
                'required', 'email', 'max:50', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                Rule::unique('empleados', 'correo')->ignore($modificarEmpleado->id)
            ],
            'salario' => ['required', 'integer','min:500' , 'max:999999'],
            'contacto_emergencia_nombre' => ['required', 'string',  'max:50', 'regex:/^[\pL\s]+$/u'],
            'contacto_emergencia' => [
                'required', 'regex:/^[2389]\d{7}$/', 'not_regex:/^0+$/', 'not_regex:/^(\d)\1{7}$/'
            ],
            'cargo' => ['required', Rule::in(['manicurista', 'estilista'])],
            'fecha_ingreso' => ['required', 'after_or_equal:' . now()->subMonth()->toDateString(), 'before_or_equal:today'],
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
            'telefono.regex' => 'El teléfono debe comenzar con 2, 3, 8 o 9 y contener 8 dígitos en total.',
            'telefono.not_regex' => 'El teléfono no puede ser solo ceros ni números repetidos.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',
            'correo.required' => 'Debe ingresar un correo electrónico.',
            'correo.email' => 'El correo electrónico debe tener un formato válido.',
            'correo.max' => 'El correo no puede superar los 50 caracteres.',
            'correo.regex' => 'El correo electrónico tiene un formato inválido.',
            'correo.unique' => 'El correo electrónico ya está registrado.',
            'salario.required' => 'Debe ingresar el salario del empleado.',
            'salario.integer' => 'El salario debe ser un número entero.',
            'salario.min' => 'El salario debe ser al menos 500.',
            'salario.max' => 'El salario no puede ser mayor a 999,999.',
            'contacto_emergencia_nombre.required' => 'Debe ingresar el nombre del contacto de emergencia.',
            'contacto_emergencia_nombre.string' => 'El nombre del contacto debe ser texto válido.',
            'contacto_emergencia_nombre.max' => 'El nombre del contacto no puede exceder 50 caracteres.',
            'contacto_emergencia_nombre.regex' => 'El nombre del contacto solo puede contener letras y espacios.',
            'contacto_emergencia.required' => 'Debe ingresar un número de contacto de emergencia.',
            'contacto_emergencia.regex' => 'El contacto de emergencia debe comenzar con 2, 3, 8 o 9 y contener 8 dígitos.',
            'contacto_emergencia.not_regex' => 'El contacto de emergencia no puede ser solo ceros ni números repetidos.',
            'cargo.required' => 'Debe seleccionar un cargo para el empleado.',
            'cargo.in' => 'El cargo seleccionado no es válido.',
            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso.',
            'fecha_ingreso.after_or_equal' => 'La fecha de ingreso debe ser como mínimo 1 mes antes del día actual.',
            'fecha_ingreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',
            'estado.required' => 'Debe seleccionar el estado del empleado.',
            'estado.in' => 'El estado seleccionado no es válido.',
            'direccion.required' => 'Debe ingresar la dirección.',
            'direccion.string' => 'La dirección debe ser texto válido.',
            'direccion.max' => 'La dirección no puede exceder 200 caracteres.',
            'direccion.regex' => 'La dirección contiene caracteres inválidos.',
        ];
        $request->validate($rules, $messages);
        $modificarEmpleado->update($request->all());
        return redirect()->route('empleados.index')->with('mensaje', 'El empleado ha sido modificado exitosamente.');
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
        $empleados = Empleado::orderBy('nombre_empleado')->paginate(8);

        if ($request->ajax()) {
            return response()->json([
                'tabla' => view('empleados.partials.tabla', compact('empleados'))->render(),
                'totalFiltrado' => $empleados->total(),
                'totalGeneral' => Empleado::count(),
            ]);
        }
        return view('empleados.index', compact('empleados'));
    }

    public function buscar(Request $request)
    {
        $buscar = $request->buscar;
        $estado = $request->estado;
        $totalGeneral = Empleado::count();
        $query = Empleado::query();

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre_empleado', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('cargo', 'LIKE', '%' . $buscar . '%');
            });
        }
        if ($estado) {
            $query->where('estado', $estado);
        }

        $empleados = $query->orderBy('nombre_empleado')->paginate(8);
        $totalFiltrado = $empleados->total();

        return response()->json([
            'tabla' => view('empleados.partials.tabla', compact('empleados'))->render(),
            'totalFiltrado' => $totalFiltrado,
            'totalGeneral' => $totalGeneral,
        ]);
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre_empleado' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'numero_identidad' => [
                'required', 'digits:13', 'unique:empleados,numero_identidad',
                $this->getValidacionIdentidad()
            ],
            'telefono' => [
                'required', 'regex:/^[2389]\d{7}$/', 'not_regex:/^0+$/',
                'not_regex:/^(\d)\1{7}$/', 'unique:empleados,telefono'
            ],
            'salario' => ['required', 'integer','min:500' , 'max:999999'],
            'contacto_emergencia_nombre' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'contacto_emergencia' => [
                'required', 'regex:/^[2389]\d{7}$/', 'not_regex:/^0+$/',
                'not_regex:/^(\d)\1{7}$/'
            ],
            'cargo' => ['required', Rule::in(['manicurista', 'estilista'])],
            'correo' => [
                'required', 'email', 'max:50', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:empleados,correo'
            ],
            'estado' => ['required', Rule::in(['activo', 'inactivo'])],
            'fecha_ingreso' => [
                'required', 'date', 'after_or_equal:' . now()->subMonth()->toDateString(),
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
            'numero_identidad.unique' => 'El número de identidad ya está registrado en el sistema.',
            'numero_identidad.regex' => 'El número de identidad debe contener exactamente 13 dígitos numéricos.',
            'numero_identidad.custom' => 'La identidad no cumple con la validación requerida.',
            'telefono.required' => 'Debe ingresar un número de teléfono.',
            'telefono.regex' => 'El teléfono debe comenzar con 2, 3, 8 o 9 y contener 8 dígitos en total.',
            'telefono.not_regex' => 'El teléfono no puede ser solo ceros ni números repetidos.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',
            'correo.required' => 'Debe ingresar un correo electrónico.',
            'correo.email' => 'El correo electrónico debe tener un formato válido.',
            'correo.max' => 'El correo no puede superar los 50 caracteres.',
            'correo.regex' => 'El correo electrónico tiene un formato inválido.',
            'correo.unique' => 'El correo electrónico ya está registrado.',
            'salario.required' => 'Debe ingresar el salario del empleado.',
            'salario.integer' => 'El salario debe ser un número entero.',
            'salario.min' => 'El salario debe ser al menos 500.',
            'salario.max' => 'El salario no puede ser mayor a 999,999.',
            'contacto_emergencia_nombre.required' => 'Debe ingresar el nombre del contacto de emergencia.',
            'contacto_emergencia_nombre.string' => 'El nombre del contacto debe ser texto válido.',
            'contacto_emergencia_nombre.max' => 'El nombre del contacto no puede exceder 50 caracteres.',
            'contacto_emergencia_nombre.regex' => 'El nombre del contacto solo puede contener letras y espacios.',
            'contacto_emergencia.required' => 'Debe ingresar un número de contacto de emergencia.',
            'contacto_emergencia.regex' => 'El contacto de emergencia debe comenzar con 2, 3, 8 o 9 y contener 8 dígitos.',
            'contacto_emergencia.not_regex' => 'El contacto de emergencia no puede ser solo ceros ni números repetidos.',
            'cargo.required' => 'Debe seleccionar un cargo para el empleado.',
            'cargo.in' => 'El cargo seleccionado no es válido.',
            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso.',
            'fecha_ingreso.after_or_equal' => 'La fecha de ingreso debe ser como mínimo 1 mes antes del día actual.',
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
        return redirect()->route('empleados.index')->with('mensaje', 'Empleado agregado correctamente.');
    }
}