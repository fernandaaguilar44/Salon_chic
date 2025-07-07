<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .beauty-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .beauty-header h3 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.6rem;
            margin: 0;
        }

        .beauty-header::after {
            content: '';
            display: block;
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 10px auto;
            border-radius: 2px;
        }

        /* Breadcrumb */
        .breadcrumb-container {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: slideInDown 0.5s ease-out;
        }

        .breadcrumb {
            background: none;
            margin: 0;
        }

        .breadcrumb-item a {
            color: #7B2A8D;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item a:hover {
            color: #E4007C;
        }

        .breadcrumb-item.active {
            color: #E4007C;
            font-weight: 600;
        }

        /* Alertas */
        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.15);
            animation: slideInDown 0.5s ease-out;
            margin-bottom: 2rem;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(25, 135, 84, 0.05));
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(176, 42, 55, 0.05));
            border-left: 4px solid #dc3545;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #7B2A8D;
        }

        .section-title:first-child {
            margin-top: 0;
        }

        label {
            font-weight: 600;
            color: #4a4a4a;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        label i {
            margin-right: 8px;
            color: #E4007C;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            background: rgba(255, 255, 255, 0.85);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-style: italic;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* Input de archivo personalizado */
        .file-input-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border: 2px dashed #E4007C;
            border-radius: 12px;
            background: rgba(228, 0, 124, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            color: #7B2A8D;
            font-weight: 600;
        }

        .file-input-label:hover {
            background: rgba(228, 0, 124, 0.1);
            border-color: #7B2A8D;
        }

        .file-input-label i {
            font-size: 2rem;
            margin-right: 1rem;
            color: #E4007C;
        }

        /* Imagen actual */
        .current-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(123, 42, 141, 0.2);
            margin-bottom: 1rem;
        }

        .image-preview-container {
            text-align: center;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 1rem;
            margin-top: 2rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            padding-top: 1rem;
        }

        .btn-beauty {
            padding: 0.7rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary-beauty {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
        }

        .btn-primary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228, 0, 124, 0.4);
            color: white;
        }

        .btn-secondary-beauty {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                margin: 0 0.5rem;
                padding: 1.5rem;
            }

            .beauty-header h3 {
                font-size: 1.4rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-beauty {
                width: 100%;
                justify-content: center;
            }

            .file-input-label {
                padding: 1.5rem;
            }

            .file-input-label i {
                font-size: 1.5rem;
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
    <!-- Breadcrumb -->


    <div class="beauty-header">
        <h3><i class="fas fa-edit"></i> Editar un producto</h3>
    </div>

    <!-- Mensaje de éxito (ejemplo) -->
    <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="successAlert">
        <strong><i class="fas fa-check-circle"></i> Perfecto:</strong> Producto actualizado correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>

    <!-- Mensaje de error (ejemplo) -->
    <div class="alert alert-danger alert-dismissible fade show d-none" role="alert" id="errorAlert">
        <strong><i class="fas fa-exclamation-triangle"></i> Oops! Hay algunos errores:</strong>
        <ul class="mb-0 mt-2">
            <li>El nombre del producto es requerido</li>
            <li>La categoría es requerida</li>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>

    <form method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="section-title"><i class="fas fa-info-circle"></i> Información del producto</div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre"><i class="fas fa-tag"></i> Nombre del producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                       value="{{ old('nombre', $producto->nombre) }}" maxlength="50" required />
            </div>
            <div class="col-md-6">
                <label for="codigo"><i class="fas fa-barcode"></i> Código</label>
                <input
                        type="text"
                        name="codigo"
                        id="codigo"
                        class="form-control @error('codigo') is-invalid @enderror"
                        value="{{ old('codigo', $producto->codigo) }}"
                        maxlength="9"
                        required
                        oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9\-]/g, '')"
                />
                @error('codigo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="categoria"><i class="fas fa-layer-group"></i> Categoría</label>
                <select name="categoria" id="categoria" class="form-control" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="Cabello" {{ old('categoria', $producto->categoria) == 'Cabello' ? 'selected' : '' }}>Cabello</option>
                    <option value="Manicura" {{ old('categoria', $producto->categoria) == 'Manicura' ? 'selected' : '' }}>Manicura</option>
                    <option value="Pedicura" {{ old('categoria', $producto->categoria) == 'Pedicura' ? 'selected' : '' }}>Pedicura</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="marca"><i class="fas fa-certificate"></i> Marca</label>
                <input type="text" name="marca" id="marca" class="form-control"
                       value="{{ old('marca', $producto->marca) }}" maxlength="50" required />
            </div>
        </div>



        <div class="mb-3">
            <label for="descripcion"><i class="fas fa-align-left"></i> Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" maxlength="500">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="section-title"><i class="fas fa-image"></i> Imagen del producto</div>

        <!-- Imagen actual -->
        @if($producto->imagen)
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-image"></i> Imagen actual
                </label>
                <div class="image-preview-container">
                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                         alt="Imagen actual del producto"
                         class="current-image">
                    <p class="text-muted mt-2">Imagen actual del producto</p>
                </div>
            </div>
        @endif

        <!-- Nueva imagen -->
        <div class="mb-3">
            <label for="imagen">
                <i class="fas fa-camera"></i> Cambiar imagen (opcional)
            </label>
            <div class="file-input-container">
                <input type="file" class="file-input" id="imagen" name="imagen"
                       accept="image/*" onchange="previewImage(this)">
                <label for="imagen" class="file-input-label">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <div>
                        <div>Seleccionar nueva imagen</div>
                        <small class="text-muted">JPG, PNG, GIF - Máximo 2MB</small>
                    </div>
                </label>
            </div>
            <div id="imagePreview" class="image-preview-container" style="display: none;">
                <img id="preview" class="current-image" alt="Vista previa">
                <p class="text-muted mt-2">Vista previa de la nueva imagen</p>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('productos.index') }}" class="btn-beauty btn-secondary-beauty">
            <i class="fas fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn-beauty btn-primary-beauty">
                <i class="fas fa-save"></i> Actualizar producto
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Preview de imagen
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.style.display = 'none';
        }
    }

    // Animación para el input file
    document.getElementById('imagen').addEventListener('change', function() {
        const label = document.querySelector('.file-input-label');
        if (this.files.length > 0) {
            label.style.borderColor = '#28a745';
            label.style.backgroundColor = 'rgba(40, 167, 69, 0.1)';
            label.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <div>
                    <div>Imagen seleccionada: ${this.files[0].name}</div>
                    <small class="text-success">¡Listo para subir!</small>
                </div>
            `;
        }
    });

    // Función demo para mostrar alertas
    function showDemoAlert() {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');

        // Alternar entre mostrar éxito y error
        if (successAlert.classList.contains('d-none')) {
            successAlert.classList.remove('d-none');
            errorAlert.classList.add('d-none');
        } else {
            errorAlert.classList.remove('d-none');
            successAlert.classList.add('d-none');
        }
    }

</script>

</body>
</html>
