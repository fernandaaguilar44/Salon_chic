<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalles del Servicio - Salón de Belleza</title>
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
            margin: 0;
        }

        .container {
            max-width: 800px;
            background: rgba(255, 255, 255, 0.95);
            margin: 0 auto;
            padding: 1.2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInUp 0.6s ease-out;
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

        .beauty-header {
            text-align: center;
            margin-bottom: 1.2rem;
            position: relative;
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
            font-size: 1.3rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-8px);
            }
            60% {
                transform: translateY(-4px);
            }
        }

        .beauty-header::after {
            content: '';
            display: block;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 10px auto;
            border-radius: 2px;
        }

        /* Card de información del servicio */
        .service-details {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.05), rgba(228, 0, 124, 0.02));
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            animation: slideInDown 0.8s ease-out;
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

        dt {
            font-weight: 700;
            color: #7B2A8D;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 5px;
        }

        dt i {
            color: #E4007C;
            font-size: 0.75rem;
            width: 14px;
            text-align: center;
        }

        dd {
            color: #444;
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 0.6rem;
            padding: 0.4rem 0.6rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            border-left: 3px solid #E4007C;
        }

        /* Estilo especial para el nombre del servicio */
        .service-name {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #7B2A8D;
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.1), rgba(123, 42, 141, 0.05));
            padding: 0.6rem 0.8rem;
            border-radius: 8px;
            border: 1px solid rgba(228, 0, 124, 0.2);
            margin: 0;
        }

        .service-name i {
            color: #E4007C;
            font-size: 0.9rem;
            animation: sparkle 2s infinite;
        }

        @keyframes sparkle {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
        }

        /* Elementos especiales para duración */
        .duration-container {
            background: linear-gradient(135deg, #fff8fc 0%, #f8f0ff 100%);
            border: 2px solid rgba(228, 0, 124, 0.2);
            border-radius: 8px;
            padding: 0.8rem;
            margin: 0;
        }

        .duration-display {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 0.5rem;
        }

        .duration-primary {
            font-size: 0.9rem;
            font-weight: 700;
            color: #7B2A8D;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .duration-formatted {
            font-size: 0.75rem;
            color: #444;
            background: rgba(123, 42, 141, 0.12);
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        .duration-bar {
            height: 4px;
            background: rgba(123, 42, 141, 0.15);
            border-radius: 2px;
            overflow: hidden;
        }

        .duration-progress {
            height: 100%;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            border-radius: 2px;
            transition: width 1.5s ease-out;
            animation: progressFill 2s ease-out;
        }

        @keyframes progressFill {
            from { width: 0%; }
        }

        textarea[readonly] {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(228, 0, 124, 0.2);
            border-radius: 8px;
            padding: 0.5rem 0.7rem;
            resize: none;
            font-family: inherit;
            color: #444;
            font-weight: 500;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        textarea[readonly]:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
        }

        /* Estados especiales */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-activo {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.15), rgba(40, 167, 69, 0.05));
            color: #155724;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .status-inactivo {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(220, 53, 69, 0.05));
            color: #721c24;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .status-temporalmente_suspendido {
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 193, 7, 0.05));
            color: #856404;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        /* Grupo de botones */
        .button-group {
            display: flex;
            gap: 0.7rem;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 1.2rem;
            padding-top: 1.2rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
        }

        .btn-beauty {
            padding: 0.5rem 1.2rem;
            font-size: 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            min-width: 140px;
            text-align: center;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-beauty::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-beauty:hover::before {
            left: 100%;
        }

        /* Botón secundario - Volver */
        .btn-secondary-beauty {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            background: linear-gradient(135deg, #5a6268 0%, #3d4043 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
            color: white;
        }

        /* Responsive mejorado */
        @media (max-width: 768px) {
            .container {
                margin: 0 0.25rem;
                padding: 1rem;
            }

            .beauty-header h2 {
                font-size: 1.3rem;
            }

            .button-group {
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
            }

            .btn-beauty {
                width: 100%;
                max-width: 250px;
                min-width: auto;
            }

            .service-details {
                padding: 0.8rem;
            }

            dt {
                font-size: 0.75rem;
            }

            dd {
                font-size: 0.8rem;
            }

            .duration-display {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .service-name {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h2 {
                font-size: 1.2rem;
                flex-direction: column;
                gap: 5px;
            }

            .btn-beauty {
                padding: 0.45rem 1rem;
                font-size: 0.75rem;
            }

            .container {
                padding: 0.8rem;
            }

            .service-name {
                font-size: 0.8rem;
            }
        }

        /* Ajuste para pantallas muy pequeñas en altura */
        @media (max-height: 700px) {
            body {
                padding: 0.25rem 0;
            }

            .container {
                padding: 0.8rem;
            }

            .beauty-header {
                margin-bottom: 0.8rem;
            }

            .service-details {
                margin-bottom: 0.8rem;
            }

            .button-group {
                margin-top: 0.8rem;
                padding-top: 0.8rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-cut"></i> Detalles del Servicio</h2>
    </div>

    <div class="service-details">
        <dl class="row">
            <dt class="col-sm-4">
                <i class="fas fa-hashtag"></i>
                Código:
            </dt>
            <dd class="col-sm-8">{{ $servicio->codigo_servicio }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-tag"></i>
                Nombre:
            </dt>
            <dd class="col-sm-8">{{ $servicio->nombre_servicio }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-list"></i>
                Tipo:
            </dt>
            <dd class="col-sm-8">{{ ucfirst($servicio->tipo_servicio) }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-layer-group"></i>
                Categoría:
            </dt>
            <dd class="col-sm-8">{{ ucfirst($servicio->categoria_servicio) }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-money-bill-wave"></i>
                Precio:
            </dt>
            <dd class="col-sm-8">L. {{ number_format($servicio->precio_base, 2) }}</dd>

            @php
                $totalMin = $servicio->duracion_estimada;
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

            <dt class="col-sm-4">
                <i class="fas fa-clock"></i>
                Duración:
            </dt>
            <dd class="col-sm-8">
                <div class="duration-container">
                    <div class="duration-display">
                        <span class="duration-primary">
                            <i class="fas fa-stopwatch"></i>
                            {{ $totalMin }} minutos
                        </span>
                        @if($totalMin >= 60)
                            <span class="duration-formatted">{{ $formatoHorasMin }}</span>
                        @endif
                    </div>
                    <div class="duration-bar">
                        <div class="duration-progress" style="width: {{ min(($totalMin / 180) * 100, 100) }}%"></div>
                    </div>
                </div>
            </dd>

            <dt class="col-sm-4">
                <i class="fas fa-toggle-on"></i>
                Estado:
            </dt>
            <dd class="col-sm-8">
                <span class="status-badge status-{{ $servicio->estado }}">
                    <i class="fas fa-circle"></i>
                    {{ ucfirst($servicio->estado) }}
                </span>
            </dd>

            <dt class="col-sm-4">
                <i class="fas fa-align-left"></i>
                Descripción:
            </dt>
            <dd class="col-sm-8">
                <textarea readonly class="form-control" rows="3">{{ $servicio->descripcion }}</textarea>
            </dd>
        </dl>
    </div>

    <div class="button-group">
        <a href="{{ route('servicios.index') }}" class="btn btn-beauty btn-secondary-beauty">
            <i class="fas fa-arrow-left"></i>
            Volver al listado
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>