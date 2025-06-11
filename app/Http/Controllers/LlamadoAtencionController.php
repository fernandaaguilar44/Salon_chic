<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LlamadoAtencion;
use App\Models\Empleado;
use Carbon\Carbon;

class LlamadoAtencionController extends Controller
{
    public function create()
    {
        $empleados = Empleado::all();
        return view('llamados.create', compact('empleados'));
    }

    public function historial($id)
    {
        $empleado = Empleado::with('llamados')->findOrFail($id);
        return view('llamados.historial', compact('empleado'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'motivo' => ['required', 'string', 'max:40', 'regex:/^[\pL0-9\s,.\-#]+$/u'],
        ]);

        $empleado = Empleado::findOrFail($request->empleado_id);

        LlamadoAtencion::create([
            'empleado_id' => $empleado->id,
            'motivo' => trim($request->motivo),
            'fecha' => Carbon::now()->toDateString(), // Establece la fecha actual
        ]);

        return redirect()->route('llamados.historial', $empleado->id)
            ->with('success', 'Llamado de atención registrado exitosamente.');



    }
}

