<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class CitaController extends Controller
{
    /**
     * ✅ VALIDACIÓN COMPLETA: Verificar disponibilidad tanto del EMPLEADO como del CLIENTE
     */
    private function getValidacionHorarioDisponible($citaId = null)
    {
        return function ($attribute, $value, $fail) use ($citaId) {
            $request = request();
            $fecha = $request->fecha;
            $empleadoId = $request->empleado_id;
            $clienteId = $request->cliente_id;  // ✅ AGREGADO
            $servicioId = $request->servicio_id;

            if (!$fecha || !$empleadoId || !$clienteId || !$servicioId) {
                return;
            }

            // Obtener duración del servicio
            $servicio = Servicio::find($servicioId);
            if (!$servicio) {
                return $fail('El servicio seleccionado no es válido.');
            }

            try {
                // Manejo robusto de fecha y hora
                $fechaSolo = Carbon::parse($fecha)->format('Y-m-d');
                $horaNormalizada = $this->normalizarHora($value);
                $horaInicio = Carbon::parse($fechaSolo . ' ' . $horaNormalizada);
                $horaFin = $horaInicio->copy()->addMinutes($servicio->duracion_estimada);

                // ✅ 1. VERIFICAR CONFLICTOS DEL EMPLEADO
                $conflictoEmpleado = $this->verificarConflictoHorario(
                    'empleado_id',
                    $empleadoId,
                    $fechaSolo,
                    $horaInicio,
                    $horaFin,
                    $citaId
                );

                if ($conflictoEmpleado) {
                    return $fail("El empleado ya tiene una cita programada de {$conflictoEmpleado['inicio']} a {$conflictoEmpleado['fin']} el mismo día.");
                }

                // ✅ 2. VERIFICAR CONFLICTOS DEL CLIENTE
                $conflictoCliente = $this->verificarConflictoHorario(
                    'cliente_id',
                    $clienteId,
                    $fechaSolo,
                    $horaInicio,
                    $horaFin,
                    $citaId
                );

                if ($conflictoCliente) {
                    $cliente = Cliente::find($clienteId);
                    return $fail("El cliente {$cliente->nombre} ya tiene una cita programada de {$conflictoCliente['inicio']} a {$conflictoCliente['fin']} el mismo día.");
                }

            } catch (\Exception $e) {
                \Log::error('Error en validación de horario: ' . $e->getMessage());
                return $fail('Error al verificar disponibilidad de horario.');
            }
        };
    }

    /**
     * ✅ NUEVA FUNCIÓN: Verificar conflictos de horario (reutilizable para empleado y cliente)
     */
    private function verificarConflictoHorario($campo, $id, $fecha, $horaInicio, $horaFin, $citaIdExcluir = null)
    {
        $citas = Cita::where($campo, $id)
            ->where('fecha', $fecha)
            ->whereIn('estado', ['pendiente', 'en_proceso'])
            ->when($citaIdExcluir, function ($query) use ($citaIdExcluir) {
                return $query->where('id', '!=', $citaIdExcluir);
            })
            ->get();

        foreach ($citas as $cita) {
            try {
                $fechaExistente = Carbon::parse($cita->fecha)->toDateString();
                $horaExistenteLimpia = $this->normalizarHora($cita->hora_inicio);
                $inicioExistente = Carbon::parse($fechaExistente . ' ' . $horaExistenteLimpia);
                $finExistente = $inicioExistente->copy()->addMinutes($cita->duracion_minutos);

                // ✅ VERIFICAR SOLAPAMIENTO COMPLETO
                if ($this->hayConflictoHorario($horaInicio, $horaFin, $inicioExistente, $finExistente)) {
                    return [
                        'inicio' => $inicioExistente->format('H:i'),
                        'fin' => $finExistente->format('H:i')
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('Error procesando cita existente: ' . $e->getMessage());
                // Validación simple como fallback
                if ($cita->hora_inicio === $horaInicio->format('H:i')) {
                    return [
                        'inicio' => $cita->hora_inicio,
                        'fin' => $cita->hora_inicio
                    ];
                }
            }
        }

        return null;
    }

    /**
     * ✅ NUEVA FUNCIÓN: Verificar si hay conflicto entre dos rangos de horario
     */
    private function hayConflictoHorario($inicio1, $fin1, $inicio2, $fin2)
    {
        // Solapamiento: el inicio de uno está antes del fin del otro Y viceversa
        return ($inicio1->lt($fin2) && $fin1->gt($inicio2));
    }

    /**
     * Función auxiliar para normalizar formato de hora
     */
    private function normalizarHora($hora)
    {
        $hora = trim($hora);

        if (strlen($hora) == 1 || strlen($hora) == 2) {
            $hora = str_pad($hora, 2, '0', STR_PAD_LEFT) . ':00';
        }

        if (preg_match('/^\d{1,2}:\d{1}$/', $hora)) {
            $parts = explode(':', $hora);
            $hora = str_pad($parts[0], 2, '0', STR_PAD_LEFT) . ':' . str_pad($parts[1], 2, '0', STR_PAD_LEFT);
        }

        if (preg_match('/^\d{2}:\d{1}$/', $hora)) {
            $parts = explode(':', $hora);
            $hora = $parts[0] . ':' . str_pad($parts[1], 2, '0', STR_PAD_LEFT);
        }

        return $hora;
    }

    /**
     * Validación de horario laboral
     */
    private function getValidacionHorarioLaboral()
    {
        return function ($attribute, $value, $fail) {
            $horariosValidos = [
                '08:00', '09:00', '10:00', '11:00',
                '13:00', '14:00', '15:00', '16:00', '17:00'
            ];

            if (!in_array($value, $horariosValidos)) {
                return $fail('La hora seleccionada no está disponible. Horarios permitidos: 8:00-11:00 AM y 1:00-5:00 PM.');
            }
        };
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $citas = Cita::with(['cliente', 'empleado', 'servicio'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'desc')
            ->paginate(10);

        $estadosDisponibles = ['pendiente', 'en_proceso', 'finalizada', 'cancelada'];
        $servicios = Servicio::where('estado', 'activo')->orderBy('nombre_servicio')->get();

        if ($request->ajax()) {
            return view('citas.partials.tabla', compact('citas'))->render();
        }

        return view('citas.index', compact('citas', 'estadosDisponibles', 'servicios'));
    }

    /**
     * Búsqueda de citas
     */
    public function buscar(Request $request)
    {
        $buscar = $request->buscar;
        $estado = $request->estado;
        $fecha = $request->fecha;
        $servicio_id = $request->servicio_id;

        $totalGeneral = Cita::count();
        $query = Cita::with(['cliente', 'empleado', 'servicio']);

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->whereHas('cliente', function ($clienteQuery) use ($buscar) {
                    $clienteQuery->where('nombre', 'LIKE', '%' . $buscar . '%')
                        ->orWhere('telefono', 'LIKE', '%' . $buscar . '%');
                })
                    ->orWhereHas('empleado', function ($empleadoQuery) use ($buscar) {
                        $empleadoQuery->where('nombre_empleado', 'LIKE', '%' . $buscar . '%');
                    })
                    ->orWhereHas('servicio', function ($servicioQuery) use ($buscar) {
                        $servicioQuery->where('nombre_servicio', 'LIKE', '%' . $buscar . '%');
                    });
            });
        }

        if ($estado) {
            $query->where('estado', $estado);
        }

        if ($fecha) {
            $query->where('fecha', $fecha);
        }

        if ($servicio_id) {
            $query->where('servicio_id', $servicio_id);
        }

        $totalFiltrado = $query->count();
        $citas = $query->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'desc')
            ->paginate(10);

        return response()->json([
            'tabla' => view('citas.partials.tabla', compact('citas'))->render(),
            'totalFiltrado' => $totalFiltrado,
            'totalGeneral' => $totalGeneral,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $empleados = Empleado::where('estado', 'activo')->orderBy('nombre_empleado')->get();
        $servicios = Servicio::where('estado', 'activo')->orderBy('nombre_servicio')->get();

        return view('citas.create', compact('clientes', 'empleados', 'servicios'));
    }

    /**
     * ✅ STORE CORREGIDO: Validaciones completas
     */
    public function store(Request $request)
    {
        // Validación de campos obligatorios y reglas
        $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'empleado_id'  => 'required|exists:empleados,id',
            'servicio_id'  => 'required|exists:servicios,id',
            'fecha'        => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . now()->addMonths(3)->toDateString(),
                function ($attribute, $value, $fail) {
                    $fecha = Carbon::parse($value);

                    if ($fecha->dayOfWeek === 0) {
                        return $fail('No se pueden programar citas los domingos.');
                    }

                    $diasFestivos = [
                        $fecha->year . '-01-01',
                        $fecha->year . '-12-25',
                    ];

                    if (in_array($fecha->format('Y-m-d'), $diasFestivos)) {
                        return $fail('No se pueden programar citas en días festivos.');
                    }
                }
            ],
            'hora_inicio'  => [
                'required',
                'date_format:H:i',
                $this->getValidacionHorarioLaboral(),
                $this->getValidacionHorarioDisponible()  // ✅ Ya incluye validación de cliente Y empleado
            ],
            'observaciones'=> 'nullable|string|max:200',
        ], [
            'cliente_id.required'  => 'Debe seleccionar un cliente.',
            'cliente_id.exists'    => 'El cliente seleccionado no existe.',
            'empleado_id.required' => 'Debe seleccionar un empleado.',
            'empleado_id.exists'   => 'El empleado seleccionado no existe.',
            'servicio_id.required' => 'Debe seleccionar un servicio.',
            'servicio_id.exists'   => 'El servicio seleccionado no existe.',
            'fecha.required'       => 'La fecha de la cita es obligatoria.',
            'fecha.date'           => 'Ingrese una fecha válida.',
            'fecha.after_or_equal' => 'No se pueden programar citas en fechas pasadas.',
            'fecha.before_or_equal' => 'No se pueden programar citas con más de 3 meses de anticipación.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'La hora debe tener el formato HH:MM.',
            'observaciones.string' => 'Las observaciones deben ser texto válido.',
            'observaciones.max'    => 'Las observaciones no pueden exceder 200 caracteres.',
        ]);

        // Obtener información del servicio
        $servicio = Servicio::findOrFail($request->servicio_id);
        $fechaSolo = Carbon::parse($request->fecha)->format('Y-m-d');
        $horaSolo = $this->normalizarHora($request->hora_inicio);

        try {
            $horaInicio = Carbon::parse($fechaSolo . ' ' . $horaSolo);
            $horaFin = $horaInicio->copy()->addMinutes($servicio->duracion_estimada);
        } catch (\Exception $e) {
            return back()->withErrors(['hora_inicio' => 'Formato de hora inválido. Use el formato HH:MM (ejemplo: 09:00).'])->withInput();
        }

        // ✅ ELIMINADO: Las validaciones duplicadas porque ya se hacen en la función de validación

        // Crear la cita
        Cita::create([
            'cliente_id'       => $request->cliente_id,
            'empleado_id'      => $request->empleado_id,
            'servicio_id'      => $request->servicio_id,
            'fecha'            => $fechaSolo,
            'hora_inicio'      => $horaSolo,
            'hora_fin'         => $horaFin->format('H:i'),
            'duracion_minutos' => $servicio->duracion_estimada,
            'precio_estimado'  => $servicio->precio_base,
            'observaciones'    => $request->observaciones,
            'estado'           => 'pendiente',
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        $cita->load(['cliente', 'empleado', 'servicio']);
        return view('citas.show', compact('cita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        if ($cita->estado !== 'pendiente') {
            return redirect()->route('citas.index')
                ->with('error', 'Solo se pueden editar citas pendientes.');
        }

        $clientes = Cliente::orderBy('nombre')->get();
        $empleados = Empleado::where('estado', 'activo')->orderBy('nombre_empleado')->get();
        $servicios = Servicio::where('estado', 'activo')->orderBy('nombre_servicio')->get();

        return view('citas.edit', compact('cita', 'clientes', 'empleados', 'servicios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        if ($cita->estado !== 'pendiente') {
            return redirect()->route('citas.index')
                ->with('error', 'Solo se pueden modificar citas pendientes.');
        }

        $rules = [
            'cliente_id' => ['required', 'exists:clientes,id'],
            'empleado_id' => ['required', 'exists:empleados,id'],
            'servicio_id' => ['required', 'exists:servicios,id'],
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . now()->addMonths(3)->toDateString(),
                function ($attribute, $value, $fail) {
                    $fecha = Carbon::parse($value);
                    if ($fecha->dayOfWeek === 0) {
                        return $fail('No se pueden programar citas los domingos.');
                    }
                    $diasFestivos = [$fecha->year . '-01-01', $fecha->year . '-12-25'];
                    if (in_array($fecha->format('Y-m-d'), $diasFestivos)) {
                        return $fail('No se pueden programar citas en días festivos.');
                    }
                }
            ],
            'hora_inicio' => [
                'required',
                'date_format:H:i',
                $this->getValidacionHorarioLaboral(),
                $this->getValidacionHorarioDisponible($cita->id)  // ✅ Excluir la cita actual
            ],
            'observaciones' => ['nullable', 'string', 'max:200']
        ];

        $messages = [
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'empleado_id.required' => 'Debe seleccionar un empleado.',
            'empleado_id.exists' => 'El empleado seleccionado no existe.',
            'servicio_id.required' => 'Debe seleccionar un servicio.',
            'servicio_id.exists' => 'El servicio seleccionado no existe.',
            'fecha.required' => 'La fecha de la cita es obligatoria.',
            'fecha.date' => 'Ingrese una fecha válida.',
            'fecha.after_or_equal' => 'No se pueden programar citas en fechas pasadas.',
            'fecha.before_or_equal' => 'No se pueden programar citas con más de 3 meses de anticipación.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'La hora debe tener el formato HH:MM.',
            'observaciones.string' => 'Las observaciones deben ser texto válido.',
            'observaciones.max' => 'Las observaciones no pueden exceder 200 caracteres.',
        ];

        $validated = $request->validate($rules, $messages);

        $servicio = Servicio::findOrFail($validated['servicio_id']);
        $validated['duracion_minutos'] = $servicio->duracion_estimada;
        $validated['precio_estimado'] = $servicio->precio_base;

        $fechaFormateada = Carbon::parse($validated['fecha'])->format('Y-m-d');
        $horaLimpia = $this->normalizarHora($validated['hora_inicio']);

        try {
            $horaInicio = Carbon::parse($fechaFormateada . ' ' . $horaLimpia);
            $horaFin = $horaInicio->copy()->addMinutes($servicio->duracion_estimada);

            $validated['fecha'] = $fechaFormateada;
            $validated['hora_inicio'] = $horaLimpia;
            $validated['hora_fin'] = $horaFin->format('H:i');
        } catch (\Exception $e) {
            return redirect()->route('citas.index')
                ->with('error', 'No se pudo actualizar la cita. Verifique los datos ingresados.');
        }

        $cita->update($validated);

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada correctamente.');
    }

    /**
     * Cambiar estado de la cita
     */
    public function cambiarEstado(Request $request, Cita $cita)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_proceso,finalizada,cancelada'
        ]);

        $estadoAnterior = $cita->estado;
        $nuevoEstado = $request->estado;

        if ($estadoAnterior === 'finalizada' || $estadoAnterior === 'cancelada') {
            return response()->json([
                'success' => false,
                'message' => 'No se puede cambiar el estado de una cita finalizada o cancelada.'
            ]);
        }

        if ($nuevoEstado === 'en_proceso' && $estadoAnterior === 'pendiente') {
            $cita->hora_inicio_real = now();
        }

        if ($nuevoEstado === 'finalizada' && $estadoAnterior === 'en_proceso') {
            $cita->hora_fin_real = now();
        }

        $cita->estado = $nuevoEstado;
        $cita->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente.',
            'nuevo_estado' => $nuevoEstado
        ]);
    }

    /**
     * ✅ DISPONIBILIDAD MEJORADA: Incluir conflictos del cliente también
     */
    public function disponibilidad(Request $request)
    {
        $empleadoId = $request->empleado_id;
        $clienteId = $request->cliente_id;  // ✅ AGREGADO
        $fecha = $request->fecha;

        if (!$empleadoId || !$fecha) {
            return response()->json(['error' => 'Faltan parámetros requeridos'], 400);
        }

        $fechaSolo = Carbon::parse($fecha)->format('Y-m-d');
        $horariosOcupados = [];

        // ✅ 1. Obtener citas ocupadas del EMPLEADO
        $citasEmpleado = Cita::where('empleado_id', $empleadoId)
            ->where('fecha', $fechaSolo)
            ->whereIn('estado', ['pendiente', 'en_proceso'])
            ->get(['hora_inicio', 'duracion_minutos']);

        foreach ($citasEmpleado as $cita) {
            $horario = $this->procesarHorarioOcupado($cita, $fechaSolo);
            if ($horario) {
                $horariosOcupados[] = $horario;
            }
        }

        // ✅ 2. Obtener citas ocupadas del CLIENTE (si se proporciona)
        if ($clienteId) {
            $citasCliente = Cita::where('cliente_id', $clienteId)
                ->where('fecha', $fechaSolo)
                ->whereIn('estado', ['pendiente', 'en_proceso'])
                ->where('empleado_id', '!=', $empleadoId) // Evitar duplicados
                ->get(['hora_inicio', 'duracion_minutos']);

            foreach ($citasCliente as $cita) {
                $horario = $this->procesarHorarioOcupado($cita, $fechaSolo);
                if ($horario) {
                    $horariosOcupados[] = $horario;
                }
            }
        }

        return response()->json(['horarios_ocupados' => $horariosOcupados]);
    }

    /**
     * ✅ NUEVA FUNCIÓN: Procesar horario ocupado de manera consistente
     */
    private function procesarHorarioOcupado($cita, $fecha)
    {
        try {
            $fechaLimpia = Carbon::parse($fecha)->toDateString();
            $horaLimpia = $this->normalizarHora($cita->hora_inicio);
            $inicio = Carbon::parse($fechaLimpia . ' ' . $horaLimpia);
            $fin = $inicio->copy()->addMinutes($cita->duracion_minutos);

            return [
                'inicio' => $inicio->format('H:i'),
                'fin' => $fin->format('H:i')
            ];
        } catch (\Exception $e) {
            \Log::error('Error procesando horario ocupado: ' . $e->getMessage());
            return [
                'inicio' => $cita->hora_inicio,
                'fin' => $cita->hora_inicio
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        // Implementar lógica de eliminación si es necesario
    }
}