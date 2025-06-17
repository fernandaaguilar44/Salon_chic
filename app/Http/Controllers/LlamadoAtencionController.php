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

        return view('llamados.create', ['empleado' => $empleadoSeleccionado]);
    }

    public function historial($id)
    {
        $empleado = Empleado::with('llamados')->findOrFail($id);
        return view('llamados.historial', compact('empleado'));
    }

    public function store(Request $request)
    {
        $hoy = Carbon::today();
        $haceDosSemanas = $hoy->copy()->subDays(14);

        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'motivo' => [
                'required',
                'string',
                'max:70',
                'regex:/^[\pL0-9\s,.\-#]+$/u'
            ],
            'fecha' => [
                'required',
                'date',
                'after_or_equal:' . $haceDosSemanas->toDateString(),
                'before_or_equal:' . $hoy->toDateString(),
            ],
        ], [
            'fecha.after_or_equal' => 'La fecha no puede ser anterior a dos semanas atrás.',
            'fecha.before_or_equal' => 'La fecha no puede ser futura.',
            'motivo.regex' => 'El motivo solo puede contener letras, números, espacios y ,.-#',
        ]);

        $empleado = Empleado::findOrFail($request->empleado_id);
        $totalLlamados = LlamadoAtencion::where('empleado_id', $empleado->id)->count() + 1;

        // Definir la acción disciplinaria
        if ($totalLlamados === 1) {
            $accion = 'advertencia';
        } elseif ($totalLlamados === 2) {
            $accion = 'suspensión';
        } else {
            $accion = 'despido';
        }

        LlamadoAtencion::create([
            'empleado_id' => $empleado->id,
            'motivo' => trim($request->motivo),
            'fecha' => $request->fecha,
            'accion' => $accion,
            'total_llamados' => $totalLlamados,
        ]);

        return redirect()->route('llamados.historial', $empleado->id)
            ->with('success', 'Llamado de atención registrado exitosamente.');
    }
}