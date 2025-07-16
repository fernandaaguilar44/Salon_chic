<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear producto</title>
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
@include('layouts.slider')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
        </div>
    </div>

<div class="form-container">
    <h2><i class="fas fa-box"></i> Registrar un nuevo producto</h2>
    <form id="formProducto" method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- Información básica del producto -->
        <h5><i class="fas fa-info-circle"></i> Información básica</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label"><i class="fas fa-tag"></i> Nombre del producto</label>
                <input type="text" name="nombre" id="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre') }}" maxlength="50"
                       placeholder="Ej: Crema hidratante"
                       pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s0-9]+$" required />
                @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="codigo" class="form-label"><i class="fas fa-barcode"></i> Código</label>
                <input type="text" name="codigo" id="codigo"
                       class="form-control @error('codigo') is-invalid @enderror"
                       value="{{ old('codigo') }}" maxlength="7"
                       placeholder="Ej: ABC-123"
                       pattern="^[A-Z]{3}-\d{3}$"
                       required
                       oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-7\-]/g, '')" />
                @error('codigo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="categoria" class="form-label"><i class="fas fa-list"></i> Categoría</label>
                <select name="categoria" id="categoria"
                        class="form-control @error('categoria') is-invalid @enderror" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="Cabello" {{ old('categoria') == 'Cabello' ? 'selected' : '' }}>Cabello</option>
                    <option value="Manicura" {{ old('categoria') == 'Manicura' ? 'selected' : '' }}>Manicura</option>
                    <option value="Pedicura" {{ old('categoria') == 'Pedicura' ? 'selected' : '' }}>Pedicura</option>
                </select>
                @error('categoria')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="marca" class="form-label"><i class="fas fa-copyright"></i> Marca</label>
                <input type="text" name="marca" id="marca"
                       class="form-control @error('marca') is-invalid @enderror"
                       value="{{ old('marca') }}" maxlength="50"
                       placeholder="Ej: L'Oréal, Maybelline, etc."
                       pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s´,']+$" required />
                @error('marca')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="descripcion" class="form-label"><i class="fas fa-align-left"></i> Descripción</label>
            <textarea name="descripcion" id="descripcion"
                      class="form-control @error('descripcion') is-invalid @enderror"
                      maxlength="200" rows="3"
                      placeholder="Describe las características principales del producto..."
                      required {{ old('descripcion') }} ></textarea>
            @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="imagen" class="form-label"><i class="fas fa-image"></i> Imagen del producto</label>
                <input type="file" name="imagen" id="imagen"
                       class="form-control @error('imagen') is-invalid @enderror"
                       accept="image/*" required />
                @error('imagen')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Botones -->
        <div class="btn-group-left">
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
            <button type="reset" class="btn btn-danger" id="btnLimpiar">
                <i class="fas fa-eraser"></i> Limpiar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar producto
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const form = document.getElementById('formProducto');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const inputs = form.querySelectorAll('input, textarea, select');
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

        // Validación nombre
        const nombre = form.nombre;
        if (!nombre.value.trim()) {
            mostrarError(nombre, 'El nombre del producto es obligatorio.');
        } else if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre.value)) {
            mostrarError(nombre, 'Solo se permiten letras, números y espacios.');
        } else if (nombre.value.length > 50) {
            mostrarError(nombre, 'Máximo 50 caracteres permitidos.');
        }

        // Validación código
        const codigo = form.codigo;
        if (!codigo.value.trim()) {
            mostrarError(codigo, 'El código del producto es obligatorio.');
        } else if (!/^[A-Z]{3}-\d{3}$/.test(codigo.value)) {
            mostrarError(codigo, 'El código solo puede contener letras mayúsculas, números y guion (-).');
        } else if (codigo.value.length > 7) {
            mostrarError(codigo, 'Máximo 7 caracteres permitidos.');
        } else if (!/^[A-Z]{3}-\d{3}$/.test(codigo.value)) {
        mostrarError(codigo, 'El código debe tener el formato AAA-123.');
    }


        // Validación categoría
        if (!categoria.value) {
            mostrarError(categoria, 'Debe seleccionar una categoría.');
        }


        // Validación marca
        const marca = form.marca;
        if (!marca.value.trim()) {
            mostrarError(marca, 'La marca es obligatoria.');
        } else if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s´,']+$/.test(marca.value)) {
            mostrarError(marca, 'Solo se permiten letras y espacios.');
        } else if (marca.value.length > 50) {
            mostrarError(marca, 'Máximo 50 caracteres permitidos.');
        }

        // Validación descripción
        const descripcion = form.descripcion;
        if (!descripcion.value.trim()) {
            mostrarError(descripcion, 'La descripción es obligatoria.');
        } else if (descripcion.value.length > 200) {
            mostrarError(descripcion, 'Máximo 200 caracteres permitidos.');
        }

        document.getElementById('imagen').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.invalid-feedback');
            if(feedback) feedback.remove();
        });

        // Validación imagen
        const imagen = form.imagen;
        if (!imagen.value) {
            mostrarError(imagen, 'Debe seleccionar una imagen del producto.');
        } else {
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.bmp)$/i;
            if (!allowedExtensions.exec(imagen.value)) {
                mostrarError(imagen, 'Formato no válido. Solo se permiten: .jpg, .jpeg, .png, .gif, .bmp');
            }
        }

        if (valid) {
            form.submit();
        }
        document.getElementById('btnLimpiar').addEventListener('click', () => {
            const inputs = document.querySelectorAll('#formProducto input, #formProducto textarea, #formProducto select');

            inputs.forEach(input => {
                input.classList.remove('is-invalid');
                // Quitar mensajes de error si existen
                const feedback = input.parentNode.querySelector('.invalid-feedback');
                if (feedback) feedback.remove();
            });
        });

    });
</script>

</body>
</html>
