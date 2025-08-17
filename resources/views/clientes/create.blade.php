<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear nuevo cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding-top: 0.5rem;
            padding-bottom: 2rem;
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
@include('layouts.slider')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
        </div>
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="form-container">
                <h2><i class="fas fa-user-plus"></i> Crear un nuevo cliente</h2>

                <form method="POST" action="{{ route('clientes.store') }}" id="clienteForm">
                    @csrf

                    <div class="row g-3">
                        <!-- Nombre -->
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label">
                                <i class="fas fa-user"></i> Nombre completo
                            </label>
                            <input type="text" id="nombre" name="nombre" maxlength="50"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   value="{{ old('nombre') }}"
                                   placeholder="Ej: María Elena González" />
                            @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="col-12 col-md-6">
                            <label for="telefono" class="form-label">
                                <i class="fas fa-phone"></i> Teléfono
                            </label>
                            <input type="text" id="telefono" name="telefono" maxlength="8"
                                   class="form-control @error('telefono') is-invalid @enderror"
                                   value="{{ old('telefono') }}"
                                   placeholder="Ej: 98765432"
                                   inputmode="numeric" />
                            @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Identidad -->
                        <div class="col-12 col-md-6">
                            <label for="identidad" class="form-label">
                                <i class="fas fa-id-card"></i> Número de identidad
                            </label>
                            <input type="text" id="identidad" name="identidad" maxlength="13"
                                   class="form-control @error('identidad') is-invalid @enderror"
                                   value="{{ old('identidad') }}"
                                   placeholder="Ej: 0801199012345"
                                   inputmode="numeric" />
                            @error('identidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Correo -->
                        <div class="col-12 col-md-6">
                            <label for="correo" class="form-label">
                                <i class="fas fa-envelope"></i> Correo electrónico
                            </label>
                            <input type="text" id="correo" name="correo" maxlength="50"
                                   class="form-control @error('correo') is-invalid @enderror"
                                   value="{{ old('correo') }}"
                                   placeholder="Ej: maria.gonzalez@gmail.com"
                                   novalidate />
                            @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Fecha de nacimiento -->
                        <div class="col-12 col-md-6">
                            <label for="fecha_nacimiento" class="form-label">
                                <i class="fas fa-calendar"></i> Fecha de nacimiento
                            </label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                   class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                   value="{{ old('fecha_nacimiento') }}" />
                            @error('fecha_nacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Sexo -->
                        <div class="col-12 col-md-6">
                            <label for="sexo" class="form-label">
                                <i class="fas fa-venus-mars"></i> Sexo
                            </label>
                            <select id="sexo" name="sexo" class="form-select @error('sexo') is-invalid @enderror">
                                <option value="">Seleccione</option>
                                <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            </select>
                            @error('sexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="col-12">
                            <label for="direccion" class="form-label">
                                <i class="fas fa-map-marker-alt"></i> Dirección
                            </label>
                            <textarea id="direccion" name="direccion" maxlength="200" rows="3"
                                      class="form-control @error('direccion') is-invalid @enderror"
                                      placeholder="Ej: Col. Miraflores, Tegucigalpa">{{ old('direccion') }}</textarea>
                            @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Botones -->
                        <div class="mt-4 d-flex gap-3 flex-wrap">
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="reset" class="btn btn-danger" id="btnLimpiar">
                                <i class="fas fa-eraser"></i> Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
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



        // Botón limpiar - ahora limpia TODOS los campos
        document.getElementById('btnLimpiar').addEventListener('click', function (e) {
            e.preventDefault();

            // Limpiar todos los campos del formulario
            document.getElementById('nombre').value = '';
            document.getElementById('telefono').value = '';
            document.getElementById('identidad').value = '';
            document.getElementById('correo').value = '';
            document.getElementById('fecha_nacimiento').value = '';
            document.getElementById('sexo').selectedIndex = 0;
            document.getElementById('direccion').value = '';

            // Remover todas las clases de error
            const campos = ['nombre', 'telefono', 'identidad', 'correo', 'fecha_nacimiento', 'sexo', 'direccion'];

            campos.forEach(campoId => {
                const elemento = document.getElementById(campoId);
                if (elemento) {
                    elemento.classList.remove('is-invalid');
                }
            });

            // Ocultar y limpiar mensajes de error
            document.querySelectorAll('.invalid-feedback').forEach(feedback => {
                feedback.style.display = 'none';
                feedback.textContent = '';
            });

            console.log('Formulario de clientes limpiado completamente');
        });
    });
</script>
</body>
</html>