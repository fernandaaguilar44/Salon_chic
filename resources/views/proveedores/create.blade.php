<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Proveedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #e6e6fa;
        }
        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            color: black;
        }
        .form-label {
            color: #000000;
        }
        .btn-primary, .btn-secondary, .btn-danger {
            background-color: #3a006b;
            border-color: #3a006b;
            color: white;
        }
        .btn-secondary:hover, .btn-danger:hover {
            background-color: #e4007c;
            border-color: #e4007c;
            color: white;
        }
        .btn-group-left {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-start;
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

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="form-container">

                <h2 class="mb-4 text-center" style="color: #3a006b;">Crear Proveedor</h2>
                <form id="formProveedor" method="POST" action="{{ route('proveedores.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Datos empresa -->
                    <h5 class="text-rosado fw-bold">Datos de la empresa</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_empresa" class="form-label">Nombre de la empresa</label>
                            <input type="text" name="nombre_empresa" id="nombre_empresa"
                                   class="form-control @error('nombre_empresa') is-invalid @enderror"
                                   value="{{ old('nombre_empresa') }}" maxlength="50"
                                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                            @error('nombre_empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefono_empleado_encargado" class="form-label">Teléfono de la empresa</label>
                            <input type="text" name="telefono_empleado_encargado" id="telefono_empleado_encargado"
                                   class="form-control @error('telefono_empleado_encargado') is-invalid @enderror"
                                   value="{{ old('telefono_empleado_encargado') }}" maxlength="8" inputmode="numeric"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                            @error('telefono_empleado_encargado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" name="direccion" id="direccion"
                                   class="form-control @error('direccion') is-invalid @enderror"
                                   value="{{ old('direccion') }}" maxlength="200" required />
                            @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" name="ciudad" id="ciudad"
                                   class="form-control @error('ciudad') is-invalid @enderror"
                                   value="{{ old('ciudad') }}" maxlength="25"
                                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                            @error('ciudad')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen (obligatoria)</label>
                        <input type="file" name="imagen" id="imagen"
                               class="form-control @error('imagen') is-invalid @enderror" accept="image/*" required />
                        @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Datos vendedor -->
                    <h5 class="text-rosado fw-bold mt-4">Datos del vendedor</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_proveedor" class="form-label">Nombre del vendedor</label>
                            <input type="text" name="nombre_proveedor" id="nombre_proveedor"
                                   class="form-control @error('nombre_proveedor') is-invalid @enderror"
                                   value="{{ old('nombre_proveedor') }}" maxlength="50"
                                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                            @error('nombre_proveedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono"
                                   class="form-control @error('telefono') is-invalid @enderror"
                                   value="{{ old('telefono') }}" maxlength="8" inputmode="numeric"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                            @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="btn-group-left mt-4">
                        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="reset" class="btn btn-danger" id="btnLimpiar">Limpiar</button>
                        <button type="submit" class="btn btn-primary">Crear Proveedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const form = document.getElementById('formProveedor');

    document.getElementById('btnLimpiar').addEventListener('click', () => {
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
            const feedback = input.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.remove();
            }
        });
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
            const feedback = input.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.remove();
            }
        });

        let valid = true;

        function mostrarError(input, mensaje) {
            input.classList.add('is-invalid');

            let feedback = input.nextElementSibling;
            if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                feedback = document.createElement('div');
                feedback.classList.add('invalid-feedback');
                input.parentNode.appendChild(feedback);
            }

            feedback.textContent = mensaje;
            valid = false;
        }

        // Validaciones
        const nombreEmpresa = form.nombre_empresa;
        if (!nombreEmpresa.value.trim()) {
            mostrarError(nombreEmpresa, 'El nombre de la empresa es obligatorio.');
        } else if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombreEmpresa.value)) {
            mostrarError(nombreEmpresa, 'Solo se permiten letras y espacios.');
        } else if (nombreEmpresa.value.length > 50) {
            mostrarError(nombreEmpresa, 'Máximo 50 caracteres.');
        }

        const telefonoEncargado = form.telefono_empleado_encargado;
        if (!telefonoEncargado.value.trim()) {
            mostrarError(telefonoEncargado, 'El teléfono de la empresa es obligatorio.');
        } else if (!/^\d{8}$/.test(telefonoEncargado.value)) {
            mostrarError(telefonoEncargado, 'Debe tener exactamente 8 dígitos.');
        } else if (!/^[389]/.test(telefonoEncargado.value)) {
            mostrarError(telefonoEncargado, 'Debe comenzar con 3, 8 o 9.');
        }

        const direccion = form.direccion;
        if (!direccion.value.trim()) {
            mostrarError(direccion, 'La dirección es obligatoria.');
        } else if (direccion.value.length > 200) {
            mostrarError(direccion, 'Máximo 200 caracteres.');
        }

        const ciudad = form.ciudad;
        if (!ciudad.value.trim()) {
            mostrarError(ciudad, 'La ciudad es obligatoria.');
        } else if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(ciudad.value)) {
            mostrarError(ciudad, 'Solo letras y espacios.');
        } else if (ciudad.value.length > 25) {
            mostrarError(ciudad, 'Máximo 25 caracteres.');
        }

        const imagen = form.imagen;
        if (!imagen.value) {
            mostrarError(imagen, 'Debe subir una imagen válida.');
        }

        const nombreProveedor = form.nombre_proveedor;
        if (!nombreProveedor.value.trim()) {
            mostrarError(nombreProveedor, 'El nombre del vendedor es obligatorio.');
        } else if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombreProveedor.value)) {
            mostrarError(nombreProveedor, 'Solo letras y espacios.');
        } else if (nombreProveedor.value.length > 50) {
            mostrarError(nombreProveedor, 'Máximo 50 caracteres.');
        }

        const telefono = form.telefono;
        if (!telefono.value.trim()) {
            mostrarError(telefono, 'El teléfono del vendedor es obligatorio.');
        } else if (!/^\d{8}$/.test(telefono.value)) {
            mostrarError(telefono, 'Debe tener exactamente 8 dígitos.');
        } else if (!/^[389]/.test(telefono.value)) {
            mostrarError(telefono, 'Debe comenzar con 3, 8 o 9.');
        }

        if (valid) {
            form.submit();
        }
    });
</script>
</body>
</html>
