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
        $request->validate([
            'nombre_empleado' => ['required', 'string', 'min:10', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'telefono' => ['required','regex:/^[23789]\d{7}$/', 'not_regex:/^0+$/', 'not_regex:/^(\d)\1{7}$/'],
            'direccion' => ['required', 'string', 'max:50','regex:/^[\pL0-9\s.,#\-]+$/u'],
            'salario' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'contacto_emergencia' => ['required','regex:/^[23789]\d{7}$/', 'not_regex:/^0+$/', 'not_regex:/^(\d)\1{7}$/'],
            'cargo' =>['required', Rule::in(['manicurista', 'estilista'])],
            'fecha_ingreso' => ['required', 'before_or_equal:today'],
            'estado' => ['required', Rule::in(['activo', 'inactivo'])],
        ]);

        $modificarEmpleado = Empleado::findOrFail($id);
        // Formulario
        $modificarEmpleado->nombre_empleado = $request->input('nombre_empleado');
        $modificarEmpleado->telefono = $request->input('telefono');
        $modificarEmpleado->direccion = $request->input('direccion');
        $modificarEmpleado->salario = $request->input('salario');
        $modificarEmpleado->contacto_emergencia = $request->input('contacto_emergencia');
        $modificarEmpleado->cargo = $request->input('cargo');
        $modificarEmpleado->fecha_ingreso = $request->input('fecha_ingreso');
        $modificarEmpleado->estado = $request->input('estado');


        $actualizar = $modificarEmpleado->save();

        if ($actualizar) {
            return redirect()->route('empleados.index')
                ->with('mensaje', 'El empleado ha sido modificado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al actualizar el empleado.');
        }

    }

    public function desactivar($id)
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

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_empleado' => ['required', 'string', 'min:10', 'max:30', 'regex:/^[\pL\s]+$/u'],
            'numero_identidad' => [
                'required',
                'digits:13',
                'unique:empleados,numero_identidad',
                'not_regex:/^0+$/',
            ],
            'telefono' => ['required','regex:/^[23789]\d{7}$/', 'not_regex:/^0+$/', 'not_regex:/^(\d)\1{7}$/'],
            'direccion' => ['required', 'string', 'max:50', 'regex:/^[\pL0-9\s,.\-#]+$/u'],
            'salario' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'contacto_emergencia' => ['required','regex:/^[23789]\d{7}$/', 'not_regex:/^0+$/', 'not_regex:/^(\d)\1{7}$/'],
            'cargo' =>['required', Rule::in(['manicurista', 'estilista'])],
            'correo' => ['required', 'email', 'max:35', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'unique:empleados,correo'],
            'estado' => ['required', Rule::in(['activo', 'inactivo'])],
            'fecha_ingreso' => ['required', 'before_or_equal:today']
        ]);


        $nuevoEmpleado = new Empleado();
        // Formulario
        $nuevoEmpleado->nombre_empleado = $request->input('nombre_empleado');
        $nuevoEmpleado->numero_identidad = $request->input('numero_identidad');
        $nuevoEmpleado->telefono = $request->input('telefono');
        $nuevoEmpleado->direccion = $request->input('direccion');
        $nuevoEmpleado->salario = $request->input('salario');
        $nuevoEmpleado->contacto_emergencia = $request->input('contacto_emergencia');
        $nuevoEmpleado->correo = $request->input('correo');
        $nuevoEmpleado->cargo = $request->input('cargo');
        $nuevoEmpleado->fecha_ingreso = $request->input('fecha_ingreso');


// 👇 Aquí estaba el error: $data no existía aún
        // Solución: asigna 'activo' directamente al objeto
        $nuevoEmpleado->estado = 'activo';

        // Guardar en la base de datos
        $creado = $nuevoEmpleado->save();


        if ($creado) {
            return redirect()->route('empleados.index')
                ->with('mensaje', 'El empleado ha sido creado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al guardar el empleado.');
        }

    }
}
