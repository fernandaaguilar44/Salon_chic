<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar empleado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
            color: #333;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        h2 {
            text-align: center;
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
        }

        .form-label {
            color: #7B2A8D;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            background-color: white;
            color: black;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.25);
        }

        .btn-primary,
        .btn-secondary {
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6a267f 0%, #c3006a 100%);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
            color: white;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border: 2px solid #dc3545;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
        }

        .btn-group-left {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 1.5rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="form-container">
                <h2>Editar empleado</h2>
                <form id="empleadoForm" method="POST" action="{{ route('empleados.update', $empleado->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="nombre_empleado" class="form-label">Nombre del empleado</label>
                            <input type="text" id="nombre_empleado" name="nombre_empleado" maxlength="50"
                                   class="form-control @error('nombre_empleado') is-invalid @enderror"
                                   value="{{ old('nombre_empleado', $empleado->nombre_empleado) }}"
                                   placeholder="Escriba nombre del empleado" />
                            @error('nombre_empleado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="numero_identidad" class="form-label">Número de identidad</label>
                            <input type="tel" id="numero_identidad" name="numero_identidad"
                                   class="form-control @error('numero_identidad') is-invalid @enderror"
                                   value="{{ old('numero_identidad', $empleado->numero_identidad) }}"
                                   placeholder="Ingrese 13 dígitos sin guiones"
                                   pattern="\d{13}" maxlength="13" />
                            @error('numero_identidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" maxlength="8"
                                   class="form-control @error('telefono') is-invalid @enderror"
                                   value="{{ old('telefono', $empleado->telefono) }}"
                                   placeholder="########" />
                            @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="salario" class="form-label">Salario</label>
                            <input type="text" id="salario" name="salario"
                                   class="form-control @error('salario') is-invalid @enderror"
                                   value="{{ old('salario', $empleado->salario) }}"
                                   placeholder="00000"
                                   maxlength="6" pattern="\d{1,6}" />
                            @error('salario')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="contacto_emergencia_nombre" class="form-label">Nombre del contacto de emergencia</label>
                            <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre" maxlength="50"
                                   class="form-control @error('contacto_emergencia_nombre') is-invalid @enderror"
                                   value="{{ old('contacto_emergencia_nombre', $empleado->contacto_emergencia_nombre) }}"
                                   placeholder="Nombre del contacto" />
                            @error('contacto_emergencia_nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="contacto_emergencia" class="form-label">Teléfono de emergencia</label>
                            <input type="tel" id="contacto_emergencia" name="contacto_emergencia" maxlength="8"
                                   class="form-control @error('contacto_emergencia') is-invalid @enderror"
                                   value="{{ old('contacto_emergencia', $empleado->contacto_emergencia) }}"
                                   placeholder="########" />
                            @error('contacto_emergencia')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" id="correo" name="correo" maxlength="50"
                                   class="form-control @error('correo') is-invalid @enderror"
                                   value="{{ old('correo', $empleado->correo) }}"
                                   placeholder="ejemplo@dominio.hn" />
                            @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="cargo" class="form-label">Cargo</label>
                            <select id="cargo" name="cargo"
                                    class="form-select @error('cargo') is-invalid @enderror">
                                <option value="">Seleccione un cargo</option>
                                <option value="estilista" {{ old('cargo', $empleado->cargo) == 'estilista' ? 'selected' : '' }}>Estilista</option>
                                <option value="manicurista" {{ old('cargo', $empleado->cargo) == 'manicurista' ? 'selected' : '' }}>Manicurista</option>
                            </select>
                            @error('cargo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
                            <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                                   class="form-control @error('fecha_ingreso') is-invalid @enderror"
                                   value="{{ old('fecha_ingreso', $empleado->fecha_ingreso) }}" />
                            @error('fecha_ingreso')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                                <option value="">Seleccione estado</option>
                                <option value="activo" {{ old('estado', $empleado->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado', $empleado->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea id="direccion" name="direccion" maxlength="200"
                                      class="form-control @error('direccion') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Escriba la dirección del empleado">{{ old('direccion', $empleado->direccion) }}</textarea>
                            @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="btn-group-left mt-4">
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnLimpiar')?.addEventListener('click', function () {
        const form = document.getElementById('empleadoForm');

        form.querySelectorAll('input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="tel"]').forEach(input => {
            input.value = '';
        });

        form.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
        });

        form.querySelectorAll('textarea').forEach(textarea => {
            textarea.value = '';
        });

        const estado = form.querySelector('input[name="estado"]');
        if (estado) estado.value = 'activo';

        form.querySelectorAll('.is-invalid').forEach(field => {
            field.classList.remove('is-invalid');
            const feedback = field.parentElement.querySelector('.invalid-feedback');
            if (feedback) feedback.textContent = '';
        });
    });
</script>
</body>
</html>
