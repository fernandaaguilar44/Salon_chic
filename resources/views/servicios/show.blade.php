<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalles del servicio</title>
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
        }
        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
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
        .employee-details {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.05), rgba(228, 0, 124, 0.02));
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
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
        textarea[readonly] {
            background-color: #fff9fc;
            border-left: 4px solid #e4007c;
            border-radius: 8px;
            padding: 0.7rem;
            font-size: 0.9rem;
            font-family: inherit;
            width: 100%;
            color: #444;
            resize: none;
        }
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
    </style>
</head>
<body>
@include('layouts.slider')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
        </div>
    </div>

<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-clipboard-list"></i> Detalles del servicio</h2>
    </div>

    <div class="employee-details">
        <dl class="row">
            <dt class="col-sm-4"><i class="fas fa-hashtag"></i> Código del servicio:</dt>
            <dd class="col-sm-8">{{ $servicio->codigo_servicio }}</dd>

            <dt class="col-sm-4"><i class="fas fa-tag"></i> Nombre del servicio:</dt>
            <dd class="col-sm-8">{{ $servicio->nombre_servicio }}</dd>

            <dt class="col-sm-4"><i class="fas fa-list"></i> Tipo de servicio:</dt>
            <dd class="col-sm-8">{{ ucfirst($servicio->tipo_servicio) }}</dd>

            <dt class="col-sm-4"><i class="fas fa-layer-group"></i> Categoría del servicio:</dt>
            <dd class="col-sm-8">{{ ucfirst($servicio->categoria_servicio) }}</dd>

            <dt class="col-sm-4"><i class="fas fa-money-bill-wave"></i> Precio base:</dt>
            <dd class="col-sm-8">L. {{ number_format($servicio->precio_base, 2) }}</dd>

            <dt class="col-sm-4"><i class="fas fa-clock"></i> Duración estimada:</dt>
            <dd class="col-sm-8">{{ $servicio->duracion_estimada }} min</dd>

            <dt class="col-sm-4"><i class="fas fa-toggle-on"></i> Estado:</dt>
            <dd class="col-sm-8">
                <span class="status-badge status-{{ $servicio->estado }}">
                    <i class="fas fa-circle"></i> {{ ucfirst($servicio->estado) }}
                </span>
            </dd>

            <dt class="col-sm-4"><i class="fas fa-align-left"></i> Descripción:</dt>
            <dd class="col-sm-8">
                <textarea readonly rows="4">{{ $servicio->descripcion }}</textarea>
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
