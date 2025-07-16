<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalles del Cliente - Salón de Belleza</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            padding: 0.3rem 0;
            color: #333;
            margin: 0;
            overflow: hidden;
        }

        .container {
            max-width: 800px;
            background: rgba(255, 255, 255, 0.95);
            margin: 0 auto;
            padding: 0.8rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInUp 0.6s ease-out;
            height: calc(100vh - 0.6rem);
            display: flex;
            flex-direction: column;
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
            margin-bottom: 0.8rem;
            position: relative;
        }

        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .beauty-header h2 i {
            color: #E4007C;
            font-size: 1.1rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-8px);
            }
            60% {
                transform: translateY(-4px);
            }
        }

        .beauty-header::after {
            content: '';
            display: block;
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 6px auto;
            border-radius: 2px;
        }

        /* Card de información del cliente */
        .client-details {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.05), rgba(228, 0, 124, 0.02));
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 12px;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            animation: slideInDown 0.8s ease-out;
            flex: 1;
            overflow-y: auto;
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

        dt {
            font-weight: 700;
            color: #7B2A8D;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 5px;
            padding-left: 0.25rem;
            padding-right: 0.25rem;
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
            padding-left: 0.25rem;
            padding-right: 0.25rem;
            min-height: 35px;
            display: flex;
            align-items: center;
        }

        /* Estilo especial para el nombre del cliente - SIN ICONO INTERNO */
        .client-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            background: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            border: 1px solid rgba(228, 0, 124, 0.2);
            margin: 0;
            min-height: 40px;
            display: flex;
            align-items: center;
        }

        /* Elementos especiales para edad */
        .age-container {
            background: linear-gradient(135deg, #fff8fc 0%, #f8f0ff 100%);
            border: 2px solid rgba(228, 0, 124, 0.2);
            border-radius: 8px;
            padding: 0.6rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 50px;
        }

        .age-icon {
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            box-shadow: 0 4px 12px rgba(228, 0, 124, 0.3);
        }

        .age-info {
            flex: 1;
        }

        .age-primary {
            font-size: 1rem;
            font-weight: 700;
            color: #7B2A8D;
            margin-bottom: 2px;
        }

        .age-category {
            font-size: 0.75rem;
            color: #666;
            font-weight: 500;
            font-style: italic;
        }

        textarea[readonly] {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(228, 0, 124, 0.2);
            border-radius: 8px;
            padding: 0.5rem 0.7rem;
            resize: none;
            font-family: inherit;
            color: #444;
            font-weight: 500;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            width: 100%;
            min-height: 60px;
        }

        textarea[readonly]:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
        }

        /* Estados especiales para sexo */
        .sex-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.3rem 0.6rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            min-height: 32px;
        }

        .sex-femenino {
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.15), rgba(228, 0, 124, 0.05));
            color: #7B2A8D;
            border: 1px solid rgba(228, 0, 124, 0.3);
        }

        .sex-masculino {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.15), rgba(0, 123, 255, 0.05));
            color: #0056b3;
            border: 1px solid rgba(0, 123, 255, 0.3);
        }

        /* Grupo de botones */
        .button-group {
            display: flex;
            gap: 0.7rem;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 0.8rem;
            padding-top: 0.8rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
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

        /* Botón primario - Editar */
        .btn-primary-beauty {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
        }

        .btn-primary-beauty:hover {
            background: linear-gradient(135deg, #6a267f 0%, #c3006a 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(228, 0, 124, 0.4);
            color: white;
        }

        /* Botón secundario - Volver */
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

            .client-details {
                padding: 0.8rem;
            }

            dt {
                font-size: 0.8rem;
            }

            dd {
                font-size: 0.85rem;
            }

            .age-container {
                flex-direction: column;
                align-items: center;
                gap: 8px;
            }

            .age-icon {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .client-name {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h2 {
                font-size: 1.2rem;
                flex-direction: column;
                gap: 5px;
            }

            .btn-beauty {
                padding: 0.45rem 1rem;
                font-size: 0.75rem;
            }

            .container {
                padding: 0.8rem;
            }

            .client-name {
                font-size: 0.85rem;
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

            .client-details {
                margin-bottom: 0.8rem;
            }

            .button-group {
                margin-top: 0.8rem;
                padding-top: 0.8rem;
            }
        }

        /* Ajuste para que dt y dd estén más cerca horizontalmente */
        dl.row.gx-1,
        dl.row.gx-1 > * {
            padding-left: 0.25rem !important;
            padding-right: 0.25rem !important;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-user-circle"></i> Detalles del Cliente</h2>
    </div>

    <div class="client-details">
        <dl class="row gx-1 align-items-center">
            <!-- Nombre del cliente -->
            <dt class="col-sm-3">
                <i class="fas fa-user"></i>
                Nombre:
            </dt>
            <dd class="col-sm-9">
                <div class="client-name">
                    {{ $cliente->nombre ?? 'María Elena González' }}
                </div>
            </dd>

            <!-- Teléfono -->
            <dt class="col-sm-3">
                <i class="fas fa-phone"></i>
                Teléfono:
            </dt>
            <dd class="col-sm-9">{{ $cliente->telefono ?? '98765432' }}</dd>

            <!-- Identidad -->
            <dt class="col-sm-3">
                <i class="fas fa-id-card"></i>
                Identidad:
            </dt>
            <dd class="col-sm-9">{{ $cliente->identidad ?? '0801199012345' }}</dd>

            <!-- Correo -->
            <dt class="col-sm-3">
                <i class="fas fa-envelope"></i>
                Correo:
            </dt>
            <dd class="col-sm-9">{{ $cliente->correo ?? 'maria.gonzalez@gmail.com' }}</dd>

            <!-- Fecha de nacimiento y edad -->
            @php
                $fechaNacimiento = $cliente->fecha_nacimiento ?? '1990-05-15';
                $edad = \Carbon\Carbon::parse($fechaNacimiento)->age;
            @endphp

                    <!-- Fecha de nacimiento -->
            <dt class="col-sm-3">
                <i class="fas fa-birthday-cake"></i>
                Fecha de nacimiento:
            </dt>
            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($fechaNacimiento)->format('d/m/Y') }}</dd>

            <!-- Edad -->
            <dt class="col-sm-3">
                <i class="fas fa-hourglass-half"></i>
                Edad:
            </dt>
            <dd class="col-sm-9">
                <div class="age-container">
                    <div class="age-icon">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <div class="age-info">
                        <div class="age-primary">{{ $edad }} años</div>
                        <div class="age-category">
                            @if($edad < 18)
                                Menor de edad
                            @elseif($edad >= 18 && $edad < 65)
                                Adulto
                            @else
                                Adulto mayor
                            @endif
                        </div>
                    </div>
                </div>
            </dd>

            <!-- Sexo -->
            <dt class="col-sm-3">
                <i class="fas fa-venus-mars"></i>
                Sexo:
            </dt>
            <dd class="col-sm-9">
                <span class="sex-badge sex-{{ $cliente->sexo ?? 'femenino' }}">
                    <i class="fas fa-{{ ($cliente->sexo ?? 'femenino') == 'femenino' ? 'venus' : 'mars' }}"></i>
                    {{ ucfirst($cliente->sexo ?? 'Femenino') }}
                </span>
            </dd>

            <!-- Dirección -->
            <dt class="col-sm-3">
                <i class="fas fa-map-marker-alt"></i>
                Dirección:
            </dt>
            <dd class="col-sm-9">
                <textarea readonly class="form-control" rows="3">{{ $cliente->direccion ?? 'Col. Miraflores, Tegucigalpa, Honduras' }}</textarea>
            </dd>
        </dl>
    </div>

    <div class="button-group">
        <a href="{{ route('clientes.index') }}" class="btn btn-beauty btn-secondary-beauty">
            <i class="fas fa-arrow-left"></i>
            Volver al listado
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>