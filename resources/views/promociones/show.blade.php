<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de la Promoción - Salón de Belleza</title>
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

        /* Promotion Header */
        .promotion-header {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.08), rgba(228, 0, 124, 0.04));
            border: 2px solid rgba(228, 0, 124, 0.15);
            border-radius: 15px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 1rem;
            position: relative;
            flex-shrink: 0;
        }

        .promotion-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .promotion-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(228, 0, 124, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.8);
            flex-shrink: 0;
        }

        .promotion-avatar i {
            color: white;
            font-size: 1.5rem;
        }

        .promotion-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #7B2A8D;
            margin: 0;
        }

        /* Scrollable Content */
        .profile-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
            overflow: hidden;
        }

        .scroll-container {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 12px;
            margin-right: -12px;
            position: relative;
        }

        /* Custom Scrollbar */
        .scroll-container::-webkit-scrollbar {
            width: 12px;
        }

        .scroll-container::-webkit-scrollbar-track {
            background: linear-gradient(180deg, rgba(228, 0, 124, 0.08), rgba(123, 42, 141, 0.08));
            border-radius: 10px;
            margin: 5px 0;
            border: 1px solid rgba(228, 0, 124, 0.15);
        }

        .scroll-container::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #E4007C, #7B2A8D);
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 2px 8px rgba(228, 0, 124, 0.3);
        }

        .scroll-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #c3006a, #6a267f);
            box-shadow: 0 3px 12px rgba(228, 0, 124, 0.5);
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.9), rgba(123, 42, 141, 0.9));
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(228, 0, 124, 0.4);
            animation: bounce 2s infinite;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            pointer-events: none;
        }

        .scroll-indicator.visible {
            opacity: 1;
            pointer-events: auto;
        }

        .scroll-indicator:hover {
            transform: translateX(-50%) translateY(-2px);
            box-shadow: 0 6px 20px rgba(228, 0, 124, 0.6);
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* Main Grid */
        .main-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            padding: 0.5rem 0;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 1rem;
            border-left: 4px solid #E4007C;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-height: 120px;
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
            margin-bottom: 0.8rem;
        }

        .card-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            box-shadow: 0 4px 10px rgba(228, 0, 124, 0.3);
            flex-shrink: 0;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #7B2A8D;
            margin: 0;
        }

        .card-content {
            font-size: 0.9rem;
            color: #333;
            line-height: 1.4;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.35rem 0.7rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: capitalize;
        }

        .badge-tipo-porcentaje {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05));
            color: #92400e;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-tipo-monto_fijo {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-tipo-combo {
            background: linear-gradient(135deg, rgba(139, 69, 19, 0.15), rgba(139, 69, 19, 0.05));
            color: #78350f;
            border: 1px solid rgba(139, 69, 19, 0.3);
        }

        .badge-servicios {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(59, 130, 246, 0.05));
            color: #1e40af;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .badge-productos {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(168, 85, 247, 0.05));
            color: #6b21a8;
            border: 1px solid rgba(168, 85, 247, 0.3);
        }

        .badge-activo {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-inactivo {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
            color: #7f1d1d;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .badge-combinable-si {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(34, 197, 94, 0.05));
            color: #14532d;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-combinable-no {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
            color: #7f1d1d;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Value displays */
        .value-display {
            margin: 0.5rem 0;
            text-align: center;
        }

        .value-number {
            font-size: 1.6rem;
            font-weight: 800;
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
            margin-bottom: 0.2rem;
            line-height: 1;
        }

        .value-unit {
            font-size: 0.7rem;
            color: #666;
            font-weight: 600;
        }

        /* Date displays */
        .date-display {
            text-align: center;
            margin: 0.3rem 0;
        }

        .date-main {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1d4ed8;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            border: 1px solid #3b82f6;
            display: inline-block;
            margin-bottom: 0.3rem;
        }

        .date-day {
            font-size: 0.65rem;
            color: #666;
            font-weight: 500;
        }

        /* Control de Uso Mejorado */
        .usage-display {
            text-align: center;
            padding: 0.5rem 0;
        }

        .usage-circle-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0.5rem 0;
            position: relative;
        }

        .usage-circle {
            width: 90px;
            height: 90px;
            position: relative;
        }

        .usage-circle svg {
            transform: rotate(-90deg);
        }

        .usage-circle-bg {
            fill: none;
            stroke: #e2e8f0;
            stroke-width: 8;
        }

        .usage-circle-progress {
            fill: none;
            stroke: url(#gradient);
            stroke-width: 8;
            stroke-linecap: round;
            transition: stroke-dashoffset 1s ease-in-out;
        }

        .usage-circle-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .usage-percentage {
            font-size: 1.4rem;
            font-weight: 800;
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
            line-height: 1;
        }

        .usage-label {
            font-size: 0.6rem;
            color: #666;
            margin-top: 0.2rem;
        }

        .usage-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 0.8rem;
            gap: 0.5rem;
        }

        .usage-stat {
            flex: 1;
            text-align: center;
            padding: 0.4rem;
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.05), rgba(123, 42, 141, 0.05));
            border-radius: 8px;
            border: 1px solid rgba(228, 0, 124, 0.1);
        }

        .usage-stat-value {
            font-size: 1rem;
            font-weight: 700;
            color: #7B2A8D;
        }

        .usage-stat-label {
            font-size: 0.6rem;
            color: #666;
            margin-top: 0.2rem;
        }

        /* Items Aplicables Section */
        .items-section {
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.03), rgba(123, 42, 141, 0.03));
            border-radius: 12px;
            padding: 1rem;
            border: 2px dashed rgba(228, 0, 124, 0.2);
            margin: 1rem 0;
        }

        .items-title {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1rem;
            font-size: 1rem;
            font-weight: 700;
            color: #7B2A8D;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 0.8rem;
        }

        .item-card {
            background: white;
            border-radius: 8px;
            padding: 0.8rem;
            border-left: 3px solid #E4007C;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }

        .item-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(228, 0, 124, 0.12);
            border-left-color: #7B2A8D;
        }

        .item-name {
            font-weight: 700;
            color: #1a202c;
            font-size: 0.85rem;
            margin-bottom: 0.4rem;
            line-height: 1.3;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.7rem;
            color: #666;
        }

        .item-price {
            font-weight: 700;
            color: #059669;
            font-size: 0.75rem;
        }

        /* Description section */
        .description-section {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.03), rgba(99, 102, 241, 0.03));
            border-radius: 12px;
            padding: 1rem;
            border: 2px solid rgba(59, 130, 246, 0.1);
            margin: 1rem 0;
        }

        .description-title {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 0.8rem;
            font-size: 1rem;
            font-weight: 700;
            color: #1e40af;
        }

        .description-text {
            font-size: 0.85rem;
            line-height: 1.6;
            color: #4a5568;
            text-align: justify;
        }

        /* Actions */
        .actions-section {
            display: flex;
            justify-content: flex-start;
            padding: 1rem 0 0 0;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
            margin-top: 0.5rem;
        }

        .btn-beauty {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.8rem 1.5rem;
            background: linear-gradient(135deg, #7B2A8D, #E4007C);
            color: white;
            text-decoration: none;
            border-radius: 18px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(228, 0, 124, 0.3);
        }

        .btn-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(228, 0, 124, 0.4);
            color: white;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .promotion-info {
                flex-direction: column;
            }

            .actions-section {
                justify-content: center;
            }
        }

        /* Loading animations */
        .info-card, .items-section, .description-section {
            animation: slideInUp 0.6s ease-out;
            animation-fill-mode: both;
            opacity: 0;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-card:nth-child(1) { animation-delay: 0.1s; }
        .info-card:nth-child(2) { animation-delay: 0.2s; }
        .info-card:nth-child(3) { animation-delay: 0.3s; }
        .info-card:nth-child(4) { animation-delay: 0.4s; }
        .info-card:nth-child(5) { animation-delay: 0.5s; }
        .items-section { animation-delay: 0.6s; }
        .description-section { animation-delay: 0.7s; }

        /* Status badge positioning */
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.7rem;
            z-index: 10;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="beauty-header">
        <h2>
            <i class="fas fa-tags"></i>
            Perfil de la Promoción
        </h2>
    </div>

    <!-- Promotion Header -->
    <div class="promotion-header">
        <div class="promotion-info">
            <div class="promotion-avatar">
                <i class="fas fa-tags"></i>
            </div>
            <div>
                <div class="promotion-name">{{ $promocion->nombre ?? 'Combo Mixto Especial' }}</div>
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="scroll-container" id="scrollContainer">
            <!-- Main Content Grid -->
            <div class="main-grid">
                <!-- Información del Tipo y Valor -->
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            @if(($promocion->tipo ?? 'combo') == 'porcentaje')
                                <i class="fas fa-percent"></i>
                            @elseif(($promocion->tipo ?? 'combo') == 'monto_fijo')
                                <i class="fas fa-dollar-sign"></i>
                            @else
                                <i class="fas fa-gift"></i>
                            @endif
                        </div>
                        <div class="card-title">Tipo y Valor</div>
                    </div>
                    <div class="card-content">
                        <div class="badge badge-tipo-{{ $promocion->tipo ?? 'combo' }}">
                            {{ ucfirst(str_replace('_', ' ', $promocion->tipo ?? 'combo')) }}
                        </div>
                        <div class="value-display">
                            @if(($promocion->tipo ?? 'combo') == 'porcentaje')
                                <span class="value-number">{{ $promocion->valor ?? 20 }}%</span>
                                <span class="value-unit">descuento</span>
                            @elseif(($promocion->tipo ?? 'combo') == 'monto_fijo')
                                <span class="value-number">L. {{ number_format($promocion->valor ?? 50, 2) }}</span>
                                <span class="value-unit">descuento</span>
                            @else
                                <span class="value-number">L. {{ number_format($promocion->valor ?? 357, 2) }}</span>
                                <span class="value-unit">precio combo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Aplicación y Estado -->
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div class="card-title">Aplicación y estado</div>
                    </div>
                    <div class="card-content">
                        <div style="margin-bottom: 1rem;">
                            <strong style="font-size: 0.8rem; color: #7B2A8D;">Aplica a:</strong>
                            <div class="badge badge-{{ $promocion->aplica_a ?? 'servicios' }}" style="margin-top: 0.4rem;">
                                <i class="fas fa-{{ ($promocion->aplica_a ?? 'servicios') == 'servicios' ? 'cogs' : 'box' }}"></i>
                                {{ ucfirst($promocion->aplica_a ?? 'servicios') }}
                            </div>
                        </div>
                        <div>
                            <strong style="font-size: 0.8rem; color: #7B2A8D;">Estado:</strong>
                            <div class="badge badge-{{ $promocion->estado ?? 'activo' }}" style="margin-top: 0.4rem;">
                                <i class="fas fa-circle"></i>
                                {{ ucfirst($promocion->estado ?? 'activo') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requisitos -->
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-title">Requisitos</div>
                    </div>
                    <div class="card-content">
                        <div style="margin-bottom: 1rem;">
                            <strong style="font-size: 0.8rem; color: #7B2A8D;">Monto mínimo:</strong>
                            @if(($promocion->monto_minimo ?? 50) > 0)
                                <div class="value-display" style="margin: 0.4rem 0;">
                                    <span class="value-number" style="font-size: 1.3rem;">L. {{ number_format($promocion->monto_minimo ?? 50, 2) }}</span>
                                    <span class="value-unit">requerido</span>
                                </div>
                            @else
                                <div style="color: #059669; font-weight: 600; margin-top: 0.4rem; font-size: 0.75rem;">
                                    <i class="fas fa-check-circle"></i> Sin monto mínimo
                                </div>
                            @endif
                        </div>

                        <div>
                            <strong style="font-size: 0.8rem; color: #7B2A8D;">Combinable:</strong>
                            <div class="badge badge-combinable-{{ $promocion->combinable ?? 'no' }}" style="margin-top: 0.4rem;">
                                @if(($promocion->combinable ?? 'no') == 'si')
                                    <i class="fas fa-check"></i> Sí
                                @else
                                    <i class="fas fa-times"></i> No
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fechas de Vigencia -->
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="card-title">Vigencia</div>
                    </div>
                    <div class="card-content">
                        @php
                            $fechaInicio = $promocion->fecha_inicio ?? '2025-09-29';
                            $fechaExpiracion = $promocion->fecha_expiracion ?? '2025-10-01';
                            $inicioFormatted = date('d/m/Y', strtotime($fechaInicio));
                            $expiracionFormatted = date('d/m/Y', strtotime($fechaExpiracion));
                            $diasSemana = ['Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado', 'Sunday' => 'Domingo'];
                            $diaInicio = $diasSemana[date('l', strtotime($fechaInicio))] ?? date('l', strtotime($fechaInicio));
                            $diaExpiracion = $diasSemana[date('l', strtotime($fechaExpiracion))] ?? date('l', strtotime($fechaExpiracion));
                        @endphp

                        <div style="margin-bottom: 0.8rem;">
                            <strong style="font-size: 0.8rem; color: #7B2A8D;">Inicio:</strong>
                            <div class="date-display">
                                <div class="date-main">{{ $inicioFormatted }}</div>
                                <div class="date-day">{{ $diaInicio }}</div>
                            </div>
                        </div>

                        <div>
                            <strong style="font-size: 0.8rem; color: #7B2A8D;">Expira:</strong>
                            <div class="date-display">
                                <div class="date-main">{{ $expiracionFormatted }}</div>
                                <div class="date-day">{{ $diaExpiracion }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Control de Uso Mejorado -->
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="card-title">Control de uso</div>
                    </div>
                    <div class="card-content">
                        @php
                            $usoActual = $promocion->uso_actual ?? 0;
                            $usoMaximo = $promocion->uso_maximo ?? 36;
                            $porcentajeUso = $usoMaximo > 0 ? ($usoActual / $usoMaximo) * 100 : 0;
                            $circunferencia = 2 * 3.14159 * 36;
                            $offset = $circunferencia - ($circunferencia * $porcentajeUso / 100);
                        @endphp

                        <div class="usage-display">
                            <div class="usage-circle-container">
                                <div class="usage-circle">
                                    <svg width="90" height="90" viewBox="0 0 90 90">
                                        <defs>
                                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" style="stop-color:#E4007C;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#7B2A8D;stop-opacity:1" />
                                            </linearGradient>
                                        </defs>
                                        <circle class="usage-circle-bg" cx="45" cy="45" r="36"></circle>
                                        <circle class="usage-circle-progress" cx="45" cy="45" r="36"
                                                stroke-dasharray="{{ $circunferencia }}"
                                                stroke-dashoffset="{{ $offset }}"></circle>
                                    </svg>
                                    <div class="usage-circle-text">
                                        <span class="usage-percentage">{{ round($porcentajeUso, 1) }}%</span>
                                        <div class="usage-label">usado</div>
                                    </div>
                                </div>
                            </div>
                            <div class="usage-stats">
                                <div class="usage-stat">
                                    <div class="usage-stat-value">{{ $usoActual }}</div>
                                    <div class="usage-stat-label">Usos</div>
                                </div>
                                <div class="usage-stat">
                                    <div class="usage-stat-value">{{ $usoMaximo }}</div>
                                    <div class="usage-stat-label">Máximo</div>
                                </div>
                                <div class="usage-stat">
                                    <div class="usage-stat-value">{{ $promocion->uso_por_cliente ?? 2 }}</div>
                                    <div class="usage-stat-label">Por cliente</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Servicios/Productos Incluidos o Aplicables -->
                <div class="info-card" style="grid-column: 1 / -1;">
                    <div class="card-header">
                        <div class="card-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <div class="card-title">
                            @if(($promocion->aplica_a ?? 'servicios') == 'servicios')
                                Servicios Incluidos o aplicables
                            @else
                                Productos Incluidos o aplicables
                            @endif
                        </div>
                    </div>

                    <div class="card-content">
                        @php
                            // ✅ INTENTAR OBTENER ITEMS REALES DE LA BASE DE DATOS
                            $items = collect();

                            if (($promocion->aplica_a ?? 'servicios') == 'servicios') {
                                // Para servicios: primero desde relación
                                if (isset($promocion->servicios) && $promocion->servicios->count() > 0) {
                                    $items = $promocion->servicios;
                                }
                                // Segundo: buscar por IDs en items_incluidos
                                elseif (isset($promocion->items_incluidos) && !empty($promocion->items_incluidos)) {
                                    $itemsIds = is_array($promocion->items_incluidos)
                                        ? $promocion->items_incluidos
                                        : explode(',', $promocion->items_incluidos);

                                    $itemsIds = array_filter(array_map('trim', $itemsIds), function($id) {
                                        return is_numeric($id) && $id > 0;
                                    });

                                    if (!empty($itemsIds)) {
                                        try {
                                            $items = \App\Models\Servicio::whereIn('id', $itemsIds)->get();
                                        } catch (\Exception $e) {
                                            // Si hay error en la consulta, items queda vacío
                                        }
                                    }
                                }
                            } else {
                                // Para productos: primero desde relación
                                if (isset($promocion->productos) && $promocion->productos->count() > 0) {
                                    $items = $promocion->productos;
                                }
                                // Segundo: buscar por IDs en items_incluidos
                                elseif (isset($promocion->items_incluidos) && !empty($promocion->items_incluidos)) {
                                    $itemsIds = is_array($promocion->items_incluidos)
                                        ? $promocion->items_incluidos
                                        : explode(',', $promocion->items_incluidos);

                                    $itemsIds = array_filter(array_map('trim', $itemsIds), function($id) {
                                        return is_numeric($id) && $id > 0;
                                    });

                                    if (!empty($itemsIds)) {
                                        try {
                                            $items = \App\Models\Producto::whereIn('id', $itemsIds)->get();
                                        } catch (\Exception $e) {
                                            // Si hay error en la consulta, items queda vacío
                                        }
                                    }
                                }
                            }
                        @endphp

                        @if($items->count() > 0)
                            <div class="services-grid" style="max-height: 180px; padding-top: 0.3rem; margin-top: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.8rem; overflow-y: auto;">
                                @foreach($items as $item)
                                    <div class="service-item">
                                        <div class="service-name">{{ $item->nombre ?? $item->nombre_servicio ?? 'Ítem sin nombre' }}</div>
                                        <div class="service-details">
                                            <span class="service-price">L. {{ number_format($item->precio_base ?? $item->precio ?? 0, 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align: center; padding: 1.5rem; background: linear-gradient(135deg, rgba(239, 68, 68, 0.05), rgba(220, 38, 38, 0.02)); border: 2px dashed rgba(239, 68, 68, 0.2); border-radius: 12px; margin-top: 0.5rem;">
                                <i class="fas fa-info-circle" style="font-size: 2rem; color: #dc2626; margin-bottom: 0.5rem;"></i>
                                <p style="color: #7f1d1d; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.3rem;">
                                    No hay {{ ($promocion->aplica_a ?? 'servicios') == 'servicios' ? 'servicios' : 'productos' }} asociados
                                </p>
                                <p style="color: #991b1b; font-size: 0.75rem;">
                                    Configure los items en la edición de la promoción
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Descripción -->
                <div class="info-card" style="grid-column: 1 / -1;">
                    <div class="card-header">
                        <div class="card-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                            <i class="fas fa-align-left"></i>
                        </div>
                        <div class="card-title">Descripción</div>
                    </div>
                    <div class="card-content">
                        <div class="description-text" style="max-height: 150px; padding-right: 0.5rem; overflow-y: auto; font-size: 0.85rem; line-height: 1.6; color: #4a5568; text-align: justify;">
                            {{ $promocion->descripcion ?? 'No se proporcionó una descripción para esta promoción.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator" id="scrollIndicator">
            <i class="fas fa-chevron-down"></i>
            Desliza para ver
        </div>

        <!-- Actions -->
        <div class="actions-section">
            <a href="{{ route('promociones.index') }}" class="btn-beauty">
                <i class="fas fa-arrow-left"></i>
                Volver al listado
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll indicator functionality
        const scrollContainer = document.getElementById('scrollContainer');
        const scrollIndicator = document.getElementById('scrollIndicator');

        function checkScroll() {
            if (scrollContainer) {
                const scrollTop = scrollContainer.scrollTop;
                const scrollHeight = scrollContainer.scrollHeight;
                const clientHeight = scrollContainer.clientHeight;
                const scrollBottom = scrollHeight - scrollTop - clientHeight;

                // Show indicator if there's content below (more than 50px)
                if (scrollBottom > 50 && scrollTop < 100) {
                    scrollIndicator.classList.add('visible');
                } else {
                    scrollIndicator.classList.remove('visible');
                }
            }
        }

        // Check scroll on load
        setTimeout(checkScroll, 500);

        // Check scroll on scroll event
        if (scrollContainer) {
            scrollContainer.addEventListener('scroll', checkScroll);
        }

        // Click on indicator to scroll down
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', function() {
                scrollContainer.scrollBy({
                    top: 300,
                    behavior: 'smooth'
                });
            });
        }

        // Check promotion status and add visual indicators
        @php
            $fechaExpiracion = $promocion->fecha_expiracion ?? '2025-10-01';
            $fechaActual = date('Y-m-d');
            $isExpired = strtotime($fechaExpiracion) < strtotime($fechaActual);
            $diasParaExpirar = (strtotime($fechaExpiracion) - strtotime($fechaActual)) / (60 * 60 * 24);
        @endphp

        const promotionHeader = document.querySelector('.promotion-header');
        if (promotionHeader) {
            @if($isExpired)
                promotionHeader.style.background = 'linear-gradient(135deg, rgba(239, 68, 68, 0.08), rgba(220, 38, 38, 0.04))';
            promotionHeader.style.borderColor = 'rgba(239, 68, 68, 0.2)';

            const expiredBadge = document.createElement('div');
            expiredBadge.className = 'badge badge-inactivo status-badge';
            expiredBadge.innerHTML = '<i class="fas fa-exclamation-triangle"></i> EXPIRADA';
            promotionHeader.appendChild(expiredBadge);
            @elseif($diasParaExpirar > 0 && $diasParaExpirar <= 7)
            const warningBadge = document.createElement('div');
            warningBadge.className = 'badge status-badge';
            warningBadge.style.background = 'linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05))';
            warningBadge.style.color = '#78350f';
            warningBadge.style.border = '1px solid rgba(245, 158, 11, 0.3)';
            warningBadge.innerHTML = '<i class="fas fa-clock"></i> EXPIRA PRONTO';
            promotionHeader.appendChild(warningBadge);
            @endif
        }

        // Animate progress circle
        const progressCircle = document.querySelector('.usage-circle-progress');
        if (progressCircle) {
            const finalOffset = progressCircle.getAttribute('stroke-dashoffset');
            const circunferencia = progressCircle.getAttribute('stroke-dasharray');
            progressCircle.setAttribute('stroke-dashoffset', circunferencia);

            setTimeout(() => {
                progressCircle.style.strokeDashoffset = finalOffset;
            }, 500);
        }

        // Item cards hover effects
        const itemCards = document.querySelectorAll('.item-card');
        itemCards.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.02)';
                this.style.borderLeftColor = '#7B2A8D';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.borderLeftColor = '#E4007C';
            });
        });

        // Smooth scroll behavior
        if (scrollContainer) {
            scrollContainer.style.scrollBehavior = 'smooth';
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.location.href = "{{ route('promociones.index') }}";
            }
        });

        // Button effects
        const buttons = document.querySelectorAll('.btn-beauty');
        buttons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });

        console.log('✅ Vista de promoción cargada exitosamente');
    });
</script>
</body>
</html>