<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalle del Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 0.5rem 0;
            color: #333;
            margin: 0;
        }

        .container {
            max-width: 1100px;
            background: rgba(255, 255, 255, 0.95);
            margin: 0 auto;
            padding: 1.2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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

        .beauty-header {
            text-align: center;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
        }

        .beauty-header::after {
            content: '';
            display: block;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 10px auto;
            border-radius: 2px;
        }

        /* Layout principal con imagen a la derecha */
        .main-content {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-image {
            flex: 0 0 350px;
            max-width: 350px;
        }

        /* Cards de información */
        .product-details {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.05), rgba(228, 0, 124, 0.02));
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 12px;
            padding: 1.2rem;
            margin-bottom: 1.2rem;
            animation: slideInLeft 0.8s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .section-title {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 2px solid #E4007C;
            padding-bottom: 0.5rem;
        }

        .section-title i {
            color: #E4007C;
            font-size: 1rem;
        }

        dt {
            font-weight: 700;
            color: #7B2A8D;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        dt i {
            color: #E4007C;
            font-size: 0.8rem;
            width: 16px;
            text-align: center;
        }

        dd {
            color: #444;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
            padding: 0.6rem 0.8rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            border-left: 3px solid #E4007C;
        }

        /* Imagen del producto */
        .image-container {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.05), rgba(228, 0, 124, 0.02));
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 12px;
            padding: 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: slideInRight 0.8s ease-out;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .img-producto {
            width: 100%;
            max-height: 400px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(123, 42, 141, 0.25);
            object-fit: cover;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .img-producto:hover {
            transform: scale(1.02);
        }

        /* Modal de imagen */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            animation: fadeIn 0.3s ease-out;
        }

        .image-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content-image {
            max-width: 90%;
            max-height: 90%;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(228, 0, 124, 0.3);
            animation: zoomIn 0.4s ease-out;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.7);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
            transition: all 0.3s ease;
            background: rgba(228, 0, 124, 0.8);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .close-modal:hover {
            background: rgba(228, 0, 124, 1);
            transform: scale(1.1);
        }

        .image-hint {
            font-size: 0.75rem;
            color: #7B2A8D;
            text-align: center;
            margin-top: 0.8rem;
            opacity: 0.8;
            font-style: italic;
        }

        .no-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 250px;
            color: #7B2A8D;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            border: 2px dashed rgba(228, 0, 124, 0.3);
        }

        .no-image i {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            color: #E4007C;
        }

        /* Descripción especial */
        .description-section {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.03), rgba(228, 0, 124, 0.01));
            border: 2px solid rgba(228, 0, 124, 0.08);
            border-radius: 12px;
            padding: 1.2rem;
            margin-bottom: 1.2rem;
            animation: slideInLeft 0.8s ease-out 0.2s both;
        }

        .description-content {
            color: #444;
            font-weight: 500;
            font-size: 0.95rem;
            line-height: 1.6;
            padding: 0.8rem 1rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            border-left: 4px solid #E4007C;
            font-style: italic;
        }

        /* Botones */
        .button-group {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
        }

        .btn-beauty {
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
            border-radius: 25px;
            font-weight: 600;
            min-width: 160px;
            text-align: center;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-beauty::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-beauty:hover::before {
            left: 100%;
        }

        /* Botón secundario */
        .btn-secondary-beauty {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            background: linear-gradient(135deg, #5a6268 0%, #3d4043 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
            color: white;
        }

        /* Responsive mejorado */
        @media (max-width: 992px) {
            .main-content {
                flex-direction: column;
            }

            .product-image {
                flex: none;
                max-width: 100%;
                order: -1;
            }

            .image-container {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .container {
                margin: 0 0.5rem;
                padding: 1rem;
            }

            .beauty-header h2 {
                font-size: 1.5rem;
            }

            .main-content {
                gap: 1rem;
            }

            .product-details, .image-container, .description-section {
                padding: 1rem;
            }

            .section-title {
                font-size: 1rem;
            }

            .dt {
                font-size: 0.85rem;
            }

            .dd {
                font-size: 0.85rem;
            }

            .img-producto {
                max-height: 300px;
            }

            .button-group {
                flex-direction: column;
                align-items: center;
                gap: 0.6rem;
            }

            .btn-beauty {
                width: 100%;
                max-width: 280px;
                min-width: auto;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h2 {
                font-size: 1.3rem;
            }

            .btn-beauty {
                padding: 0.5rem 1.2rem;
                font-size: 0.8rem;
            }

            .container {
                padding: 0.8rem;
                margin: 0 0.25rem;
            }

            .img-producto {
                max-height: 250px;
            }
        }

        /* Ajuste para pantallas muy pequeñas en altura */
        @media (max-height: 700px) {
            body {
                padding: 0.25rem 0;
            }

            .container {
                padding: 0.8rem;
            }

            .beauty-header {
                margin-bottom: 1rem;
            }

            .main-content {
                gap: 1rem;
            }

            .product-details, .image-container, .description-section {
                margin-bottom: 1rem;
            }

            .button-group {
                margin-top: 1rem;
                padding-top: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-box-open"></i> Detalle del Producto</h2>
    </div>

    <div class="main-content">
        <!-- Información del producto a la izquierda -->
        <div class="product-info">
            <div class="product-details">
                <h3 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Información del Producto
                </h3>
                <dl class="row">
                    <dt class="col-sm-5">
                        <i class="fas fa-tag"></i>
                        Nombre:
                    </dt>
                    <dd class="col-sm-7">{{ $producto->nombre }}</dd>

                    <dt class="col-sm-5">
                        <i class="fas fa-barcode"></i>
                        Código:
                    </dt>
                    <dd class="col-sm-7">{{ $producto->codigo }}</dd>

                    <dt class="col-sm-5">
                        <i class="fas fa-layer-group"></i>
                        Categoría:
                    </dt>
                    <dd class="col-sm-7">{{ $producto->categoria }}</dd>

                    <dt class="col-sm-5">
                        <i class="fas fa-certificate"></i>
                        Marca:
                    </dt>
                    <dd class="col-sm-7">{{ $producto->marca }}</dd>
                </dl>
            </div>

            @if($producto->descripcion)
                <div class="description-section">
                    <h3 class="section-title">
                        <i class="fas fa-align-left"></i>
                        Descripción del Producto
                    </h3>
                    <div class="description-content">
                        {{ $producto->descripcion }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Imagen del producto a la derecha -->
        <div class="product-image">
            <div class="image-container">
                <h3 class="section-title">
                    <i class="fas fa-image"></i>
                    Imagen del Producto
                </h3>
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                         alt="Imagen de {{ $producto->nombre }}"
                         class="img-producto"
                         onclick="openImageModal(this.src, this.alt)" />
                    <div class="image-hint">
                        <i class="fas fa-search-plus"></i> Click para ampliar
                    </div>
                @else
                    <div class="no-image">
                        <i class="fas fa-image"></i>
                        <span>Sin imagen disponible</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="button-group">
        <a href="{{ route('productos.index') }}" class="btn btn-beauty btn-secondary-beauty">
            <i class="fas fa-arrow-left"></i>
            Volver a la lista
        </a>
    </div>
</div>

<!-- Modal para imagen ampliada -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <span class="close-modal" onclick="closeImageModal()">&times;</span>
    <img id="modalImage" class="modal-content-image" onclick="event.stopPropagation()">
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function openImageModal(src, alt) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');

        modal.classList.add('show');
        modalImg.src = src;
        modalImg.alt = alt;

        // Prevenir scroll del body cuando el modal está abierto
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.remove('show');

        // Restaurar scroll del body
        document.body.style.overflow = 'auto';
    }

    // Cerrar modal con tecla Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
</body>
</html>
