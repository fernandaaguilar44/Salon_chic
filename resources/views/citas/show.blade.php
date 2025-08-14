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
            overflow-x: hidden;
            overflow-y: auto;
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
            margin-bottom: 0.8rem;
            padding-bottom: 0.6rem;
            border-bottom: 3px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
        }

        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .beauty-header h2 i {
            color: #E4007C;
            font-size: 1.5rem;
        }

        /* Main Content */
        .appointment-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            min-height: 0;
            overflow: hidden;
        }

        /* Appointment Header */
        .appointment-header {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.08), rgba(228, 0, 124, 0.04));
            border: 2px solid rgba(228, 0, 124, 0.15);
            border-radius: 15px;
            padding: 0.8rem;
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
            gap: 1.2rem;
        }

        .appointment-icon {
            width: 55px;
            height: 55px;
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
            font-size: 1.4rem;
        }

        .appointment-details {
            text-align: left;
            flex: 1;
            min-width: 0;
        }

        /* Cliente y Servicio en la misma línea con etiquetas */
        .client-service-info {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
            margin-bottom: 0.5rem;
            min-height: 45px;
            justify-content: center;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            line-height: 1.3;
        }

        .info-label {
            font-weight: 600;
            color: #7B2A8D;
            min-width: 55px;
            font-size: 0.9rem;
            text-transform: capitalize;
            letter-spacing: 0.3px;
        }

        .info-value {
            font-weight: 500;
            color: #333;
            word-wrap: break-word;
            flex: 1;
            font-size: 1rem;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.6rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.2rem;
        }

        .status-programada {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
            border: 2px solid #42a5f5;
        }

        .status-en-proceso {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #ef6c00;
            border: 2px solid #ffb74d;
        }

        .status-completada {
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
            color: #2e7d32;
            border: 2px solid #66bb6a;
        }

        .status-cancelada {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
            border: 2px solid #ef5350;
        }

        /* Info Grid - Más compacto */
        .info-grid {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.6rem;
            min-height: 0;
            overflow-y: auto;
            padding-right: 5px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 0.8rem;
            border-left: 4px solid #E4007C;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
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
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(228, 0, 124, 0.15);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .card-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.1), rgba(123, 42, 141, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(228, 0, 124, 0.2);
            flex-shrink: 0;
        }

        .card-icon i {
            color: #E4007C;
            font-size: 0.9rem;
        }

        .card-label {
            font-size: 0.85rem;
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
            overflow-wrap: break-word;
            hyphens: auto;
        }

        /* DateTime Card - Más compacta */
        .datetime-card {
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.05), rgba(123, 42, 141, 0.02));
            border-left: 4px solid #7B2A8D;
        }

        .datetime-display {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.6rem;
        }

        .date-section, .time-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.4rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            flex: 1;
        }

        .date-day {
            font-size: 1.4rem;
            font-weight: 700;
            color: #E4007C;
            line-height: 1;
        }

        .date-month {
            font-size: 0.7rem;
            color: #7B2A8D;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 0.1rem;
        }

        .time-display {
            font-size: 1.2rem;
            font-weight: 700;
            color: #7B2A8D;
            line-height: 1;
        }

        .time-label {
            font-size: 0.65rem;
            color: #666;
            text-transform: uppercase;
            margin-top: 0.1rem;
        }

        /* Special Cards */
        .price-card .card-value {
            display: flex;
            align-items: center;
            gap: 0.2rem;
        }

        .price-amount {
            font-size: 1.3rem;
            font-weight: 700;
            color: #059669;
        }

        .price-currency {
            color: #047857;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .duration-badge {
            background: linear-gradient(135deg, #fef3c7, #fcd34d);
            color: #92400e;
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            border: 1px solid #f59e0b;
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
        }

        /* Contact Link */
        a[href^="tel:"] {
            color: #059669;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
            font-size: 1rem;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        a[href^="tel:"]:hover {
            color: #047857;
            transform: scale(1.02);
        }

        /* Notes Card - Sin scroll horizontal */
        .notes-card {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.9), rgba(241, 245, 249, 0.9));
            border-left: 4px solid #6366f1;
        }

        .notes-value {
            background: rgba(255, 255, 255, 0.8);
            padding: 0.6rem;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            font-style: italic;
            line-height: 1.4;
            margin-top: 0.3rem;
            font-size: 0.95rem;
            color: #555;
            min-height: 40px;
            max-height: 80px;
            overflow-y: auto;
            overflow-x: hidden;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
        }

        /* Custom scrollbar para notas */
        .notes-value::-webkit-scrollbar {
            width: 3px;
        }

        .notes-value::-webkit-scrollbar-track {
            background: rgba(99, 102, 241, 0.1);
            border-radius: 2px;
        }

        .notes-value::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.3);
            border-radius: 2px;
        }

        .notes-value::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.5);
        }

        /* Actions */
        .actions-section {
            display: flex;
            justify-content: flex-start;
            padding: 0.6rem 0;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
        }

        .btn-beauty {
            padding: 0.6rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(228, 0, 124, 0.3);
            text-transform: none;
            letter-spacing: 0.3px;
        }

        .btn-beauty:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(228, 0, 124, 0.5);
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
                overflow-x: hidden !important;
            }

            .container {
                height: auto;
                min-height: calc(100vh - 2rem);
                overflow: visible;
            }

            .beauty-header h2 {
                font-size: 1.3rem;
            }

            .appointment-info {
                flex-direction: column;
                gap: 0.6rem;
            }

            .appointment-details {
                text-align: center;
            }

            .info-row {
                justify-content: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
                overflow-y: visible;
            }

            .datetime-display {
                flex-direction: column;
                gap: 0.4rem;
            }

            .actions-section {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .beauty-header h2 {
                font-size: 1.1rem;
                flex-direction: column;
                gap: 4px;
            }

            .card-header {
                flex-direction: column;
                text-align: center;
                gap: 0.3rem;
            }

            .btn-beauty {
                width: 100%;
                justify-content: center;
                padding: 0.6rem 1.2rem;
                font-size: 0.75rem;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.1rem;
            }

            .info-label {
                min-width: auto;
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

        /* Custom scrollbar principal */
        .info-grid::-webkit-scrollbar {
            width: 4px;
        }

        .info-grid::-webkit-scrollbar-track {
            background: rgba(228, 0, 124, 0.1);
            border-radius: 2px;
        }

        .info-grid::-webkit-scrollbar-thumb {
            background: rgba(228, 0, 124, 0.3);
            border-radius: 2px;
        }

        .info-grid::-webkit-scrollbar-thumb:hover {
            background: rgba(228, 0, 124, 0.5);
        }

        /* Accessibility */
        .btn-beauty:focus {
            outline: 2px solid rgba(228, 0, 124, 0.5);
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
    <div class="beauty-header">
        <h2>
            <i class="fas fa-calendar-check"></i>
            Detalles de la Cita
        </h2>
    </div>

    <div class="appointment-content">
        <div class="appointment-header">
            <div class="appointment-info">
                <div class="appointment-icon">
                    @php
                        $serviceName = strtolower($cita->servicio->nombre_servicio ?? '');
                        $serviceIcon = 'fas fa-star'; // default

                        if (str_contains($serviceName, 'manicura') || str_contains($serviceName, 'uñas')) {
                            $serviceIcon = 'fas fa-hand-sparkles';
                        } elseif (str_contains($serviceName, 'pedicura') || str_contains($serviceName, 'pie')) {
                            $serviceIcon = 'fas fa-spa';
                        } elseif (str_contains($serviceName, 'cabello') || str_contains($serviceName, 'corte') || str_contains($serviceName, 'peinado')) {
                            $serviceIcon = 'fas fa-cut';
                        } elseif (str_contains($serviceName, 'facial') || str_contains($serviceName, 'rostro')) {
                            $serviceIcon = 'fas fa-leaf';
                        }
                    @endphp
                    <i class="{{ $serviceIcon }}"></i>
                </div>
                <div class="appointment-details">
                    <div class="client-service-info">
                        <div class="info-row">
                            <span class="info-label">Cliente:</span>
                            <span class="info-value">{{ $cita->cliente->nombre ?? 'Cliente no especificado' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Servicio:</span>
                            <span class="info-value">{{ $cita->servicio->nombre_servicio ?? 'Servicio no especificado' }}</span>
                        </div>
                    </div>
                    @php
                        $statusConfig = [
                            'pendiente' => ['class' => 'status-programada', 'icon' => 'fas fa-calendar-plus', 'text' => 'Pendiente'],
                            'en_proceso' => ['class' => 'status-en-proceso', 'icon' => 'fas fa-play-circle', 'text' => 'En Proceso'],
                            'finalizada' => ['class' => 'status-completada', 'icon' => 'fas fa-check-double', 'text' => 'Finalizada'],
                            'cancelada' => ['class' => 'status-cancelada', 'icon' => 'fas fa-times-circle', 'text' => 'Cancelada'],
                        ];
                        $currentStatus = $statusConfig[$cita->estado ?? 'pendiente'] ?? $statusConfig['pendiente'];
                    @endphp
                    <div class="status-badge {{ $currentStatus['class'] }}">
                        <i class="{{ $currentStatus['icon'] }}"></i>
                        {{ $currentStatus['text'] }}
                    </div>
                </div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-card datetime-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-label">Fecha y Hora</div>
                </div>
                <div class="datetime-display">
                    <div class="date-section">
                        <div class="date-day">{{ \Carbon\Carbon::parse($cita->fecha)->format('d') }}</div>
                        <div class="date-month">{{ strtoupper(\Carbon\Carbon::parse($cita->fecha)->locale('es')->format('M')) }}</div>
                    </div>

                    <div class="time-section">
                        <div class="time-display">{{ \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i') }}</div>
                        <div class="time-label">Inicio</div>
                    </div>

                    <div class="time-section">
                        @php
                            $fechaFormateada = \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d');
                            $horaFormateada = \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i:s');
                            $estimadoFinCita = \Carbon\Carbon::parse($fechaFormateada . ' ' . $horaFormateada)
                                                ->addMinutes($cita->servicio->duracion_estimada ?? 90)
                                                ->format('H:i');
                        @endphp
                        <div class="time-display">{{ $estimadoFinCita }}</div>
                        <div class="time-label">Fin</div>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="card-label">Duración</div>
                </div>
                <div class="card-value">
                    @php
                        $duracion = $cita->servicio->duracion_estimada ?? 90;
                        $duracionTexto = '';

                        if ($duracion >= 60) {
                            $horas = floor($duracion / 60);
                            $minutosRestantes = $duracion % 60;

                            if ($minutosRestantes == 0) {
                                $duracionTexto = $horas . 'h';
                            } else {
                                $duracionTexto = $horas . 'h ' . $minutosRestantes . 'min';
                            }
                        } else {
                            $duracionTexto = $duracion . ' min';
                        }
                    @endphp
                    <div class="duration-badge">
                        <i class="fas fa-stopwatch"></i>
                        {{ $duracionTexto }}
                    </div>
                </div>
            </div>

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
                        <span style="color: #999; font-style: italic;">No especificado</span>
                    @endif
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-label">Estilista</div>
                </div>
                <div class="card-value">{{ $cita->empleado->nombre_empleado ?? 'No asignado' }}</div>
            </div>

            @if(!empty($cita->observaciones) && trim($cita->observaciones) !== '')
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
                this.style.transform = 'translateY(-2px) scale(1.005)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Auto-resize text for long content
        function adjustTextSize() {
            document.querySelectorAll('.info-value, .card-value').forEach(element => {
                if (element.scrollWidth > element.clientWidth) {
                    element.style.fontSize = '0.8rem';
                }
            });
        }

        adjustTextSize();
        window.addEventListener('resize', adjustTextSize);
    });
</script>
</body>
</html>