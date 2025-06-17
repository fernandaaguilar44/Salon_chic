<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalles del empleado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #E6E6FA;
            color: #333;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            max-width: 800px;
        }

        .form-label {
            color: #E4007C;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-bottom: 1rem;
        }

        .btn-custom, .btn-warning, .btn-outline-primary {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 8px;
            min-width: 180px;
            text-align: center;
        }

        /* Botones rosados */
        .btn-custom, .btn-warning {
            background-color: #E4007C;
            color: white;
            border: none;
        }

        .btn-custom:hover, .btn-warning:hover {
            background-color: #c3006a;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center" style="color: #4B0082;">Detalles del empleado</h2>

    <dl class="row">
        <dt class="col-sm-4">Nombre completo:</dt>
        <dd class="col-sm-8">{{ $empleado->nombre_empleado }}</dd>

        <dt class="col-sm-4">Número de identidad:</dt>
        <dd class="col-sm-8">{{ $empleado->numero_identidad }}</dd>

        <dt class="col-sm-4">Cargo:</dt>
        <dd class="col-sm-8">{{ $empleado->cargo }}</dd>

        <dt class="col-sm-4">Estado:</dt>
        <dd class="col-sm-8">{{ ucfirst($empleado->estado) }}</dd>

        <dt class="col-sm-4">Teléfono:</dt>
        <dd class="col-sm-8">{{ $empleado->telefono }}</dd>

        <dt class="col-sm-4">Nombre del contacto de emergencia:</dt>
        <dd class="col-sm-8">{{ $empleado->contacto_emergencia_nombre }}</dd>

        <dt class="col-sm-4">Contacto de emergencia:</dt>
        <dd class="col-sm-8">{{ $empleado->contacto_emergencia }}</dd>

        <dt class="col-sm-4">Fecha de ingreso:</dt>
        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</dd>

        <dt class="col-sm-4">Salario:</dt>
        <dd class="col-sm-8">L. {{ number_format($empleado->salario, 2) }}</dd>

        <dt class="col-sm-4">Dirección:</dt>
        <dd class="col-sm-8">
            <textarea readonly class="form-control" rows="3" style="resize:none;">{{ $empleado->direccion }}</textarea>
        </dd>

    </dl>

    <hr />

    {{-- Mensaje si tiene 3 o más llamados y aún está activo --}}
    @if($empleado->llamados->count() >= 3 && $empleado->estado === 'activo')
        <div class="alert alert-warning mt-3 shadow-sm border-warning">
            <strong>⚠ Atención:</strong> Este empleado ha acumulado <strong>3 o más llamados de atención</strong>.
            Se recomienda tomar medidas disciplinarias conforme al reglamento interno.
        </div>
    @endif

    {{-- Mensaje si fue deshabilitado por 3 llamados --}}
    @if($empleado->llamados->count() >= 3 && $empleado->estado === 'inactivo')
        <div class="alert alert-danger mt-3 shadow-sm border-danger">
            <strong>Empleado deshabilitado.</strong> Este colaborador fue desactivado por haber acumulado
            3 o más llamados de atención conforme al reglamento disciplinario.
        </div>
    @endif

    <div class="button-group">
        {{-- Registrar llamado --}}
        @if($empleado->estado === 'activo' && $empleado->llamados->count() < 3)
            <a href="{{ route('llamados.create', ['empleado_id' => $empleado->id]) }}" class="btn btn-custom">
                + Registrar llamado
            </a>
        @else
            <button class="btn btn-secondary" disabled title="No se pueden registrar más llamados.">
                + Registrar llamado
            </button>
        @endif

        {{-- Ver llamados --}}
        <a href="{{ route('llamados.historial', $empleado->id) }}" class="btn btn-custom">
            Ver llamados
        </a>

        @if($empleado->estado === 'activo' && $empleado->llamados->count() >= 3)
            <form method="POST" action="{{ route('empleados.deshabilitar', $empleado->id) }}" style="display: inline-block;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-warning"
                        onclick="return confirm('¿Está seguro de desactivar este empleado?')">
                    Deshabilitar
                </button>
            </form>
        @endif

        {{-- Botón volver al listado --}}
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
            Volver al listado
        </a>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
