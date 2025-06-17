<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear nuevo empleado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #E6E6FA;
            color: white;
        }
        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            color: black;
        }
        .form-label {
            color: rgba(16, 15, 15, 0.95);
        }
        .form-control,
        .form-select {
            background-color: white;
            color: black;
        }
        .btn-primary {
            background-color: #C97BFF;
            border-color: #C97BFF;
            color: black;
            text-shadow: white 1px 1px;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .btn-secondary {
            background-color: #C97BFF;
            border-color: rgba(16, 15, 15, 0.95);
            color: black;
            font-weight: bold;
            text-shadow: white 1px 1px;
            transition: all 0.4s ease;
        }
        .btn-secondary:hover,
        .btn-primary:hover {
            background-color: #C97BFF;
            border-color: rgba(16, 15, 15, 0.95);
            color: white;
            transform: scale(1.2);
            opacity: 0.9;
        }
        .btn-primary:hover {
            text-shadow: black 1px 1px;
        }
        .form-control.is-invalid,
        .form-select.is-invalid {
            border: 2px solid #dc3545;
            background-color: #fff0f0;
        }
        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="form-container">
                <h2 class="mb-4 text-center" style="color: #4B0082;">Crear un nuevo empleado</h2>
                <form id="empleadoForm" method="POST" action="{{ route('empleados.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="nombre_empleado" class="form-label">Nombre del empleado</label>
                            <input type="text" id="nombre_empleado" name="nombre_empleado"
                                   class="form-control @error('nombre_empleado') is-invalid @enderror"
                                   value="{{ old('nombre_empleado') }}" placeholder="Escriba nombre del empleado" />
                            @error('nombre_empleado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="numero_identidad" class="form-label">Número de identidad</label>
                            <input type="text" id="numero_identidad" name="numero_identidad"
                                   class="form-control @error('numero_identidad') is-invalid @enderror"
                                   value="{{ old('numero_identidad') }}" placeholder="#############" maxlength="13" />
                            @error('numero_identidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" id="telefono" name="telefono"
                                   class="form-control @error('telefono') is-invalid @enderror"
                                   value="{{ old('telefono') }}" placeholder="########" maxlength="8" />
                            @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="salario" class="form-label">Salario</label>
                            <input type="number" id="salario" name="salario"
                                   class="form-control @error('salario') is-invalid @enderror"
                                   value="{{ old('salario') }}" placeholder="00000" min="0" step="0.01" />
                            @error('salario')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="contacto_emergencia_nombre" class="form-label">Nombre del contacto de emergencia</label>
                            <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre"
                                   class="form-control @error('contacto_emergencia_nombre') is-invalid @enderror"
                                   value="{{ old('contacto_emergencia_nombre') }}" placeholder="Nombre del contacto" />
                            @error('contacto_emergencia_nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="contacto_emergencia" class="form-label">Contacto de Emergencia</label>
                            <input type="text" id="contacto_emergencia" name="contacto_emergencia"
                                   class="form-control @error('contacto_emergencia') is-invalid @enderror"
                                   value="{{ old('contacto_emergencia') }}" placeholder="########" maxlength="8" />
                            @error('contacto_emergencia')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" name="correo" id="correo"
                                   class="form-control @error('correo') is-invalid @enderror"
                                   placeholder="ejemplo@dominio.hn"
                                   value="{{ old('correo') }}" />
                            @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="cargo" class="form-label">Cargo</label>
                            <select id="cargo" name="cargo"
                                    class="form-select @error('cargo') is-invalid @enderror">
                                <option value="">Seleccione un cargo</option>
                                <option value="estilista" {{ old('cargo') == 'estilista' ? 'selected' : '' }}>Estilista</option>
                                <option value="manicurista" {{ old('cargo') == 'manicurista' ? 'selected' : '' }}>Manicurista</option>
                            </select>
                            @error('cargo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
                            <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                                   class="form-control @error('fecha_ingreso') is-invalid @enderror"
                                   value="{{ old('fecha_ingreso', date('Y-m-d')) }}" />
                            @error('fecha_ingreso')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="estado" value="activo" />
                        <div class="col-12 col-md-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea id="direccion" name="direccion"
                                      class="form-control @error('direccion') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Escriba la dirección del empleado">{{ old('direccion') }}</textarea>
                            @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="btn-group" role="group" aria-label="Botones de acción">
                            <button type="button" id="btnLimpiar" class="btn btn-secondary">🧹 Limpiar</button>
                            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">❌ Cancelar</a>
                            <button type="submit" class="btn btn-primary">💾 Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnLimpiar').addEventListener('click', function () {
        const form = document.getElementById('empleadoForm');
        form.reset();
        form.querySelectorAll('.is-invalid').forEach(campo => {
            campo.classList.remove('is-invalid');
            const feedback = campo.parentElement.querySelector('.invalid-feedback');
            if (feedback) feedback.textContent = '';
        });
    });
</script>
</body>
</html>