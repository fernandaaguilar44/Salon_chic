<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Proveedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 1rem 0;
        }

        .form-container {
            max-width: 900px;
            background: rgba(255, 255, 255, 0.95);
            margin: 0 auto;
            padding: 1.8rem 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
            position: relative;
        }

        h2::after {
            content: '';
            display: block;
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 8px auto 0;
            border-radius: 2px;
        }

        h5 {
            color: #7B2A8D;
            font-weight: 700;
            margin-bottom: 1rem;
            border-bottom: 2px solid rgba(228, 0, 124, 0.15);
            padding-bottom: 4px;
        }

        label {
            font-weight: 600;
            color: #4a4a4a;
            margin-bottom: 6px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        .form-control:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
            color: #000;
        }

        .form-label {
            color: #000000 !important;
        }

        .invalid-feedback {
            font-size: 0.8rem;
        }

        .row.mb-3 {
            margin-bottom: 1.2rem !important;
        }

        .btn-group-left {
            display: flex;
            gap: 1rem;
            justify-content: flex-start;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
        }

        .btn {
            padding: 0.7rem 1.8rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228, 0, 124, 0.4);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                margin: 0 0.5rem;
                padding: 1.2rem 1rem;
            }

            .btn-group-left {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animaciones */
        .form-container {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2><i class="fas fa-truck"></i> Crear un nuevo proveedor</h2>
    <form id="formProveedor" method="POST" action="{{ route('proveedores.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- Datos empresa -->
        <h5><i class="fas fa-building"></i> Datos de la empresa</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre_empresa" class="form-label"><i class="fas fa-industry"></i> Nombre de la empresa</label>
                <input type="text" name="nombre_empresa" id="nombre_empresa"
                       class="form-control @error('nombre_empresa') is-invalid @enderror"
                       value="{{ old('nombre_empresa') }}" maxlength="50"
                       pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                @error('nombre_empresa')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="telefono_empleado_encargado" class="form-label"><i class="fas fa-phone"></i> Teléfono de la empresa</label>
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
                <label for="direccion" class="form-label"><i class="fas fa-address-book"></i>Dirección</label>
                <textarea name="direccion" id="direccion"
                          class="form-control @error('direccion') is-invalid @enderror"
                          maxlength="200" rows="3" required>{{ old('direccion') }}</textarea>
                @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="ciudad" class="form-label"><i class="fas fa-city"></i> Ciudad</label>
                <input type="text" name="ciudad" id="ciudad"
                       class="form-control @error('ciudad') is-invalid @enderror"
                       value="{{ old('ciudad') }}" maxlength="35"
                       pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                @error('ciudad')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label"><i class="fas fa-image"></i> Imagen</label>
            <input type="file" name="imagen" id="imagen"
                   class="form-control @error('imagen') is-invalid @enderror" accept="image/*" required />
            @error('imagen')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Datos vendedor -->
        <h5 class="mt-4"><i class="fas fa-user-tie"></i> Datos del vendedor</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre_proveedor" class="form-label"><i class="fas fa-user"></i> Nombre del vendedor</label>
                <input type="text" name="nombre_proveedor" id="nombre_proveedor"
                       class="form-control @error('nombre_proveedor') is-invalid @enderror"
                       value="{{ old('nombre_proveedor') }}" maxlength="50"
                       pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                @error('nombre_proveedor')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="telefono" class="form-label"><i class="fas fa-phone"></i> Teléfono del vendedor</label>
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
        <div class="btn-group-left">
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
            <button type="reset" class="btn btn-danger" id="btnLimpiar">
                <i class="fas fa-eraser"></i> Limpiar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Crear proveedor
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const form = document.getElementById('formProveedor');

    document.getElementById('btnLimpiar').addEventListener('click', () => {
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.value = ''; // limpia el contenido
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
