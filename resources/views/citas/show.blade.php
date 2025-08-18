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
            padding: 0.4rem;
            color: #333;
            overflow: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 0.6rem;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            height: calc(100vh - 0.8rem);
            overflow: hidden;
            position: relative;
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

        /* Header */
        .beauty-header {
            text-align: center;
            margin-bottom: 0.4rem;
            padding-bottom: 0.3rem;
            border-bottom: 3px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
        }

        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.2rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .beauty-header h2 i {
            color: #E4007C;
            font-size: 1.3rem;
        }

        /* Main Content */
        .appointment-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            min-height: 0;
            overflow: hidden;
        }

        /* Appointment Header */
        .appointment-header {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.08), rgba(228, 0, 124, 0.04));
            border: 2px solid rgba(228, 0, 124, 0.15);
            border-radius: 15px;
            padding: 0.6rem;
            text-align: center;
            animation: slideInDown 0.8s ease-out;
            flex-shrink: 0;
        }

        .appointment-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        /* Sección Cliente */
        .client-section {
            flex: none;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .client-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745, #20c997);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(40, 167, 69, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.9);
            flex-shrink: 0;
        }

        .client-icon i {
            color: white;
            font-size: 1.05rem;
        }

        .client-details {
            flex: 1;
            min-width: 0;
            text-align: left;
        }

        .client-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #28a745;
            letter-spacing: 0.5px;
            margin-bottom: 0.1rem;
        }

        .client-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: #333;
            line-height: 1.2;
            word-wrap: break-word;
        }

        /* Estado */
        .status-section {
            align-items: flex-start;
            gap: 0.3rem;
            padding-left: 0.5rem;
        }

        .status-badge {
            padding: 0.25rem 0.55rem;
            font-size: 0.65rem;
            border-radius: 20px;
            font-weight: 700;
            text-transform: capitalize;
            letter-spacing: 0.6px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 0.4rem;
            white-space: nowrap;
        }

        .status-pendiente {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
            border: 2px solid #42a5f5;
        }

        .status-en-proceso {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #ef6c00;
            border: 2px solid #ffb74d;
        }

        .status-finalizada {
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
            color: #2e7d32;
            border: 2px solid #66bb6a;
        }

        .status-cancelada {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
            border: 2px solid #ef5350;
        }

        /* Info Sections */
        .info-sections {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            min-height: 0;
            overflow: hidden;
        }

        .info-section {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 0.5rem;
            border: 1px solid rgba(228, 0, 124, 0.1);
            box-shadow: 0 4px 12px rgba(228, 0, 124, 0.08);
        }

        .section-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #7B2A8D;
            letter-spacing: 0.5px;
            margin-bottom: 0.35rem;
            padding-bottom: 0.2rem;
            border-bottom: 2px solid rgba(228, 0, 124, 0.15);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .section-title i {
            color: #E4007C;
            font-size: 0.75rem;
        }

        .section-content {
            display: grid;
            gap: 0.45rem;
        }

        .schedule-section .section-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.45rem;
        }

        .schedule-section .info-card {
            min-height: 110px;
        }

        /* Sección de Servicios */
        .service-info-section .section-content {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 0.45rem;
        }

        .service-info-section .info-card {
            min-height: 110px;
            min-width: 0;
            width: 100%;
        }

        .service-info-section {
            margin: 0 -0.8rem;
            padding: 0.4rem 0.8rem;
        }

        /* Sección de Personas */
        .people-section .section-content {
            grid-template-columns: 1fr 1fr;
        }

        .people-section.with-notes .section-content {
            grid-template-columns: 1fr 2fr;
        }

        /* Info Cards */
        .info-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 0.55rem;
            border-left: 3px solid #E4007C;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            gap: 0.35rem;
            margin-bottom: 0.35rem;
        }

        .card-icon {
            width: 23px;
            height: 23px;
            border-radius: 6px;
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.1), rgba(123, 42, 141, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(228, 0, 124, 0.2);
            flex-shrink: 0;
        }

        .card-icon i {
            color: #E4007C;
            font-size: 0.75rem;
        }

        .card-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #7B2A8D;
            letter-spacing: 0.2px;
        }

        .card-value {
            font-size: 0.85rem;
            font-weight: 500;
            color: #333;
            line-height: 1.4;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        /* DateTime Card Especial */
        .datetime-card {
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.05), rgba(123, 42, 141, 0.02));
            border-left: 4px solid #7B2A8D;
        }

        .datetime-display {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.7rem;
            flex: 1;
        }

        .date-section, .time-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.35rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            flex: 1;
            border: 1px solid rgba(228, 0, 124, 0.1);
        }

        .date-day {
            font-size: 1.2rem;
            font-weight: 700;
            color: #E4007C;
            line-height: 1;
        }

        .date-month {
            font-size: 0.6rem;
            color: #7B2A8D;
            font-weight: 600;
            text-transform: capitalize;
            margin-top: 0.1rem;
        }

        .date-weekday {
            font-size: 0.5rem;
            color: #666;
            margin-top: 0.1rem;
        }

        .time-display {
            font-size: 1.1rem;
            font-weight: 700;
            color: #7B2A8D;
            line-height: 1;
        }

        .time-label {
            font-size: 0.6rem;
            color: #666;
            margin-top: 0.1rem;
            font-weight: 600;
        }

        /* Special Cards */
        .price-card .card-value {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            align-items: center;
        }

        .price-amount {
            font-size: 1.1rem;
            font-weight: 700;
            color: #059669;
        }

        .price-currency {
            color: #047857;
            font-weight: 600;
            font-size: 0.65rem;
        }

        .duration-badge {
            background: linear-gradient(135deg, #fef3c7, #fcd34d);
            color: #92400e;
            padding: 0.8rem 1.2rem;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 700;
            border: 2px solid #f59e0b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            min-width: 110px;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        /* Contact in Card */
        .contact-card .card-value {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
        }

        .client-name-text {
            font-weight: 700;
            color: #28a745;
            text-align: center;
            font-size: 0.85rem;
        }

        a[href^="tel:"] {
            color: #059669;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.75rem;
            word-wrap: break-word;
            word-break: break-word;
        }

        a[href^="tel:"]:hover {
            color: #047857;
            transform: scale(1.02);
        }

        /* Notes Card Inline */
        .notes-card-inline {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.06), rgba(79, 70, 229, 0.02));
            border-left: 3px solid #6366f1;
        }

        .notes-card-inline .card-icon i {
            color: #6366f1;
        }

        /* Notes Card Simple - Sin botones */
        .notes-value-simple {
            background: rgba(255, 255, 255, 0.9);
            padding: 0.6rem;
            border-radius: 8px;
            border: 2px solid rgba(99, 102, 241, 0.1);
            font-style: italic;
            line-height: 1.4;
            font-size: 0.8rem;
            color: #555;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            text-align: left;
            min-height: 60px;
            display: flex;
            align-items: flex-start;
        }
        /* Estilos para observaciones con botones de navegación */
        .notes-wrapper-buttons {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            border: 2px solid rgba(99, 102, 241, 0.1);
        }


        .notes-text-movable {
            transition: transform 0.3s ease;
        }

        /* Actions */
        .actions-section {
            display: flex;
            justify-content: flex-start;
            padding: 0.4rem 0;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
            position: sticky;
            bottom: 2rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 0 0 15px 15px;
            margin: 0 -0.6rem -0.6rem -0.6rem;
            padding-left: 0.6rem;
            padding-right: 0.6rem;
        }

        .btn-beauty {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(228, 0, 124, 0.3);
            text-transform: none;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 10;
        }

        .btn-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228, 0, 124, 0.5);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .service-info-section .section-content {
                grid-template-columns: 1fr 1fr 1fr;
            }

            .schedule-section .section-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 900px) {
            .service-info-section .section-content,
            .people-section .section-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            html {
                overflow: auto !important;
            }

            body {
                overflow-y: auto !important;
                padding: 0.3rem;
            }

            .container {
                height: auto;
                min-height: calc(100vh - 0.6rem);
                overflow: visible;
                padding: 0.5rem;
            }

            .appointment-content {
                overflow: visible;
            }

            .beauty-header h2 {
                font-size: 1.1rem;
            }

            .appointment-info {
                align-items: flex-start;
                gap: 0.4rem;
            }

            .client-section {
                flex: none;
                display: flex;
                align-items: center;
                gap: 0.4rem;
            }

            .datetime-display {
                flex-direction: column;
                gap: 0.4rem;
            }

            .actions-section {
                justify-content: center;
                position: relative;
                margin: 0;
                padding: 0.4rem 0;
                border-radius: 0;
                background: transparent;
                backdrop-filter: none;
            }

            .info-sections {
                overflow-y: visible;
            }
        }

        @media (max-width: 480px) {
            .beauty-header h2 {
                font-size: 1rem;
                flex-direction: column;
                gap: 4px;
            }

            .card-header {
                flex-direction: column;
                text-align: center;
                gap: 0.25rem;
            }

            .btn-beauty {
                width: 100%;
                justify-content: center;
                padding: 0.5rem 1rem;
                font-size: 0.75rem;
            }

            .client-name {
                font-size: 1rem;
            }

            .card-label {
                font-size: 0.7rem;
            }
        }

        /* Loading animations */
        .info-section {
            animation: slideInUp 0.6s ease-out;
            animation-fill-mode: both;
            opacity: 0;
        }

        .info-section:nth-child(1) { animation-delay: 0.1s; }
        .info-section:nth-child(2) { animation-delay: 0.3s; }
        .info-section:nth-child(3) { animation-delay: 0.5s; }
        .info-section:nth-child(4) { animation-delay: 0.7s; }

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
    <div class="beauty-header">
        <h2>
            <i class="fas fa-calendar-check"></i>
            Detalles de la cita
        </h2>
    </div>

    <div class="appointment-content">
        <!-- Header con información principal -->
        <div class="appointment-header">
            <div class="appointment-info">
                <!-- Sección Cliente -->
                <div class="client-section">
                    <div class="client-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="client-details">
                        <div class="client-label">Cliente</div>
                        <div class="client-name">{{ $cita->cliente->nombre ?? 'Cliente no especificado' }}</div>
                    </div>
                </div>

                <!-- Estado -->
                <div class="status-section">
                    @php
                        $statusConfig = [
                            'pendiente' => ['class' => 'status-pendiente', 'icon' => 'fas fa-calendar-plus', 'text' => 'Pendiente'],
                            'en_proceso' => ['class' => 'status-en-proceso', 'icon' => 'fas fa-play-circle', 'text' => 'En Proceso'],
                            'finalizada' => ['class' => 'status-finalizada', 'icon' => 'fas fa-check-double', 'text' => 'Finalizada'],
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

        <div class="info-sections">
            <!-- SECCIÓN 1: PROGRAMACIÓN Y HORARIOS -->
            <div class="info-section schedule-section">
                <div class="section-title">
                    <i class="fas fa-clock"></i>
                    Programación y horarios
                </div>
                <div class="section-content">
                    <!-- Fecha y Horario Completo -->
                    <div class="info-card datetime-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="card-label">Fecha y horario programado</div>
                        </div>
                        <div class="datetime-display">
                            <div class="date-section">
                                <div class="date-day">{{ \Carbon\Carbon::parse($cita->fecha)->format('d') }}</div>
                                <div class="date-month">{{ strtoupper(\Carbon\Carbon::parse($cita->fecha)->locale('es')->format('M Y')) }}</div>
                                @php
                                    $diasSemana = [
                                        'Monday' => 'Lunes',
                                        'Tuesday' => 'Martes',
                                        'Wednesday' => 'Miércoles',
                                        'Thursday' => 'Jueves',
                                        'Friday' => 'Viernes',
                                        'Saturday' => 'Sábado',
                                        'Sunday' => 'Domingo'
                                    ];
                                    $diaIngles = \Carbon\Carbon::parse($cita->fecha)->format('l');
                                    $diaEspanol = $diasSemana[$diaIngles] ?? $diaIngles;
                                @endphp
                                <div class="date-weekday">{{ $diaEspanol }}</div>
                            </div>

                            <div class="time-section">
                                <div class="time-display">{{ \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i') }}</div>
                                <div class="time-label">Hora de inicio</div>
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
                                <div class="time-label">Hora de finalización</div>
                            </div>
                        </div>
                    </div>

                    <!-- Duración del Servicio -->
                    <div class="info-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div class="card-label">Duración estimada</div>
                        </div>
                        <div class="card-value" style="display: flex; justify-content: center;">
                            @php
                                $duracion = $cita->servicio->duracion_estimada ?? 90;
                                $duracionTexto = '';

                                if ($duracion >= 60) {
                                    $horas = floor($duracion / 60);
                                    $minutosRestantes = $duracion % 60;

                                    if ($minutosRestantes == 0) {
                                        $duracionTexto = $horas . ' hora' . ($horas > 1 ? 's' : '');
                                    } else {
                                        $duracionTexto = $horas . 'h ' . $minutosRestantes . 'min';
                                    }
                                } else {
                                    $duracionTexto = $duracion . ' minutos';
                                }
                            @endphp
                            <div class="duration-badge">
                                <i class="fas fa-stopwatch"></i>
                                {{ $duracionTexto }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 2: INFORMACIÓN DEL SERVICIO -->
            <div class="info-section service-info-section">
                <div class="section-title">
                    <i class="fas fa-spa"></i>
                    Información del servicio
                </div>
                <div class="section-content">
                    <!-- Tipo de Servicio -->
                    <div class="info-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="card-label">Tipo de servicio</div>
                        </div>
                        <div class="card-value" style="text-align: center;">
                            <div style="font-weight: 700; color: #E4007C;">
                                {{ $cita->servicio->nombre_servicio ?? 'Servicio no especificado' }}
                            </div>
                        </div>
                    </div>

                    <!-- Costo del Servicio -->
                    <div class="info-card price-card"><div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="card-label">Costo total</div>
                        </div>
                        <div class="card-value">
                            <span class="price-currency">Lempiras</span>
                            <span class="price-amount">L. {{ number_format($cita->precio_final ?? $cita->servicio->precio_base ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <!-- Especialista Asignado -->
                    <div class="info-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="card-label">Especialista asignado</div>
                        </div>
                        <div class="card-value" style="text-align: center; flex-direction: column;">
                            <div style="font-weight: 700; color: #333; margin-bottom: 0.2rem;">
                                {{ $cita->empleado->nombre_empleado ?? 'Por asignar' }}
                            </div>
                            @if($cita->empleado->cargo ?? false)
                                <div style="color: #7B2A8D; font-weight: 500; font-size: 0.7rem;">
                                    {{ $cita->empleado->cargo }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 3: INFORMACIÓN DE CONTACTO -->
            <div class="info-section people-section {{ (!empty($cita->observaciones) && trim($cita->observaciones) !== '') ? 'with-notes' : '' }}">
                <div class="section-title">
                    <i class="fas fa-address-book"></i>
                    Información de contacto
                </div>
                <div class="section-content">
                    <!-- Datos del Cliente con Teléfono -->
                    <div class="info-card contact-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="card-label">Teléfono </div>
                        </div>
                        <div class="card-value">
                            <div class="client-name-text">
                                {{ $cita->cliente->nombre ?? 'Cliente no especificado' }}
                            </div>
                            @if($cita->cliente->telefono ?? false)
                                <a href="tel:{{ $cita->cliente->telefono }}">
                                    <i class="fas fa-phone"></i>
                                    {{ $cita->cliente->telefono }}
                                </a>
                            @else
                                <div style="color: #999; font-style: italic; font-size: 0.8rem;">
                                    Sin teléfono registrado
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Observaciones (Solo si existen) -->
                    @if(!empty($cita->observaciones) && trim($cita->observaciones) !== '')
                        <div class="info-card notes-card-inline">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-sticky-note"></i>
                                </div>
                                <div class="card-label">Observaciones</div>
                            </div>
                            <div class="notes-value-simple">
                                {{ $cita->observaciones }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
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
        // Navegación de observaciones con botones
        let scrollPosition = 0;

        window.scrollNotes = function(direction) {
            const notesText = document.getElementById('notesText');
            const container = document.querySelector('.notes-content-scrollable');
            const upBtn = document.getElementById('scrollUpBtn');
            const downBtn = document.getElementById('scrollDownBtn');

            if (!notesText || !container) return;

            const maxScroll = notesText.scrollHeight - container.clientHeight;

            if (direction === 'up') {
                scrollPosition = Math.max(0, scrollPosition - 25);
            } else {
                scrollPosition = Math.min(maxScroll, scrollPosition + 25);
            }

            notesText.style.transform = `translateY(-${scrollPosition}px)`;

            // Actualizar estado de botones
            upBtn.disabled = scrollPosition <= 0;
            downBtn.disabled = scrollPosition >= maxScroll;
        };

        // Inicializar estado de botones al cargar la página
        const notesText = document.getElementById('notesText');
        const container = document.querySelector('.notes-content-scrollable');
        const upBtn = document.getElementById('scrollUpBtn');
        const downBtn = document.getElementById('scrollDownBtn');

        if (notesText && container && upBtn && downBtn) {
            const maxScroll = notesText.scrollHeight - container.clientHeight;
            upBtn.disabled = true; // Inicialmente en la parte superior
            downBtn.disabled = maxScroll <= 0; // Si no hay contenido que hacer scroll
        }


    });
</script>
</body>
</html>