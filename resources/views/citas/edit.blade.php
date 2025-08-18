<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar cita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 0.5rem 0;
            color: #333;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        h2 {
            text-align: center;
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
        }

        .form-label {
            color: #7B2A8D;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            background-color: white;
            color: black;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.25);
        }

        .form-control:disabled,
        .form-select:disabled {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            opacity: 0.7;
        }

        /* Estilo mejorado para campos de solo lectura */
        .readonly-field {
            background-color: #fff8dc !important;
            border-color: #ffc107 !important;
            color: #856404 !important;
        }

        /* Estilo específico para cliente siempre deshabilitado */
        .cliente-disabled {
            background-color: #e9ecef !important;
            border-color: #ced4da !important;
            color: #6c757d !important;
        }

        .input-group {
            position: relative;
        }

        .btn-primary,
        .btn-secondary,
        .btn-warning,
        .btn-success,
        .btn-danger {
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6a267f 0%, #c3006a 100%);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838 0%, #1abc9c 100%);
            color: white;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border: 2px solid #dc3545;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
        }

        .btn-group-left {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 1.5rem;
        }

        .alert {
            border-radius: 15px;
            border: none;
            margin-bottom: 1.5rem;
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(224, 168, 0, 0.05));
            border-left: 4px solid #ffc107;
            color: #856404;
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(46, 134, 171, 0.05));
            border-left: 4px solid #3498db;
            color: #2E86AB;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(32, 201, 151, 0.05));
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .badge {
            padding: 0.5em 0.75em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .badge-pendiente {
            background: rgba(255, 193, 7, 0.2);
            color: #856404;
            border: 1px solid rgba(255, 193, 7, 0.5);
        }

        .badge-en-proceso {
            background: rgba(0, 123, 255, 0.2);
            color: #004085;
            border: 1px solid rgba(0, 123, 255, 0.5);
        }

        .badge-finalizada {
            background: rgba(40, 167, 69, 0.2);
            color: #155724;
            border: 1px solid rgba(40, 167, 69, 0.5);
        }

        .badge-cancelada {
            background: rgba(220, 53, 69, 0.2);
            color: #721c24;
            border: 1px solid rgba(220, 53, 69, 0.5);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .price-display, .time-display, .info-display {
            background: rgba(123, 42, 141, 0.1);
            color: #7B2A8D;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            margin-top: 0.5rem;
            margin-right: 0.5rem;
        }

        .restriction-note {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: 8px;
            padding: 0.5rem;
            font-size: 0.8rem;
            color: #856404;
            margin-top: 0.3rem;
        }

        .restriction-note.cliente-note {
            background: rgba(108, 117, 125, 0.1);
            border: 1px solid rgba(108, 117, 125, 0.3);
            color: #495057;
        }

        .restriction-note.finalizada-note {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid rgba(40, 167, 69, 0.3);
            color: #155724;
        }

        .info-card {
            background: rgba(123, 42, 141, 0.05);
            border: 1px solid rgba(228, 0, 124, 0.1);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>


<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-8">
            <div class="form-container">
                <h2><i class="fas fa-calendar-edit"></i> Editar cita</h2>

                @php
                    $ahora = now();
                    $fechaCitaFormateada = $cita->fecha instanceof \Carbon\Carbon ? $cita->fecha->format('Y-m-d') : \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d');
                    $horaInicioFormateada = \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i');

                    $fechaHoraCita = \Carbon\Carbon::parse($fechaCitaFormateada . ' ' . $horaInicioFormateada);
                    $yaPaso = $fechaHoraCita->isPast();
                    $esHoy = $fechaHoraCita->isToday();
                    $faltaPoco = $fechaHoraCita->diffInHours($ahora) <= 2 && $fechaHoraCita->isFuture();

                    // Reglas específicas por estado
                    $citaPendiente = $cita->estado === 'pendiente';
                    $citaEnProceso = $cita->estado === 'en_proceso';
                    $citaFinalizada = $cita->estado === 'finalizada';
                    $citaCancelada = $cita->estado === 'cancelada';

                    // Reglas de edición
                    $puedeEditarEmpleadoServicio = $citaPendiente; // Solo pendiente
                    $puedeEditarFechaHora = $citaPendiente; // Solo pendiente
                    $puedeEditarEstado = $citaPendiente || $citaEnProceso; // Pendiente o en proceso
                    $puedeEditarObservaciones = !$citaFinalizada && !$citaCancelada; // Todos menos finalizada y cancelada

                    // Información adicional para el "plus"
                    $estimadoFinCita = \Carbon\Carbon::parse($fechaCitaFormateada . ' ' . $horaInicioFormateada)
                                        ->addMinutes($cita->servicio->duracion_estimada)
                                        ->format('H:i');
                @endphp

                        <!-- Información del estado actual y resumen de la cita -->
                <div class="info-card">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-4">
                            <strong><i class="fas fa-info-circle"></i> Estado actual:</strong>
                            @switch($cita->estado)
                                @case('pendiente')
                                    <span class="badge badge-pendiente ms-2">
                                        <i class="fas fa-clock"></i> Pendiente
                                    </span>
                                    @break
                                @case('en_proceso')
                                    <span class="badge badge-en-proceso ms-2">
                                        <i class="fas fa-play"></i> En proceso
                                    </span>
                                    @break
                                @case('finalizada')
                                    <span class="badge badge-finalizada ms-2">
                                        <i class="fas fa-check"></i> Finalizada
                                    </span>
                                    @break
                                @case('cancelada')
                                    <span class="badge badge-cancelada ms-2">
                                        <i class="fas fa-times"></i> Cancelada
                                    </span>
                                    @break
                            @endswitch
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="info-display">
                                <i class="fas fa-clock"></i> Fin estimado: {{ $estimadoFinCita }}
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i>
                                {{ $fechaHoraCita->format('d/m/Y H:i') }}
                                @if($yaPaso)
                                    <span class="text-danger ms-1">(Ya pasó)</span>
                                @elseif($faltaPoco)
                                    <span class="text-warning ms-1">(Pronto)</span>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Alertas según el estado -->
                @if($citaFinalizada)
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <strong>Cita finalizada:</strong> Esta cita ya fue completada. Solo se puede cambiar el estado y agregar observaciones.
                    </div>
                @elseif($faltaPoco && $cita->estado === 'pendiente')
                    <div class="alert alert-info">
                        <i class="fas fa-clock"></i>
                        <strong>Cita próxima:</strong> Esta cita está programada para muy pronto. Puedes iniciarla cuando llegue el cliente.
                    </div>
                @elseif($yaPaso && $cita->estado === 'pendiente')
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Cita vencida:</strong> Esta cita ya pasó y no se completó. Puedes cambiar el estado o agregar observaciones.
                    </div>
                @endif

                <form id="citaForm" method="POST" action="{{ route('citas.update', $cita->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Cliente - SIEMPRE DESHABILITADO -->
                        <div class="col-md-6">
                            <label for="cliente_id" class="form-label">
                                <i class="fas fa-user"></i> Cliente
                            </label>
                            <div class="input-group">
                                <select id="cliente_id" name="cliente_id"
                                        class="form-select cliente-disabled @error('cliente_id') is-invalid @enderror"
                                        disabled>
                                    <option value="">Seleccione cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                                {{ old('cliente_id', $cita->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <!-- Campo oculto para enviar el valor -->
                                <input type="hidden" name="cliente_id" value="{{ $cita->cliente_id }}">
                            </div>
                            <div class="restriction-note cliente-note">
                                <i class="fas fa-user-lock"></i> El cliente no se puede cambiar una vez creada la cita
                            </div>
                            @error('cliente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Empleado -->
                        <div class="col-md-6">
                            <label for="empleado_id" class="form-label">
                                <i class="fas fa-user-tie"></i> Empleado
                            </label>
                            <div class="input-group">
                                <select id="empleado_id" name="empleado_id"
                                        class="form-select @error('empleado_id') is-invalid @enderror"
                                        {{ !$puedeEditarEmpleadoServicio ? 'disabled' : '' }}>
                                    <option value="">Seleccione empleado</option>
                                    @foreach($empleados as $empleado)
                                        <option value="{{ $empleado->id }}"
                                                {{ old('empleado_id', $cita->empleado_id) == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre_empleado }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(!$puedeEditarEmpleadoServicio)
                                    <input type="hidden" name="empleado_id" value="{{ $cita->empleado_id }}">
                                @endif
                            </div>
                            @if($citaFinalizada)
                                <div class="restriction-note finalizada-note">
                                    <i class="fas fa-check-circle"></i> No editable - Cita finalizada
                                </div>
                            @endif
                            @error('empleado_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Servicio -->
                        <div class="col-md-6">
                            <label for="servicio_id" class="form-label">
                                <i class="fas fa-cut"></i> Servicio
                            </label>
                            <div class="input-group">
                                <select id="servicio_id" name="servicio_id"
                                        class="form-select @error('servicio_id') is-invalid @enderror"
                                        {{ !$puedeEditarEmpleadoServicio ? 'disabled' : '' }}>
                                    <option value="">Seleccione servicio</option>
                                    @foreach($servicios as $servicio)
                                        <option value="{{ $servicio->id }}"
                                                data-precio="{{ $servicio->precio_base }}"
                                                data-duracion="{{ $servicio->duracion_estimada }}"
                                                {{ old('servicio_id', $cita->servicio_id) == $servicio->id ? 'selected' : '' }}>
                                            {{ $servicio->nombre_servicio }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(!$puedeEditarEmpleadoServicio)
                                    <input type="hidden" name="servicio_id" value="{{ $cita->servicio_id }}">
                                @endif
                            </div>
                            <!-- Display de precio y duración dinámico -->
                            <div id="servicio-info-display">
                                <div id="precio-display" class="price-display" style="display: none;">
                                    <i class="fas fa-tag"></i> Precio: L <span id="precio-valor">0.00</span>
                                </div>
                                <div id="duracion-display" class="time-display" style="display: none;">
                                    <i class="fas fa-hourglass-half"></i> Duración: <span id="duracion-valor">0</span> min
                                </div>
                            </div>
                            @if($citaFinalizada)
                                <div class="restriction-note finalizada-note">
                                    <i class="fas fa-check-circle"></i> No editable - Cita finalizada
                                </div>
                            @endif
                            @error('servicio_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Estado - SIEMPRE EDITABLE -->
                        <div class="col-md-6">
                            <label for="estado" class="form-label">
                                <i class="fas fa-flag"></i> Estado
                            </label>
                            <div class="input-group">
                                <select id="estado" name="estado"
                                        class="form-select @error('estado') is-invalid @enderror"
                                        {{ !$puedeEditarEstado ? 'disabled' : '' }}>
                                    @if($citaPendiente)
                                        <option value="pendiente" {{ old('estado', $cita->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="en_proceso" {{ old('estado', $cita->estado) == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                                        <option value="finalizada" {{ old('estado', $cita->estado) == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                                        <option value="cancelada" {{ old('estado', $cita->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                    @elseif($citaEnProceso)
                                        <option value="en_proceso" selected>En proceso</option>
                                        <option value="finalizada">Finalizada</option>
                                    @elseif($citaCancelada)
                                        <option value="cancelada" selected>Cancelada</option>
                                    @elseif($citaFinalizada)
                                        <option value="finalizada" selected>Finalizada</option>
                                    @endif
                                </select>
                                @if(!$puedeEditarEstado)
                                    <input type="hidden" name="estado" value="{{ $cita->estado }}">
                                @endif
                            </div>
                            @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fecha -->
                        <div class="col-md-6">
                            <label for="fecha" class="form-label">
                                <i class="fas fa-calendar-alt"></i> Fecha
                            </label>
                            <div class="input-group">
                                <input type="date" id="fecha" name="fecha"
                                       class="form-control @error('fecha') is-invalid @enderror {{ !$puedeEditarFechaHora ? 'readonly-field' : '' }}"
                                       value="{{ old('fecha', $fechaCitaFormateada) }}"
                                        {{ !$puedeEditarFechaHora ? 'readonly' : '' }} />
                                @if(!$puedeEditarFechaHora)
                                    <input type="hidden" name="fecha" value="{{ $fechaCitaFormateada }}">
                                @endif
                            </div>
                            @if($citaFinalizada)
                                <div class="restriction-note finalizada-note">
                                    <i class="fas fa-check-circle"></i> No editable - Cita finalizada
                                </div>
                            @endif
                            @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Hora -->
                        <div class="col-md-6">
                            <label for="hora_inicio" class="form-label">
                                <i class="fas fa-clock"></i> Hora de inicio
                            </label>
                            <select id="hora_inicio" name="hora_inicio"
                                    class="form-select @error('hora_inicio') is-invalid @enderror"
                                    {{ !$puedeEditarFechaHora ? 'disabled' : '' }}>
                                <option value="">Seleccione una hora</option>
                                @foreach ([
                                    '08:00', '09:00', '10:00', '11:00',
                                    '13:00', '14:00', '15:00', '16:00', '17:00'
                                ] as $hora)
                                    <option value="{{ $hora }}" {{ old('hora_inicio', $horaInicioFormateada) == $hora ? 'selected' : '' }}>
                                        {{ $hora }}
                                    </option>
                                @endforeach
                            </select>
                            @if(!$puedeEditarFechaHora)
                                <input type="hidden" name="hora_inicio" value="{{ $horaInicioFormateada }}">
                            @endif

                            @if(!$puedeEditarFechaHora)
                                <div class="restriction-note {{ $citaFinalizada ? 'finalizada-note' : '' }}">
                                    <i class="fas fa-{{ $citaFinalizada ? 'check-circle' : 'times-circle' }}"></i>
                                    No editable - Cita {{ $citaFinalizada ? 'finalizada' : ($citaCancelada ? 'cancelada' : 'en proceso') }}
                                </div>
                            @endif

                            @error('hora_inicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Observaciones de la cita -->
                        <div class="col-12">
                            <label for="observaciones" class="form-label">
                                <i class="fas fa-sticky-note"></i> Observaciones de la cita
                            </label>
                            <div class="input-group">
        <textarea id="observaciones" name="observaciones" rows="3" maxlength="200"
                  class="form-control @error('observaciones') is-invalid @enderror"
                  placeholder="Observaciones adicionales sobre esta cita específica..."
                  {{ !$puedeEditarObservaciones ? 'disabled' : '' }}>{{ old('observaciones', $cita->observaciones) }}</textarea>
                                @if(!$puedeEditarObservaciones)
                                    <input type="hidden" name="observaciones" value="{{ $cita->observaciones }}">
                                @endif
                            </div>
                            @if($citaFinalizada || $citaCancelada)
                                <div class="restriction-note {{ $citaFinalizada ? 'finalizada-note' : '' }}">
                                    <i class="fas fa-{{ $citaFinalizada ? 'check-circle' : 'times-circle' }}"></i>
                                    No editable - Cita {{ $citaFinalizada ? 'finalizada' : 'cancelada' }}
                                </div>
                            @else
                                <small class="text-muted">Las observaciones de la cita se pueden agregar o modificar.</small>
                            @endif
                            @error('observaciones')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    <div class="btn-group-left mt-4">
                        <a href="{{ route('citas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar cambios
                        </button>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Configurar fecha mínima solo si se puede editar
        const fechaInput = document.getElementById('fecha');
        const puedeEditarFechaHora = @json($puedeEditarFechaHora);

        if (puedeEditarFechaHora) {
            const ahora = new Date();
            const hoy = ahora.toISOString().split('T')[0];
            fechaInput.setAttribute('min', hoy);
        }

        // Mostrar precio y duración cuando cambie el servicio
        const servicioSelect = document.getElementById('servicio_id');
        const precioDisplay = document.getElementById('precio-display');
        const precioValor = document.getElementById('precio-valor');
        const duracionDisplay = document.getElementById('duracion-display');
        const duracionValor = document.getElementById('duracion-valor');

        function actualizarServicioInfo() {
            const selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
            if (selectedOption.value) {
                const precio = selectedOption.dataset.precio;
                const duracion = selectedOption.dataset.duracion;

                precioValor.textContent = parseFloat(precio).toFixed(2);
                precioDisplay.style.display = 'inline-block';

                duracionValor.textContent = duracion;
                duracionDisplay.style.display = 'inline-block';
            } else {
                precioDisplay.style.display = 'none';
                duracionDisplay.style.display = 'none';
            }
        }

        // Mostrar información del servicio al cargar si ya hay servicio seleccionado
        actualizarServicioInfo();
        servicioSelect.addEventListener('change', actualizarServicioInfo);


    });
</script>
</body>
</html>