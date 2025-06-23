<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalles del Proveedor</title>
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
            max-width: 950px;
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
            margin-bottom: 1.2rem;
            position: relative;
        }

        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.5rem;
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

        /* Cards de información */
        .provider-details {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.05), rgba(228, 0, 124, 0.02));
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            animation: slideInDown 0.8s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 2px solid #E4007C;
            padding-bottom: 0.3rem;
        }

        .section-title i {
            color: #E4007C;
            font-size: 0.9rem;
        }

        dt {
            font-weight: 700;
            color: #7B2A8D;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 5px;
        }

        dt i {
            color: #E4007C;
            font-size: 0.75rem;
            width: 14px;
            text-align: center;
        }

        dd {
            color: #444;
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 0.6rem;
            padding: 0.4rem 0.6rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            border-left: 3px solid #E4007C;
        }

        /* Imagen del proveedor */
        .image-container {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.05), rgba(228, 0, 124, 0.02));
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: slideInRight 0.8s ease-out;
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

        .img-proveedor {
            max-width: 100%;
            width: 100%;
            max-height: 300px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(123, 42, 141, 0.25);
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .img-proveedor:hover {
            transform: scale(1.02);
        }

        .no-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
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

        /* Botones */
        .button-group {
            display: flex;
            gap: 0.7rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 1.2rem;
            padding-top: 1.2rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
        }

        .btn-beauty {
            padding: 0.5rem 1.2rem;
            font-size: 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            min-width: 140px;
            text-align: center;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
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

        /* Botón principal */
        .btn-primary-beauty {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
        }

        .btn-primary-beauty:hover {
            background: linear-gradient(135deg, #c3006a 0%, #6a267f 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(228, 0, 124, 0.4);
            color: white;
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
        @media (max-width: 768px) {
            .container {
                margin: 0 0.25rem;
                padding: 1rem;
            }

            .beauty-header h2 {
                font-size: 1.3rem;
            }

            .button-group {
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
            }

            .btn-beauty {
                width: 100%;
                max-width: 250px;
                min-width: auto;
            }

            .provider-details, .image-container {
                padding: 0.8rem;
            }

            .section-title {
                font-size: 0.9rem;
            }

            dt {
                font-size: 0.75rem;
            }

            dd {
                font-size: 0.8rem;
            }

            .img-proveedor {
                max-height: 250px;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h2 {
                font-size: 1.2rem;
            }

            .btn-beauty {
                padding: 0.45rem 1rem;
                font-size: 0.75rem;
            }

            .container {
                padding: 0.8rem;
            }

            .img-proveedor {
                max-height: 200px;
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
                margin-bottom: 0.8rem;
            }

            .provider-details, .image-container {
                margin-bottom: 0.8rem;
            }

            .button-group {
                margin-top: 0.8rem;
                padding-top: 0.8rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-truck"></i> Detalles del Proveedor</h2>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="provider-details">
                <h3 class="section-title">
                    <i class="fas fa-building"></i>
                    Datos de la Empresa
                </h3>
                <dl class="row">
                    <dt class="col-sm-5">
                        <i class="fas fa-industry"></i>
                        Nombre Empresa:
                    </dt>
                    <dd class="col-sm-7">{{ $proveedor->nombre_empresa }}</dd>

                    <dt class="col-sm-5">
                        <i class="fas fa-phone"></i>
                        Teléfono Encargado:
                    </dt>
                    <dd class="col-sm-7">{{ $proveedor->telefono_empleado_encargado }}</dd>

                    <dt class="col-sm-5">
                        <i class="fas fa-map-marker-alt"></i>
                        Dirección:
                    </dt>
                    <dd class="col-sm-7">{{ $proveedor->direccion }}</dd>

                    <dt class="col-sm-5">
                        <i class="fas fa-city"></i>
                        Ciudad:
                    </dt>
                    <dd class="col-sm-7">{{ $proveedor->ciudad }}</dd>

                    <dt class="col-sm-5">
                        <i class="fas fa-calendar-check"></i>
                        Fecha de Registro:
                    </dt>
                    <dd class="col-sm-7">{{ $proveedor->fecha_registro }}</dd>
                </dl>
            </div>

            <div class="provider-details">
                <h3 class="section-title">
                    <i class="fas fa-user"></i>
                    Datos del Proveedor
                </h3>
                <dl class="row">
                    <dt class="col-sm-5">
                        <i class="fas fa-user-circle"></i>
                        Nombre:
                    </dt>
                    <dd class="col-sm-7">{{ $proveedor->nombre_proveedor }}</dd>

                    <dt class="col-sm-5">
                        <i class="fas fa-phone-alt"></i>
                        Teléfono:
                    </dt>
                    <dd class="col-sm-7">{{ $proveedor->telefono }}</dd>
                </dl>
            </div>
        </div>

        <div class="col-md-4">
            <div class="image-container">
                <h3 class="section-title">
                    <i class="fas fa-image"></i>
                    Imagen del Proveedor
                </h3>
                @if($proveedor->imagen)
                    <img src="{{ asset('storage/' . $proveedor->imagen) }}"
                         alt="Imagen del proveedor"
                         class="img-proveedor" />
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
        <a href="{{ route('proveedores.index') }}" class="btn btn-beauty btn-primary-beauty">
            <i class="fas fa-arrow-left"></i>
            Volver a la lista
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
