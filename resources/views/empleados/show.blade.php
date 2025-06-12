<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del empleado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .btn-custom {
            background-color: #E4007C;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #c3006a;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center" style="color: #4B0082;">Detalles del Empleado</h2>

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

        <dt class="col-sm-4">Contacto de emergencia:</dt>
        <dd class="col-sm-8">{{ $empleado->contacto_emergencia }}</dd>

        <dt class="col-sm-4">Dirección:</dt>
        <dd class="col-sm-8">{{ $empleado->direccion }}</dd>

        <dt class="col-sm-4">Fecha de ingreso:</dt>
        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</dd>


        <dt class="col-sm-4">Salario:</dt>
        <dd class="col-sm-8">L. {{ number_format($empleado->salario, 2) }}</dd>
    </dl>

    <hr>
    <h5 style="color: #4B0082;">Historial de Llamados de Atención</h5>

    @if($empleado->llamados->isEmpty())
        <p>No hay llamados de atención registrados.</p>
    @else
        <ul class="list-group mb-3">
            @foreach($empleado->llamados as $llamado)
                <li class="list-group-item">
                    <strong>{{ $llamado->fecha }}</strong>: {{ $llamado->motivo }}
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver al listado</a>
    <a href="{{ route('llamados.create') }}" class="btn btn-danger">+ Registrar llamado de atención</a>



</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
