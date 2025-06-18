<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de llamados de atención</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            background: white;
            padding: 2rem;
            margin-top: 3rem;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(180, 99, 167, 0.2);
        }
        h3 {
            color: #7B2A8D;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .table th {
            background-color: #e4007c;
            color: white;
        }
        .info-empleado {
            background: #f3e6f9;
            border: 1px solid #d9b3e6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: #4b0082;
            font-weight: 600;
        }
        .btn-secondary {
            background-color: #ff7bc1;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
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
    <h3>Historial de llamados - {{ $empleado->nombre_empleado }}</h3>

    <div class="info-empleado">
        <p><strong>Identidad:</strong> {{ $empleado->numero_identidad }}</p>
        <p><strong>Teléfono:</strong> {{ $empleado->telefono }}</p>
        <p><strong>Dirección:</strong> {{ $empleado->direccion }}</p>
    </div>

    <div class="mb-3">
        <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-secondary">← Regresar</a>
    </div>

    @if($empleado->llamados->isEmpty())
        <div class="alert alert-info">Este empleado no tiene llamados de atención registrados.</div>
    @else
        <table class="table table-bordered table-hover text-center align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Acción disciplinaria</th>
                <th>Total de llamados</th>
            </tr>
            </thead>
            <tbody>
            @foreach($empleado->llamados as $index => $llamado)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($llamado->fecha)->format('d/m/Y') }}</td>
                    <td class="text-start">{{ $llamado->motivo }}</td>
                    <td>
                        @if($llamado->accion === 'advertencia')
                            <span class="badge bg-warning text-dark">Advertencia</span>
                        @elseif($llamado->accion === 'suspensión')
                            <span class="badge bg-info text-dark">Suspensión</span>
                        @elseif($llamado->accion === 'despido')
                            <span class="badge bg-danger">Despido</span>
                        @else
                            <span class="badge bg-secondary">N/A</span>
                        @endif
                    </td>
                    <td>{{ $llamado->total_llamados }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>
