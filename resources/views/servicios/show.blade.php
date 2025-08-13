<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Servicio - Salón de Belleza</title>
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
        .profile-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            min-height: 0;
            overflow: hidden;
        }

        /* Service Header */
        .service-header {
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

        .service-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
        }

        .service-avatar {
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

        .service-avatar i {
            color: white;
            font-size: 1.6rem;
        }

        .service-details {
            text-align: left;
            flex: 1;
            min-width: 0;
        }

        .service-name {
            font-size: 1.6rem;
            font-weight: 700;
            color: #7B2A8D;
            margin-bottom: 0.3rem;
            line-height: 1.2;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            display: block;
        }

        @media (min-width: 500px) {
            .service-name {
                text-align: center;
            }
        }

        .service-name.long-name {
            white-space: normal;
            overflow: visible;
            text-overflow: unset;
            text-align: left;
        }

        /* Info Grid */
        .info-grid {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.8rem;
            min-height: 0;
            overflow: hidden;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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

        /* Special Cards */
        .price-card .card-value {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .price-number {
            font-size: 1.6rem;
            font-weight: 700;
            color: #059669;
        }

        .price-currency {
            color: #047857;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .duration-card .card-value {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .duration-number {
            font-size: 1.6rem;
            font-weight: 700;
            color: #d97706;
        }

        .duration-text {
            color: #92400e;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .duration-formatted {
            background: linear-gradient(135deg, #fef3c7, #fcd34d);
            color: #92400e;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: none;
            border: 1px solid #f59e0b;
        }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.4rem 0.7rem;
            border-radius: 18px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: capitalize;
        }

        .status-activo {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
            color: #065f46;
            border: 2px solid rgba(16, 185, 129, 0.3);
        }

        .status-inactivo {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
            color: #7f1d1d;
            border: 2px solid rgba(239, 68, 68, 0.3);
        }

        .status-temporalmente_suspendido {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05));
            color: #78350f;
            border: 2px solid rgba(245, 158, 11, 0.3);
        }

        /* Type and Category badges */
        .type-badge, .category-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.6rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: capitalize;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05));
            color: #3730a3;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        /* Description Card */
        .description-card {
            grid-column: 1 / -1;
        }

        .description-value {
            background: rgba(248, 250, 252, 0.9);
            padding: 0.8rem;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            font-style: italic;
            line-height: 1.4;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            word-wrap: break-word;
            word-break: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 120px;
            overflow-y: auto;
        }

        /* Actions */
        .actions-section {
            display: flex;
            justify-content: flex-start;
            padding: 0.8rem 0;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
            position: sticky;
            bottom: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 0 0 15px 15px;
            margin: 0 -1.2rem -1.2rem -1.2rem;
            padding-left: 1.2rem;
            padding-right: 1.2rem;
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
            background: linear-gradient(135deg, #9017b8 0%, #521396 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(144, 23, 184, 0.3);
            text-transform: none;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 10;
        }

        .btn-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(144, 23, 184, 0.5);
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

            .service-info {
                flex-direction: column;
                gap: 0.8rem;
            }

            .service-details {
                text-align: center;
            }

            .service-name {
                font-size: 1.4rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
                overflow-y: visible;
            }

            .price-card .card-value, .duration-card .card-value {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.4rem;
            }

            .actions-section {
                justify-content: center;
            }

            .card-label {
                font-size: 0.95rem;
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

            .card-label {
                font-size: 0.9rem;
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
        .info-card:nth-child(7) { animation-delay: 0.7s; }

        /* Accessibility */
        .btn-beauty:focus {
            outline: 3px solid rgba(144, 23, 184, 0.5);
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
            <i class="fas fa-cut"></i>
            Perfil del Servicio
        </h2>
    </div>

    <!-- Profile Content -->
    <div class="profile-content">
        <!-- Service Header -->
        <div class="service-header">
            <div class="service-info">
                <div class="service-avatar">
                    <i class="fas fa-spa"></i>
                </div>
                <div class="service-details">
                    <div class="service-name">{{ $servicio->nombre_servicio ?? 'Corte y Peinado Premium' }}</div>
                </div>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <!-- Código del Servicio -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-hashtag"></i>
                    </div>
                    <div class="card-label">Código</div>
                </div>
                <div class="card-value">{{ $servicio->codigo_servicio ?? 'SVC-001' }}</div>
            </div>

            <!-- Tipo de Servicio -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="card-label">Tipo</div>
                </div>
                <div class="card-value">
                    <div class="type-badge">
                        <i class="fas fa-tag"></i>
                        {{ ucfirst($servicio->tipo_servicio ?? 'premium') }}
                    </div>
                </div>
            </div>

            <!-- Categoría -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="card-label">Categoría</div>
                </div>
                <div class="card-value">
                    <div class="category-badge">
                        <i class="fas fa-sitemap"></i>
                        {{ ucfirst($servicio->categoria_servicio ?? 'cabello') }}
                    </div>
                </div>
            </div>

            <!-- Precio -->
            <div class="info-card price-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-label">Precio</div>
                </div>
                <div class="card-value">
                    <span class="price-number">L. {{ number_format($servicio->precio_base ?? 350.00, 2) }}</span>
                    <span class="price-currency">Lempiras</span>
                </div>
            </div>

            <!-- Duración -->
            <div class="info-card duration-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-label">Duración</div>
                </div>
                <div class="card-value">
                    @php
                        $totalMin = $servicio->duracion_estimada ?? 90;
                        $horas = intdiv($totalMin, 60);
                        $minutos = $totalMin % 60;

                        $formatoHorasMin = '';
                        if ($horas > 0) {
                            $formatoHorasMin .= $horas . 'h';
                        }
                        if ($minutos > 0) {
                            $formatoHorasMin .= ($horas > 0 ? ' ' : '') . $minutos . 'min';
                        }
                        if ($horas == 0 && $minutos == 0) {
                            $formatoHorasMin = '0min';
                        }
                    @endphp
                    @if($totalMin >= 60)
                        <span class="duration-number">{{ $formatoHorasMin }}</span>
                        <span class="duration-text">duración</span>
                        <span class="duration-formatted">{{ $totalMin }} min total</span>
                    @else
                        <span class="duration-number">{{ $totalMin }}</span>
                        <span class="duration-text">minutos</span>
                    @endif
                </div>
            </div>

            <!-- Estado -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <div class="card-label">Estado</div>
                </div>
                <div class="card-value">
                    <div class="status-badge status-{{ $servicio->estado ?? 'activo' }}">
                        <i class="fas fa-circle"></i>
                        {{ ucfirst(str_replace('_', ' ', $servicio->estado ?? 'activo')) }}
                    </div>
                </div>
            </div>

            <!-- Descripción -->
            <div class="info-card description-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-align-left"></i>
                    </div>
                    <div class="card-label">Descripción</div>
                </div>
                <div class="description-value">
                    {{ $servicio->descripcion ?? 'Servicio premium de corte y peinado que incluye lavado con productos profesionales, corte personalizado según el tipo de rostro y cabello del cliente, peinado con técnicas modernas y acabado con productos de alta calidad para un resultado duradero y elegante.' }}
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="actions-section">
            <a href="{{ route('servicios.index') }}" class="btn-beauty">
                <i class="fas fa-arrow-left"></i>
                Volver al listado
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceNameElement = document.querySelector('.service-name');
        if (serviceNameElement) {
            const nameLength = serviceNameElement.textContent.trim().length;
            if (nameLength > 25) {
                serviceNameElement.classList.add('long-name');
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Simular volver al listado
                console.log('Volver al listado');
            }
        });

        document.querySelectorAll('.btn-beauty').forEach(btn => {
            btn.addEventListener('click', function() {
                this.style.opacity = '0.8';
                setTimeout(() => this.style.opacity = '1', 200);
            });
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