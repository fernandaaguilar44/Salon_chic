<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar llamado de atención</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">
<div class="container mt-5 bg-white p-4 rounded shadow">
    <h3 class="mb-4">Registrar nuevo llamado de atención</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('llamados.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Empleado</label>
            <div class="col-sm-10">
                <select name="empleado_id" class="form-select border border-danger text-danger" required>
                    <option value="">Seleccione un empleado</option>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                            {{ $empleado->nombre_empleado }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Motivo</label>
            <div class="col-sm-10">
                <input type="text" name="motivo" value="{{ old('motivo') }}" class="form-control border border-danger text-danger" required>
            </div>
        </div>




        <div class="d-flex justify-content-between">
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">← Volver</a>
            <button type="submit" class="btn btn-danger">Registrar</button>
        </div>
    </form>
</div>
</body>
</html>
