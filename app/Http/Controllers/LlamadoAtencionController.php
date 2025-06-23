<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LlamadoAtencion;
use App\Models\Empleado;
use Carbon\Carbon;

class LlamadoAtencionController extends Controller
{
    public function create($empleado_id = null)
    {
        $empleados = Empleado::all();
        $empleadoSeleccionado = $empleado_id ? Empleado::find($empleado_id) : null;

        return view('llamados.create', [
            'empleado' => $empleadoSeleccionado,
            'empleados' => $empleados, // Para seleccionar empleados involucrados
        ]);
    }

    public function historial($id)
    {
        $empleado = Empleado::with('llamados')->findOrFail($id);
        return view('llamados.historial', compact('empleado'));
    }

    public function store(Request $request)
    {
        // Obtengo todos los IDs válidos para validación
        $empleadosIds = Empleado::pluck('id')->toArray();

        $rules = [
            'empleado_id' => 'required|exists:empleados,id',

            'motivo' => [
                'required', 'string', 'max:70', 'regex:/^[\pL\s]+$/u'
            ],

            'descripcion' => [
                'required', 'string', 'max:200',
                'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s.,-]*$/'
            ],

            'fecha' => [
                'required', 'date',
                'after_or_equal:' . now()->subMonth()->toDateString(),
                'before_or_equal:' . now()->toDateString()
            ],

            'lugar' => [
                'required', 'string', 'max:100',  'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s.,-]*$/'
            ],

            'sancion' => 'required|in:advertencia verbal,advertencia escrita,suspensión 1 día,suspensión 3 días,descuento salario,despido',

            'testigos' => [
                'required', 'string', 'max:150', 'regex:/^[\pL\s]+$/u'
            ],

            'otros_empleados_involucrados' => ['nullable', 'array'],
            'otros_empleados_involucrados.*' => ['integer', 'in:' . implode(',', $empleadosIds)],
        ];

        $messages = [
            'empleado_id.required' => 'Seleccione un empleado.',
            'empleado_id.exists' => 'El empleado no existe.',

            'motivo.required' => 'Ingrese el motivo.',
            'motivo.string' => 'Motivo inválido.',
            'motivo.max' => 'Máximo 70 caracteres.',
            'motivo.regex' => 'Solo letras y espacios.',

            'descripcion.required' => 'Ingrese la descripción.',
            'descripcion.string' => 'Descripción inválida.',
            'descripcion.max' => 'Máximo 200 caracteres.',
            'descripcion.regex' => 'Solo letras, números y signos básicos (.,-)',

            'fecha.required' => 'Ingrese la fecha.',
            'fecha.date' => 'Fecha no válida.',
            'fecha.after_or_equal' => 'No debe ser anterior a hace 1 mes.',
            'fecha.before_or_equal' => 'No puede ser futura.',

            'lugar.required' => 'Ingrese el lugar.',
            'lugar.string' => 'Lugar inválido.',
            'lugar.max' => 'Máximo 100 caracteres.',
            'lugar.regex' => 'Solo texto y signos básicos (.,-)',

            'sancion.required' => 'Seleccione una sanción.',
            'sancion.in' => 'Sanción no válida.',

            'testigos.required' => 'Ingrese los testigos.',
            'testigos.string' => 'Testigos inválido.',
            'testigos.max' => 'Máximo 150 caracteres.',
            'testigos.regex' => 'Solo texto y signos básicos (.,-)',

            'otros_empleados_involucrados.array' => 'Debe seleccionar empleados válidos.',
            'otros_empleados_involucrados.*.integer' => 'Empleado inválido.',
            'otros_empleados_involucrados.*.in' => 'Empleado no permitido.',
        ];

        $request->validate($rules, $messages);

        $empleado = Empleado::findOrFail($request->empleado_id);

        if ($empleado->estado === 'inactivo') {
            return back()->with('error', 'Este empleado está inactivo y no se pueden registrar más llamados.');
        }

        $totalLlamados = LlamadoAtencion::where('empleado_id', $empleado->id)->count() + 1;

        // Obtener los nombres de los empleados involucrados usando IDs seleccionados
        $involucradosTexto = null;
        if ($request->has('otros_empleados_involucrados')) {
            $nombres = Empleado::whereIn('id', $request->otros_empleados_involucrados)->pluck('nombre_empleado')->toArray();
            $involucradosTexto = implode(', ', $nombres);
        }

        $empleadoDesactivado = false;
        if ($totalLlamados >= 3) {
            $empleado->estado = 'inactivo';
            $empleado->save();
            $empleadoDesactivado = true;
        }

        LlamadoAtencion::create([
            'empleado_id' => $empleado->id,
            'motivo' => $request->motivo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'lugar' => $request->lugar,
            'sancion' => $request->sancion,
            'testigos' => $request->testigos,
            'otros_empleados_involucrados' => $involucradosTexto,
            'numero_llamado' => $totalLlamados,
            'desactivo_empleado' => $empleadoDesactivado,
        ]);

        return redirect()->route('llamados.historial', $empleado->id)
            ->with('success', 'Llamado de atención registrado correctamente.');
    }}