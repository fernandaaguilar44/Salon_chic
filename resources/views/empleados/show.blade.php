<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalles del empleado</title>
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

        /* Card de información del empleado */
        .employee-details {
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
        }

        textarea[readonly]:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
        }

        /* Alertas mejoradas */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 0.7rem 1rem;
            font-weight: 600;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 193, 7, 0.05));
            color: #856404;
            border-left: 4px solid #ffc107;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.2);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(220, 53, 69, 0.05));
            color: #721c24;
            border-left: 4px solid #dc3545;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
        }

        /* Grupo de botones */
        .button-group {
            display: flex;
            gap: 0.7rem;
            flex-wrap: wrap;
            justify-content: center;
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

        /* Botón principal - Registrar llamado */
        .btn-primary-beauty {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
        }

        .btn-primary-beauty:hover:not(.disabled):not(:disabled) {
            background: linear-gradient(135deg, #c3006a 0%, #6a267f 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(228, 0, 124, 0.4);
            color: white;
        }

        .btn-primary-beauty.disabled,
        .btn-primary-beauty:disabled {
            background: linear-gradient(135deg, #cccccc 0%, #999999 100%);
            opacity: 0.6;
            pointer-events: none;
            color: white;
        }

        /* Botón informativo - Ver llamados */
        .btn-info-beauty {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
        }

        .btn-info-beauty:hover {
            background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
            color: white;
        }

        /* Botón de advertencia - Deshabilitar */
        .btn-warning-beauty {
            background: linear-gradient(135deg, #fd7e14 0%, #e76500 100%);
            color: white;
        }

        .btn-warning-beauty:hover {
            background: linear-gradient(135deg, #e76500 0%, #cc5a00 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(253, 126, 20, 0.4);
            color: white;
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

        form {
            margin: 0;
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

            .employee-details {
                padding: 0.8rem;
            }

            dt {
                font-size: 0.75rem;
            }

            dd {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h2 {
                font-size: 1.2rem;
            }

            .btn-beauty {
                padding: 0.45rem 1rem;
                font-size: 0.75rem;
            }

            .container {
                padding: 0.8rem;
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

            .employee-details {
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
@include('layouts.slider')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
        </div>
    </div>

<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-user-circle"></i> Detalles del empleado</h2>
    </div>

    <div class="employee-details">
        <dl class="row">
            <dt class="col-sm-4">
                <i class="fas fa-user"></i>
                Nombre completo:
            </dt>
            <dd class="col-sm-8">{{ $empleado->nombre_empleado }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-id-card"></i>
                Número de identidad:
            </dt>
            <dd class="col-sm-8">{{ $empleado->numero_identidad }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-briefcase"></i>
                Cargo:
            </dt>
            <dd class="col-sm-8">{{ $empleado->cargo }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-toggle-on"></i>
                Estado:
            </dt>
            <dd class="col-sm-8">
                <span class="status-badge status-{{ $empleado->estado }}">
                    <i class="fas fa-circle"></i>
                    {{ ucfirst($empleado->estado) }}
                </span>
            </dd>

            <dt class="col-sm-4">
                <i class="fas fa-phone"></i>
                Teléfono:
            </dt>
            <dd class="col-sm-8">{{ $empleado->telefono }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-user-friends"></i>
                Contacto de emergencia:
            </dt>
            <dd class="col-sm-8">{{ $empleado->contacto_emergencia_nombre }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-phone-alt"></i>
                Teléfono de emergencia:
            </dt>
            <dd class="col-sm-8">{{ $empleado->contacto_emergencia }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-calendar-check"></i>
                Fecha de ingreso:
            </dt>
            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-money-bill-wave"></i>
                Salario:
            </dt>
            <dd class="col-sm-8">L. {{ number_format($empleado->salario, 2) }}</dd>

            <dt class="col-sm-4">
                <i class="fas fa-map-marker-alt"></i>
                Dirección:
            </dt>
            <dd class="col-sm-8">
                <textarea readonly class="form-control" rows="2">{{ $empleado->direccion }}</textarea>
            </dd>
        </dl>
    </div>

    @if($empleado->llamados->count() >= 3 && $empleado->estado === 'activo')
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>⚠ Atención:</strong> Este empleado ha acumulado <strong>3 o más llamados de atención</strong>. Se recomienda tomar medidas disciplinarias.
        </div>
    @endif

    @if($empleado->llamados->count() >= 3 && $empleado->estado === 'inactivo')
        <div class="alert alert-danger">
            <i class="fas fa-ban"></i>
            <strong>Empleado deshabilitado.</strong> Este colaborador fue desactivado por haber acumulado 3 o más llamados de atención.
        </div>
    @endif

    <div class="button-group">
        <a href="{{ route('llamados.create', ['empleado_id' => $empleado->id]) }}"
           class="btn btn-beauty btn-primary-beauty {{ $empleado->estado !== 'activo' || $empleado->llamados->count() >= 3 ? 'disabled' : '' }}">
            <i class="fas fa-exclamation-triangle"></i>
            Registrar llamado
        </a>

        <a href="{{ route('llamados.historial', $empleado->id) }}" class="btn btn-beauty btn-info-beauty">
            <i class="fas fa-history"></i>
            Ver llamados
        </a>

        @if($empleado->estado === 'activo')
            <form method="POST" action="{{ route('empleados.deshabilitar', $empleado->id) }}" style="margin:0;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-beauty btn-warning-beauty"
                        onclick="return confirm('¿Está seguro de desactivar este empleado?')">
                    <i class="fas fa-user-slash"></i>
                    Deshabilitar
                </button>
            </form>
        @endif

        <a href="{{ route('empleados.index') }}" class="btn btn-beauty btn-secondary-beauty">
            <i class="fas fa-arrow-left"></i>
            Volver al listado
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>