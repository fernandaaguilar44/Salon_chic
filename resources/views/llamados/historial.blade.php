<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de llamados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">
<div class="container mt-5 bg-white p-4 rounded shadow">
    <h3 class="mb-4">Historial de llamados - {{ $empleado->nombre_empleado }}</h3>

    <a href="{{ route('empleados.index', $empleado->id) }}" class="btn btn-secondary mb-3">← Volver al listado de empleado</a>

    @if($empleado->llamados->isEmpty())
        <div class="alert alert-info">Este empleado no tiene llamados de atención registrados.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-danger text-center">
            <tr>
                <th>Fecha</th>
                <th>Motivo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($empleado->llamados as $llamado)
                <tr>
                    <td class="text-center">{{ \Carbon\Carbon::parse($llamado->fecha)->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $llamado->motivo }}</td>


                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
