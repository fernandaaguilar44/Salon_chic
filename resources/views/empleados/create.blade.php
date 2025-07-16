<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear nuevo empleado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
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
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .form-label i {
            font-size: 0.95rem;
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
        .btn {
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #6a267f 0%, #c3006a 100%);
            color: white;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            border: none;
            color: white;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
        }
        .btn-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.44) 0%, #a71e2a 100%);
            border: none;
            color: white;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, rgba(189, 33, 48, 0.41) 0%, #861c26 100%);
        }
        .invalid-feedback {
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
            display: block;
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="form-container">
                <h2><i class="fas fa-user-plus"></i> Crear un nuevo empleado</h2>

                <form id="empleadoForm" method="POST" action="{{ route('empleados.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="nombre_empleado" class="form-label">
                                <i class="fas fa-user"></i> Nombre del empleado
                            </label>
                            <input type="text" id="nombre_empleado" name="nombre_empleado" maxlength="50" class="form-control @error('nombre_empleado') is-invalid @enderror" value="{{ old('nombre_empleado') }}" placeholder="Escriba nombre del empleado" />
                            @error('nombre_empleado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="numero_identidad" class="form-label">
                                <i class="fas fa-id-card"></i> Número de identidad
                            </label>
                            <input type="text" id="numero_identidad" name="numero_identidad" class="form-control @error('numero_identidad') is-invalid @enderror" value="{{ old('numero_identidad') }}" placeholder="#############" maxlength="13" />
                            @error('numero_identidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="telefono" class="form-label">
                                <i class="fas fa-phone"></i> Teléfono
                            </label>
                            <input type="text" id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" placeholder="########" maxlength="8" />
                            @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="salario" class="form-label">
                                <i class="fas fa-dollar-sign"></i> Salario
                            </label>
                            <input
                                    type="text"
                                    id="salario"
                                    name="salario"
                                    class="form-control @error('salario') is-invalid @enderror"
                                    value="{{ old('salario') }}"
                                    placeholder="00000"
                                    maxlength="6"
                                    inputmode="numeric"
                            />
                            @error('salario')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-4">
                            <label for="contacto_emergencia_nombre" class="form-label">
                                <i class="fas fa-user-shield"></i> Contacto de emergencia
                            </label>
                            <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre" class="form-control @error('contacto_emergencia_nombre') is-invalid @enderror" maxlength="50" placeholder="Nombre del contacto" value="{{ old('contacto_emergencia_nombre') }}" />
                            @error('contacto_emergencia_nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="contacto_emergencia" class="form-label">
                                <i class="fas fa-phone-alt"></i> Tel. de Emergencia
                            </label>
                            <input type="text" id="contacto_emergencia" name="contacto_emergencia" class="form-control @error('contacto_emergencia') is-invalid @enderror" maxlength="8" value="{{ old('contacto_emergencia') }}" placeholder="########" />
                            @error('contacto_emergencia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="correo" class="form-label">
                                <i class="fas fa-envelope"></i> Correo electrónico
                            </label>
                            <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" maxlength="50" placeholder="ejemplo@dominio.hn" value="{{ old('correo') }}" />
                            @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="cargo" class="form-label">
                                <i class="fas fa-briefcase"></i> Cargo
                            </label>
                            <select id="cargo" name="cargo" class="form-select @error('cargo') is-invalid @enderror">
                                <option value="">Seleccione un cargo</option>
                                <option value="estilista" {{ old('cargo') == 'estilista' ? 'selected' : '' }}>Estilista</option>
                                <option value="manicurista" {{ old('cargo') == 'manicurista' ? 'selected' : '' }}>Manicurista</option>
                            </select>
                            @error('cargo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="fecha_ingreso" class="form-label">
                                <i class="fas fa-calendar-alt"></i> Fecha de ingreso
                            </label>
                            <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="form-control @error('fecha_ingreso') is-invalid @enderror" value="{{ old('fecha_ingreso', date('Y-m-d')) }}" />
                            @error('fecha_ingreso') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <input type="hidden" name="estado" value="activo" />

                        <div class="col-12">
                            <label for="direccion" class="form-label">
                                <i class="fas fa-map-marker-alt"></i> Dirección
                            </label>
                            <textarea id="direccion" name="direccion" maxlength="200" class="form-control @error('direccion') is-invalid @enderror" rows="4" placeholder="Escriba la dirección del empleado">{{ old('direccion') }}</textarea>
                            @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                        <button type="reset" class="btn btn-danger" id="btnLimpiar"><i class="fas fa-eraser"></i> Limpiar</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    document.getElementById('btnLimpiar').addEventListener('click', function (e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del botón

        const form = document.getElementById('empleadoForm');

        // Limpiar cada campo individualmente por su ID
        document.getElementById('nombre_empleado').value = '';
        document.getElementById('numero_identidad').value = '';
        document.getElementById('telefono').value = '';
        document.getElementById('salario').value = '';
        document.getElementById('contacto_emergencia_nombre').value = '';
        document.getElementById('contacto_emergencia').value = '';
        document.getElementById('correo').value = '';
        document.getElementById('direccion').value = '';

        // Resetear el select de cargo
        document.getElementById('cargo').selectedIndex = 0;

        // Restaurar la fecha actual
        const today = new Date();
        const formattedDate = today.getFullYear() + '-' +
            String(today.getMonth() + 1).padStart(2, '0') + '-' +
            String(today.getDate()).padStart(2, '0');
        document.getElementById('fecha_ingreso').value = '';

        // Remover todas las clases de error
        const campos = [
            'nombre_empleado', 'numero_identidad', 'telefono', 'salario',
            'contacto_emergencia_nombre', 'contacto_emergencia', 'correo',
            'cargo', 'fecha_ingreso', 'direccion'
        ];

        campos.forEach(campoId => {
            const elemento = document.getElementById(campoId);
            if (elemento) {
                elemento.classList.remove('is-invalid');
            }
        });

        // Ocultar todos los mensajes de error
        document.querySelectorAll('.invalid-feedback').forEach(feedback => {
            feedback.style.display = 'none';
        });

        console.log('Formulario limpiado'); // Para debug
    });
</script>
</body>
</html>