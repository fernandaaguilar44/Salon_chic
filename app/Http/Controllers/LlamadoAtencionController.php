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
        $empleadoSeleccionado = null;

        if ($empleado_id) {
            $empleadoSeleccionado = Empleado::find($empleado_id);
        }

        return view('llamados.create', ['empleado' => $empleadoSeleccionado]);

    }


    public function historial($id)
    {
        $empleado = Empleado::with('llamados')->findOrFail($id);
        return view('llamados.historial', compact('empleado'));
    }

    public function store(Request $request)
    {
        // Definir fechas para validación
        $hoy = Carbon::today();
        $haceDosSemanas = $hoy->copy()->subDays(14);

        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'motivo' => ['required', 'string', 'max:70', 'regex:/^[\pL0-9\s,.\-#]+$/u'],
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

        // Obtener empleado y contar sus llamados actuales
        $empleado = Empleado::findOrFail($request->empleado_id);
        $totalLlamados = LlamadoAtencion::where('empleado_id', $empleado->id)->count() + 1;

        // Definir la acción disciplinaria
        $accion = ($totalLlamados >= 3) ? 'despido' : 'advertencia';
        if ($totalLlamados == 3) {
            if ($totalLlamados == 1) {
                $accion = 'advertencia';
            } elseif ($totalLlamados == 2) {
                $accion = 'suspensión';
            } else {
                $accion = 'despido';
            }

        }

        // Registrar el llamado de atención
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
