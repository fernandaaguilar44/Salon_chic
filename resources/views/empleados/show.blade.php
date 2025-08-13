<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Empleado - Salón de Belleza</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 0.5rem;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 1rem;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 1rem);
            position: relative;
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

        /* Header */
        .beauty-header {
            text-align: center;
            margin-bottom: 0.8rem;
            padding-bottom: 0.6rem;
            border-bottom: 3px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
        }

        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .beauty-header h2 i {
            color: #E4007C;
            font-size: 2rem;
        }

        /* Main Content */
        .profile-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            min-height: 0;
        }

        /* Employee Header */
        .employee-header {
            background: linear-gradient(135deg, rgba(123, 42, 141, 0.08), rgba(228, 0, 124, 0.04));
            border: 2px solid rgba(228, 0, 124, 0.15);
            border-radius: 15px;
            padding: 1.2rem;
            animation: slideInDown 0.8s ease-out;
            flex-shrink: 0;
        }

        .employee-info {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
        }

        .employee-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(228, 0, 124, 0.3);
            border: 4px solid rgba(255, 255, 255, 0.9);
            flex-shrink: 0;
        }

        .employee-avatar i {
            color: white;
            font-size: 2.2rem;
        }

        .employee-details {
            flex: 1;
            min-width: 0;
        }

        .employee-name {
            font-size: 1.6rem;
            font-weight: 600;
            color: #7B2A8D;
            margin-bottom: 0.4rem;
            word-wrap: break-word;
            word-break: break-word;
            hyphens: auto;
            line-height: 1.3;
            overflow-wrap: break-word;
            white-space: normal;
        }

        /* Centrar nombres cortos (menos de 20 caracteres) */
        .employee-name.short-name {
            text-align: center;
        }

        .employee-meta {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .employee-position {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.1rem;
            color: #555;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.7);
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            border-left: 3px solid #0ea5e9;
            width: fit-content;
        }

        .employee-position i {
            color: #0ea5e9;
            font-size: 1rem;
        }

        .employee-status {
            width: fit-content;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .status-badge i {
            font-size: 0.7rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(0.95); }
        }

        .status-activo {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: 2px solid rgba(16, 185, 129, 0.3);
        }

        .status-activo:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
        }

        .status-inactivo {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border: 2px solid rgba(239, 68, 68, 0.3);
        }

        .status-inactivo:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
        }

        /* Info Grid */
        .info-grid {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.7rem;
            min-height: 0;
            margin-bottom: 0.5rem;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 1rem;
            border-left: 4px solid #E4007C;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: fit-content;
            animation: slideInUp 0.6s ease-out;
            animation-fill-mode: both;
            opacity: 0;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .info-card:hover::before {
            transform: translateX(0);
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(228, 0, 124, 0.15);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 0.6rem;
        }

        .card-icon {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.1), rgba(123, 42, 141, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(228, 0, 124, 0.2);
            flex-shrink: 0;
        }

        .card-icon i {
            color: #E4007C;
            font-size: 1rem;
        }

        .card-label {
            font-size: 1rem;
            font-weight: 700;
            color: #7B2A8D;
            text-transform: none;
            letter-spacing: 0.3px;
        }

        .card-value {
            font-size: 1rem;
            font-weight: 500;
            color: #333;
            line-height: 1.3;
            word-wrap: break-word;
            word-break: break-word;
        }

        /* Special Cards */
        .salary-card .card-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #059669;
        }

        .phone-card .card-value {
            color: #059669;
            font-weight: 600;
        }

        .date-card .card-value {
            color: #0ea5e9;
            font-weight: 600;
        }

        /* Address Card */
        .address-card {
            grid-column: 1 / -1;
        }

        .address-value {
            background: rgba(248, 250, 252, 0.9);
            padding: 0.8rem;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            font-style: italic;
            line-height: 1.4;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            word-wrap: break-word;
            word-break: break-word;
            overflow: hidden;
            resize: none;
            width: 100%;
            min-height: 80px;
        }

        /* Alerts */
        .alert {
            border-radius: 15px;
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            margin: 1rem 0;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            animation: slideInUp 0.8s ease-out;
        }

        .alert i {
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.15), rgba(251, 191, 36, 0.05));
            color: #92400e;
            border-left: 4px solid #f59e0b;
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.2);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
            color: #991b1b;
            border-left: 4px solid #ef4444;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2);
        }

        /* Actions Section - Alineados a la izquierda */
        .actions-section {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
            justify-content: flex-start;
            padding: 0.8rem 0;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 0 0 15px 15px;
            margin: 0 -1rem -1rem -1rem;
            padding-left: 1rem;
            padding-right: 1rem;
            position: sticky;
            bottom: 0;
            z-index: 10;
            min-height: 60px;
            align-items: center;
        }

        .btn-beauty {
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            text-transform: none;
            letter-spacing: 0.3px;
            position: relative;
            overflow: hidden;
            min-width: 140px;
            justify-content: center;
            cursor: pointer;
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

        .btn-primary-beauty {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(228, 0, 124, 0.3);
        }

        .btn-primary-beauty:hover:not(.disabled):not(:disabled) {
            background: linear-gradient(135deg, #c3006a 0%, #6a267f 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228, 0, 124, 0.5);
            color: white;
        }

        .btn-primary-beauty.disabled,
        .btn-primary-beauty:disabled {
            background: linear-gradient(135deg, #cccccc 0%, #999999 100%);
            opacity: 0.6;
            pointer-events: none;
            color: white;
        }

        .btn-info-beauty {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
        }

        .btn-info-beauty:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.5);
            color: white;
        }

        .btn-warning-beauty {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
        }

        .btn-warning-beauty:hover {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.5);
            color: white;
        }

        .btn-secondary-beauty {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.3);
        }

        .btn-secondary-beauty:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(107, 114, 128, 0.5);
            color: white;
        }

        /* Animation delays */
        .info-card:nth-child(1) { animation-delay: 0.1s; }
        .info-card:nth-child(2) { animation-delay: 0.2s; }
        .info-card:nth-child(3) { animation-delay: 0.3s; }
        .info-card:nth-child(4) { animation-delay: 0.4s; }
        .info-card:nth-child(5) { animation-delay: 0.5s; }
        .info-card:nth-child(6) { animation-delay: 0.6s; }
        .info-card:nth-child(7) { animation-delay: 0.7s; }
        .info-card:nth-child(8) { animation-delay: 0.8s; }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                min-height: auto;
                padding: 0.8rem;
            }

            .beauty-header h2 {
                font-size: 1.6rem;
            }

            .beauty-header h2 i {
                font-size: 1.6rem;
            }

            .employee-info {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 1rem;
            }

            .employee-details {
                text-align: center;
            }

            .employee-name {
                font-size: 1.4rem;
                text-align: center !important;
            }

            .employee-meta {
                align-items: center;
            }

            .employee-position {
                justify-content: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
                margin-bottom: 0.8rem;
            }

            .actions-section {
                justify-content: center;
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
                margin: 0.5rem -0.8rem -0.8rem -0.8rem;
                padding-left: 0.8rem;
                padding-right: 0.8rem;
            }

            .btn-beauty {
                width: 100%;
                max-width: 280px;
            }
        }

        @media (max-width: 480px) {
            .beauty-header h2 {
                font-size: 1.4rem;
                flex-direction: column;
                gap: 5px;
            }

            .beauty-header h2 i {
                font-size: 1.4rem;
            }

            .card-header {
                flex-direction: column;
                text-align: center;
                gap: 0.4rem;
            }

            .employee-name {
                font-size: 1.2rem;
            }

            .btn-beauty {
                padding: 0.6rem 1.2rem;
                font-size: 0.8rem;
            }
        }

        /* Accessibility */
        .btn-beauty:focus {
            outline: 3px solid rgba(228, 0, 124, 0.5);
            outline-offset: 2px;
        }

        .info-card:focus-within {
            outline: 2px solid rgba(228, 0, 124, 0.5);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="beauty-header">
        <h2>
            <i class="fas fa-user-tie"></i>
            Perfil del empleado
        </h2>
    </div>

    <!-- Profile Content -->
    <div class="profile-content">
        <!-- Employee Header -->
        <div class="employee-header">
            <div class="employee-info">
                <div class="employee-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="employee-details">
                    <div class="employee-name" id="employeeName">{{ $empleado->nombre_empleado }}</div>
                    <div class="employee-meta">
                        <div class="employee-position">
                            <i class="fas fa-briefcase"></i>
                            {{ $empleado->cargo }}
                        </div>
                        <div class="employee-status">
                            <span class="status-badge status-{{ $empleado->estado }}">
                                <i class="fas fa-circle"></i>
                                {{ ucfirst($empleado->estado) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <!-- Número de Identidad -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="card-label">Número de identidad</div>
                </div>
                <div class="card-value">{{ $empleado->numero_identidad }}</div>
            </div>

            <!-- Teléfono -->
            <div class="info-card phone-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="card-label">Teléfono</div>
                </div>
                <div class="card-value">{{ $empleado->telefono }}</div>
            </div>

            <!-- Fecha de Ingreso -->
            <div class="info-card date-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="card-label">Fecha de ingreso</div>
                </div>
                <div class="card-value">{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</div>
            </div>

            <!-- Salario -->
            <div class="info-card salary-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-label">Salario</div>
                </div>
                <div class="card-value">L. {{ number_format($empleado->salario, 2) }}</div>
            </div>

            <!-- Contacto de Emergencia -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="card-label">Contacto de emergencia</div>
                </div>
                <div class="card-value">{{ $empleado->contacto_emergencia_nombre }}</div>
            </div>

            <!-- Teléfono de Emergencia -->
            <div class="info-card phone-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="card-label">Teléfono de emergencia</div>
                </div>
                <div class="card-value">{{ $empleado->contacto_emergencia }}</div>
            </div>

            <!-- Dirección -->
            <div class="info-card address-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="card-label">Dirección</div>
                </div>
                <textarea readonly class="address-value">{{ $empleado->direccion }}</textarea>
            </div>
        </div>

        <!-- Alerts -->
        @if($empleado->llamados->count() >= 3 && $empleado->estado === 'activo')
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>⚠ Atención:</strong> Este empleado ha acumulado <strong>3 o más llamados de atención</strong>. Se recomienda tomar medidas disciplinarias.
                </div>
            </div>
        @endif

        @if($empleado->llamados->count() >= 3 && $empleado->estado === 'inactivo')
            <div class="alert alert-danger">
                <i class="fas fa-ban"></i>
                <div>
                    <strong>Empleado deshabilitado.</strong> Este colaborador fue desactivado por haber acumulado 3 o más llamados de atención.
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="actions-section">
            <a href="{{ route('llamados.create', ['empleado_id' => $empleado->id]) }}"
               class="btn-beauty btn-primary-beauty {{ $empleado->estado !== 'activo' || $empleado->llamados->count() >= 3 ? 'disabled' : '' }}">
                <i class="fas fa-exclamation-triangle"></i>
                Registrar llamado
            </a>

            <a href="{{ route('llamados.historial', $empleado->id) }}" class="btn-beauty btn-info-beauty">
                <i class="fas fa-history"></i>
                Ver llamados
            </a>

            @if($empleado->estado === 'activo')
                <form method="POST" action="{{ route('empleados.deshabilitar', $empleado->id) }}" style="margin:0; display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-beauty btn-warning-beauty"
                            onclick="return confirm('¿Está seguro de desactivar este empleado?')">
                        <i class="fas fa-user-slash"></i>
                        Deshabilitar
                    </button>
                </form>
            @endif

            <a href="{{ route('empleados.index') }}" class="btn-beauty btn-secondary-beauty">
                <i class="fas fa-arrow-left"></i>
                Volver al listado
            </a>
        </div>
    </div>
</div>

<script>
    // Función para centrar nombres cortos
    function checkNameLength() {
        const nameElement = document.getElementById('employeeName');
        const name = nameElement.textContent.trim();

        if (name.length <= 20) {
            nameElement.classList.add('short-name');
        } else {
            nameElement.classList.remove('short-name');
        }
    }

    // Ejecutar al cargar la página
    document.addEventListener('DOMContentLoaded', checkNameLength);
    document.querySelectorAll('.btn-beauty').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.classList.contains('disabled')) {
                e.preventDefault();
                return;
            }

            this.style.opacity = '0.8';
            setTimeout(() => this.style.opacity = '1', 200);
        });
    });

    // Add hover effects to cards
    document.querySelectorAll('.info-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.01)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            console.log('Volver al listado');
        }
    });

    // Simulate dynamic content loading
    setTimeout(() => {
        document.querySelectorAll('.info-card').forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
            }, index * 100);
        });
    }, 100);




</script>
</body>
</html>