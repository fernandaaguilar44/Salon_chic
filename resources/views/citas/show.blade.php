<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cita - Salón de Belleza</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            padding: 1rem;
            color: #333;
            overflow: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 1.2rem;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            height: calc(100vh - 2rem);
            overflow: hidden;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .beauty-header {
            text-align: center;
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 3px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
        }

        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.6rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .beauty-header h2 i {
            color: #E4007C;
            font-size: 1.6rem;
        }

        /* Main Content */
        .appointment-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            min-height: 0;
            overflow: hidden;
        }

        /* Appointment Header */
        .appointment-header {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.08), rgba(228, 0, 124, 0.04));
            border: 2px solid rgba(228, 0, 124, 0.15);
            border-radius: 15px;
            padding: 1rem;
            text-align: center;
            animation: slideInDown 0.8s ease-out;
            flex-shrink: 0;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .appointment-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
        }

        .appointment-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(228, 0, 124, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.8);
            flex-shrink: 0;
        }

        .appointment-icon i {
            color: white;
            font-size: 1.6rem;
        }

        .appointment-details {
            text-align: left;
            flex: 1;
            min-width: 0;
        }

        .appointment-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #7B2A8D;
            margin-bottom: 0.3rem;
            line-height: 1.2;
        }

        .appointment-client {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-programada {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
            border: 2px solid #42a5f5;
        }

        .status-confirmada {
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
            color: #2e7d32;
            border: 2px solid #66bb6a;
        }

        .status-en-proceso {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #ef6c00;
            border: 2px solid #ffb74d;
        }

        .status-completada {
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            color: #7b1fa2;
            border: 2px solid #ba68c8;
        }

        .status-cancelada {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
            border: 2px solid #ef5350;
        }

        /* Info Grid */
        .info-grid {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.8rem;
            min-height: 0;
            overflow-y: auto;
            padding-right: 5px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 1rem;
            border-left: 4px solid #E4007C;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: fit-content;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .info-card:hover::before {
            transform: translateX(0);
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(228, 0, 124, 0.15);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 0.6rem;
        }

        .card-icon {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.1), rgba(123, 42, 141, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(228, 0, 124, 0.2);
            flex-shrink: 0;
        }

        .card-icon i {
            color: #E4007C;
            font-size: 1rem;
        }

        .card-label {
            font-size: 1rem;
            font-weight: 700;
            color: #7B2A8D;
            text-transform: none;
            letter-spacing: 0.3px;
        }

        .card-value {
            font-size: 1rem;
            font-weight: 500;
            color: #333;
            line-height: 1.3;
            word-wrap: break-word;
            word-break: break-word;
        }

        /* DateTime Card */
        .datetime-card {
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.05), rgba(123, 42, 141, 0.02));
            border-left: 4px solid #7B2A8D;
        }

        .datetime-display {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .date-section, .time-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.6rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            flex: 1;
        }

        .date-day {
            font-size: 1.8rem;
            font-weight: 700;
            color: #E4007C;
            line-height: 1;
        }

        .date-month {
            font-size: 0.8rem;
            color: #7B2A8D;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 0.2rem;
        }

        .time-display {
            font-size: 1.4rem;
            font-weight: 700;
            color: #7B2A8D;
            line-height: 1;
        }

        .time-label {
            font-size: 0.7rem;
            color: #666;
            text-transform: uppercase;
            margin-top: 0.2rem;
        }

        /* Special Cards */
        .price-card .card-value {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .price-amount {
            font-size: 1.6rem;
            font-weight: 700;
            color: #059669;
        }

        .price-currency {
            color: #047857;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .duration-badge {
            background: linear-gradient(135deg, #fef3c7, #fcd34d);
            color: #92400e;
            padding: 0.3rem 0.6rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 700;
            border: 1px solid #f59e0b;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Contact Link */
        a[href^="tel:"] {
            color: #059669;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 1rem;
            word-wrap: break-word;
            word-break: break-word;
        }

        a[href^="tel:"]:hover {
            color: #047857;
            transform: scale(1.02);
        }

        /* Notes Card */
        .notes-card {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.9), rgba(241, 245, 249, 0.9));
            border-left: 4px solid #6366f1;
        }

        .notes-value {
            background: rgba(255, 255, 255, 0.8);
            padding: 0.8rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            font-style: italic;
            line-height: 1.4;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #555;
            min-height: 50px;
        }

        /* Actions */
        .actions-section {
            display: flex;
            justify-content: flex-start;
            padding: 0.8rem 0;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
        }

        .btn-beauty {
            padding: 0.8rem 1.8rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(228, 0, 124, 0.3);
            text-transform: none;
            letter-spacing: 0.3px;
        }

        .btn-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228, 0, 124, 0.5);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            html {
                overflow: auto !important;
            }

            body {
                overflow-y: auto !important;
            }

            .container {
                height: auto;
                min-height: calc(100vh - 2rem);
                overflow: visible;
            }

            .beauty-header h2 {
                font-size: 1.4rem;
            }

            .appointment-info {
                flex-direction: column;
                gap: 0.8rem;
            }

            .appointment-details {
                text-align: center;
            }

            .appointment-title {
                font-size: 1.4rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
                overflow-y: visible;
            }

            .datetime-display {
                flex-direction: column;
                gap: 0.5rem;
            }

            .actions-section {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .beauty-header h2 {
                font-size: 1.2rem;
                flex-direction: column;
                gap: 5px;
            }

            .card-header {
                flex-direction: column;
                text-align: center;
                gap: 0.4rem;
            }

            .btn-beauty {
                width: 100%;
                justify-content: center;
                padding: 0.7rem 1.5rem;
                font-size: 0.8rem;
            }
        }

        /* Loading animations */
        .info-card {
            animation: slideInUp 0.6s ease-out;
            animation-fill-mode: both;
            opacity: 0;
        }

        .info-card:nth-child(1) { animation-delay: 0.1s; }
        .info-card:nth-child(2) { animation-delay: 0.2s; }
        .info-card:nth-child(3) { animation-delay: 0.3s; }
        .info-card:nth-child(4) { animation-delay: 0.4s; }
        .info-card:nth-child(5) { animation-delay: 0.5s; }
        .info-card:nth-child(6) { animation-delay: 0.6s; }

        /* Custom scrollbar */
        .info-grid::-webkit-scrollbar {
            width: 6px;
        }

        .info-grid::-webkit-scrollbar-track {
            background: rgba(228, 0, 124, 0.1);
            border-radius: 3px;
        }

        .info-grid::-webkit-scrollbar-thumb {
            background: rgba(228, 0, 124, 0.3);
            border-radius: 3px;
        }

        .info-grid::-webkit-scrollbar-thumb:hover {
            background: rgba(228, 0, 124, 0.5);
        }

        /* Accessibility */
        .btn-beauty:focus {
            outline: 3px solid rgba(228, 0, 124, 0.5);
            outline-offset: 2px;
        }

        .info-card:focus-within {
            outline: 2px solid rgba(228, 0, 124, 0.5);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="beauty-header">
        <h2>
            <i class="fas fa-calendar-check"></i>
            Detalles de la Cita
        </h2>
    </div>

    <!-- Appointment Content -->
    <div class="appointment-content">
        <!-- Appointment Header -->
        <div class="appointment-header">
            <div class="appointment-info">
                <div class="appointment-icon">
                    <i class="fas fa-cut"></i>
                </div>
                <div class="appointment-details">
                    <div class="appointment-title">{{ $cita->servicio->nombre_servicio ?? 'Servicio no especificado' }}</div>
                    <div class="appointment-client">{{ $cita->cliente->nombre ?? 'Cliente no especificado' }}</div>
                    @php
                        $statusConfig = [
                            'programada' => ['class' => 'status-programada', 'icon' => 'fas fa-calendar-plus', 'text' => 'Programada'],
                            'confirmada' => ['class' => 'status-confirmada', 'icon' => 'fas fa-check-circle', 'text' => 'Confirmada'],
                            'en_proceso' => ['class' => 'status-en-proceso', 'icon' => 'fas fa-play-circle', 'text' => 'En Proceso'],
                            'completada' => ['class' => 'status-completada', 'icon' => 'fas fa-check-double', 'text' => 'Completada'],
                            'cancelada' => ['class' => 'status-cancelada', 'icon' => 'fas fa-times-circle', 'text' => 'Cancelada'],
                        ];
                        $currentStatus = $statusConfig[$cita->estado ?? 'programada'] ?? $statusConfig['programada'];
                    @endphp
                    <div class="status-badge {{ $currentStatus['class'] }}">
                        <i class="{{ $currentStatus['icon'] }}"></i>
                        {{ $currentStatus['text'] }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <!-- Fecha y Hora -->
            <div class="info-card datetime-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-calendar-clock"></i>
                    </div>
                    <div class="card-label">Fecha y Hora</div>
                </div>
                <div class="datetime-display">
                    <div class="date-section">
                        @if($cita->fecha ?? false)
                            @php
                                $fecha = \Carbon\Carbon::parse($cita->fecha);
                                $meses = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
                            @endphp
                            <div class="date-day">{{ $fecha->day }}</div>
                            <div class="date-month">{{ $meses[$fecha->month - 1] }}</div>
                        @else
                            <div class="date-day">15</div>
                            <div class="date-month">MAR</div>
                        @endif
                    </div>

                    <div class="time-section">
                        @if($cita->hora_inicio ?? false)
                            @php
                                $horaInicio = \Carbon\Carbon::parse($cita->hora_inicio);
                            @endphp
                            <div class="time-display">{{ $horaInicio->format('H:i') }}</div>
                            <div class="time-label">Inicio</div>
                        @else
                            <div class="time-display">10:30</div>
                            <div class="time-label">Inicio</div>
                        @endif
                    </div>

                    <div class="time-section">
                        @if($cita->hora_fin ?? false)
                            @php
                                $horaFin = \Carbon\Carbon::parse($cita->hora_fin);
                            @endphp
                            <div class="time-display">{{ $horaFin->format('H:i') }}</div>
                            <div class="time-label">Fin</div>
                        @elseif(($cita->hora_inicio ?? false) && ($cita->servicio->duracion_estimada ?? false))
                            @php
                                $horaInicio = \Carbon\Carbon::parse($cita->hora_inicio);
                                $horaFin = $horaInicio->copy()->addMinutes($cita->servicio->duracion_estimada);
                            @endphp
                            <div class="time-display">{{ $horaFin->format('H:i') }}</div>
                            <div class="time-label">Fin</div>
                        @else
                            <div class="time-display">12:00</div>
                            <div class="time-label">Fin</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Duración -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="card-label">Duración</div>
                </div>
                <div class="card-value">
                    <div class="duration-badge">
                        <i class="fas fa-stopwatch"></i>
                        {{ $cita->servicio->duracion_estimada ?? '90' }} min
                    </div>
                </div>
            </div>

            <!-- Precio -->
            <div class="info-card price-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="card-label">Precio</div>
                </div>
                <div class="card-value">
                    <span class="price-currency">L.</span>
                    <span class="price-amount">{{ number_format($cita->precio_final ?? $cita->servicio->precio_base ?? 0, 2) }}</span>
                </div>
            </div>

            <!-- Teléfono Cliente -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="card-label">Teléfono</div>
                </div>
                <div class="card-value">
                    @if($cita->cliente->telefono ?? false)
                        <a href="tel:{{ $cita->cliente->telefono }}">
                            <i class="fas fa-phone"></i>
                            {{ $cita->cliente->telefono }}
                        </a>
                    @else
                        <a href="tel:+504-9876-5432">
                            <i class="fas fa-phone"></i>
                            +504-9876-5432
                        </a>
                    @endif
                </div>
            </div>

            <!-- Estilista -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-label">Estilista</div>
                </div>
                <div class="card-value">{{ $cita->empleado->nombre_empleado ?? 'No asignado' }}</div>
            </div>

            <!-- Observaciones -->
            @if($cita->observaciones ?? false)
                <div class="info-card notes-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-sticky-note"></i>
                        </div>
                        <div class="card-label">Observaciones</div>
                    </div>
                    <div class="notes-value">
                        {{ $cita->observaciones }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="actions-section">
            <a href="{{ route('citas.index') }}" class="btn-beauty">
                <i class="fas fa-arrow-left"></i>
                Volver al listado
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.location.href = '{{ route("citas.index") }}';
            }
        });

        // Add hover effects to cards
        document.querySelectorAll('.info-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.01)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    });
</script>
</body>
</html>