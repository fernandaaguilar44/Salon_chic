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
                <input type="text"
                       name="motivo"
                       value="{{ old('motivo') }}"
                       class="form-control border border-danger text-danger @error('motivo') is-invalid @enderror"
                       required
                       maxlength="40"
                       placeholder="Escriba el motivo"
                       onkeypress="return soloLetras(event)" />
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

<script>
    function soloLetras(e) {
        let key = e.keyCode || e.which;
        let tecla = String.fromCharCode(key).toLowerCase();
        let letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        let especiales = [8, 37, 39, 46]; // backspace, flechas, suprimir

        let input = e.target;

        // No permitir punto ni comilla simple ni caracteres no permitidos
        if (tecla === '.' || tecla === "'" || (letras.indexOf(tecla) === -1 && !especiales.includes(key))) {
            e.preventDefault();
            return false;
        }

        // No permitir espacio como primer carácter
        if (key === 32 && input.selectionStart === 0) {
            e.preventDefault();
            return false;
        }

        // No permitir múltiples espacios consecutivos
        if (key === 32) {
            const valor = input.value;
            const pos = input.selectionStart;
            if (valor.charAt(pos - 1) === ' ') {
                e.preventDefault();
                return false;
            }
        }

        return true;
    }
    </script>
