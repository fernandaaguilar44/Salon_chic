<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar llamado de atención</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            background: white;
            padding: 2rem;
            margin-top: 3rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(180, 99, 167, 0.3);
        }

        h3 {
            color: #7B2A8D;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            color: rgba(16, 15, 15, 0.95);
            font-weight: 600;
        }

        .btn-danger {
            background-color: #E4007C;
            border: none;
        }

        .btn-danger:hover {
            background-color: #b30f5f;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            margin-right: 0.5rem;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
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

        .btn-group-left {
            display: flex;
            justify-content: flex-start;
            gap: 0.5rem;
        }

        textarea {
            color: black !important;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Registrar nuevo llamado de atención</h3>

    <form action="{{ route('llamados.store') }}" method="POST">
        @csrf

        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">

        <div class="info-empleado">
            <p><strong>Nombre:</strong> {{ $empleado->nombre_empleado }}</p>
            <p><strong>Número de identidad:</strong> {{ $empleado->numero_identidad }}</p>
            <p><strong>Número de teléfono:</strong> {{ $empleado->telefono }}</p>
        </div>

        <!-- Fecha -->
        <div class="mb-3">
            <input type="date"
                   name="fecha"
                   id="fecha"
                   class="form-control @error('fecha') is-invalid @enderror"
                   value="{{ old('fecha', date('Y-m-d')) }}"
                   required>
            @error('fecha')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Motivo -->
        <div class="mb-3">
            <label for="motivo">Motivo</label>
            <textarea
                    name="motivo"
                    id="motivo"
                    rows="4"
                    class="form-control @error('motivo') is-invalid @enderror"
                    required
                    maxlength="70"
                    placeholder="Escriba el motivo"
                    onkeypress="return soloLetras(event)">{{ old('motivo') }}</textarea>
            @error('motivo')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="btn-group-left">
            <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-secondary">← Volver</a>
            <button type="submit" class="btn btn-danger">Registrar</button>
        </div>
    </form>
</div>

<script>
    function soloLetras(e) {
        const key = e.keyCode || e.which;
        const tecla = String.fromCharCode(key).toLowerCase();
        const letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        const especiales = [8, 37, 39, 46, 13];
        const input = e.target;

        if (!letras.includes(tecla) && !especiales.includes(key)) {
            e.preventDefault();
            return false;
        }

        if (key === 32 && input.selectionStart === 0) {
            e.preventDefault();
            return false;
        }

        const valor = input.value;
        const pos = input.selectionStart;
        if (key === 32 && valor.charAt(pos - 1) === ' ') {
            e.preventDefault();
            return false;
        }

        return true;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const fechaInput = document.getElementById('fecha');
        const hoy = new Date();
        const haceDosSemanas = new Date();
        haceDosSemanas.setDate(hoy.getDate() - 14);

        const formatoFecha = (fecha) => {
            const año = fecha.getFullYear();
            const mes = String(fecha.getMonth() + 1).padStart(2, '0');
            const dia = String(fecha.getDate()).padStart(2, '0');
            return ${año}-${mes}-${dia};
        };

        fechaInput.max = formatoFecha(hoy);
        fechaInput.min = formatoFecha(haceDosSemanas);
    });
</script>

</body>
</html>