<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar cliente</title>
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
            display: flex;
            align-items: center;
            gap: 8px;
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

        .input-group {
            position: relative;
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
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-8">
            <div class="form-container">
                <h2><i class="fas fa-user-edit"></i> Editar cliente</h2>
                <form id="clienteForm" method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Nombre completo -->
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">
                                <i class="fas fa-user"></i> Nombre completo
                            </label>
                            <div class="input-group">
                                <input type="text" id="nombre" name="nombre" maxlength="50"
                                       class="form-control @error('nombre') is-invalid @enderror"
                                       value="{{ old('nombre', $cliente->nombre) }}"
                                       placeholder="Ej: María Elena García López" />
                            </div>
                            @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">
                                <i class="fas fa-phone"></i> Teléfono
                            </label>
                            <div class="input-group">
                                <input type="text" id="telefono" name="telefono" maxlength="8"
                                       class="form-control @error('telefono') is-invalid @enderror"
                                       value="{{ old('telefono', $cliente->telefono) }}"
                                       placeholder="Ej: 99887766"
                                       inputmode="numeric" />
                            </div>
                            @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Identidad -->
                        <div class="col-md-6">
                            <label for="identidad" class="form-label">
                                <i class="fas fa-id-card"></i> Identidad
                            </label>
                            <div class="input-group">
                                <input type="text" id="identidad" name="identidad" maxlength="13"
                                       class="form-control @error('identidad') is-invalid @enderror"
                                       value="{{ old('identidad', $cliente->identidad) }}"
                                       placeholder="Ej: 0801199012345"
                                       inputmode="numeric" />
                            </div>
                            @error('identidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fecha de nacimiento -->
                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label">
                                <i class="fas fa-calendar-alt"></i> Fecha de nacimiento
                            </label>
                            <div class="input-group">
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                       class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                       value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}" />
                            </div>
                            @error('fecha_nacimiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sexo -->
                        <div class="col-md-6">
                            <label for="sexo" class="form-label">
                                <i class="fas fa-venus-mars"></i> Sexo
                            </label>
                            <div class="input-group">
                                <select id="sexo" name="sexo" class="form-select @error('sexo') is-invalid @enderror">
                                    <option value="">Seleccione sexo</option>
                                    <option value="femenino" {{ old('sexo', $cliente->sexo) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="masculino" {{ old('sexo', $cliente->sexo) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                </select>
                            </div>
                            @error('sexo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Correo electrónico -->
                        <div class="col-md-6">
                            <label for="correo" class="form-label">
                                <i class="fas fa-envelope"></i> Correo electrónico
                            </label>
                            <div class="input-group">
                                <input type="text" id="correo" name="correo" maxlength="50"
                                       class="form-control @error('correo') is-invalid @enderror"
                                       value="{{ old('correo', $cliente->correo) }}"
                                       placeholder="Ej: maria@ejemplo.com"
                                       novalidate />
                            </div>
                            @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="col-12">
                            <label for="direccion" class="form-label">
                                <i class="fas fa-map-marker-alt"></i> Dirección
                            </label>
                            <div class="input-group">
                                <textarea id="direccion" name="direccion" rows="3" maxlength="200"
                                          class="form-control @error('direccion') is-invalid @enderror"
                                          placeholder="Ej: Colonia Villa Nueva, 3 calle, 2 avenida, casa #45">{{ old('direccion', $cliente->direccion) }}</textarea>
                            </div>
                            @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="btn-group-left mt-4">
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Validación para campos numéricos
        const camposNumericos = ['telefono', 'identidad'];

        camposNumericos.forEach(function(campoId) {
            const input = document.getElementById(campoId);

            input.addEventListener('input', function () {
                // Solo permitir números
                this.value = this.value.replace(/[^0-9]/g, '');

                // Eliminar ceros al inicio solo para el teléfono
                if (campoId === 'telefono') {
                    this.value = this.value.replace(/^0+/, '');
                }
            });
        });

        // Validación para el campo nombre - solo letras, espacios y acentos
        const nombreInput = document.getElementById('nombre');
        nombreInput.addEventListener('input', function () {
            // Solo permitir letras, espacios, acentos y caracteres especiales del español
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]/g, '');

            // Eliminar espacios múltiples
            this.value = this.value.replace(/\s+/g, ' ');

            // No permitir que empiece con espacio
            this.value = this.value.replace(/^\s/, '');
        });

        // Validación para el campo dirección - más permisivo pero controlado
        const direccionInput = document.getElementById('direccion');
        direccionInput.addEventListener('input', function () {
            // Permitir letras, números, espacios, acentos y algunos caracteres especiales comunes en direcciones
            this.value = this.value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s.,#-]/g, '');

            // Eliminar espacios múltiples
            this.value = this.value.replace(/\s+/g, ' ');

            // No permitir que empiece con espacio
            this.value = this.value.replace(/^\s/, '');
        });

        const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
        const hoy = new Date();
        const hace90Anios = new Date();
        hace90Anios.setFullYear(hoy.getFullYear() - 90);

        const minFecha = hace90Anios.toISOString().split('T')[0];
        const maxFecha = '2025-12-31';

        fechaNacimientoInput.setAttribute('min', minFecha);
        fechaNacimientoInput.setAttribute('max', maxFecha);

        // Validar también al escribir manualmente
        fechaNacimientoInput.addEventListener('input', function () {
            const ingresada = new Date(this.value);
            const min = new Date(minFecha);
            const max = new Date(maxFecha);

            if (ingresada < min || ingresada > max) {
                this.value = ''; // Borra el valor si está fuera de rango
            }
        });
    });
</script>


</body>
</html>