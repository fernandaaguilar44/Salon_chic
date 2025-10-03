<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Promociones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Estilos y fuentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 1rem 0;
            overflow-x: hidden;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            color: black;
            max-width: 1200px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 1rem;
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
            margin-bottom: 2rem;
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
            width: 120px;
            height: 3px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 15px auto;
            border-radius: 2px;
        }

        .btn-editar, .btn-ver {
            background: linear-gradient(135deg, #7B2A8D, #FF69B4);
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .btn-editar:hover, .btn-ver:hover {
            background: linear-gradient(135deg, #6a217f, #f955a9);
            box-shadow: 0 4px 15px rgba(123, 42, 141, 0.3);
            transform: translateY(-1px);
        }

        .filters-container {
            background: rgba(123, 42, 141, 0.05);
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
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

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus, .form-select:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
        }

        .table-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(123, 42, 141, 0.1);
            margin-bottom: 1rem;
        }

        .table {
            margin-bottom: 0;
            background: white;
        }

        .table thead th {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
            border: none;
            padding: 1rem 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            text-align: center;
        }

        .table tbody td {
            padding: 0.875rem 0.75rem;
            vertical-align: middle;
            border-color: rgba(228, 0, 124, 0.1);
            font-size: 0.9rem;
            text-align: center;
        }

        .table tbody tr:hover {
            background-color: rgba(228, 0, 124, 0.05);
            transform: scale(1.01);
        }

        .badge-activo {
            background: rgba(40, 167, 69, 0.2);
            color: #155724;
            padding: 0.35em 0.65em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid rgba(40, 167, 69, 0.5);
        }

        .badge-inactivo {
            background: rgba(220, 53, 69, 0.2);
            color: #721c24;
            padding: 0.35em 0.65em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid rgba(220, 53, 69, 0.5);
        }

        .badge-porcentaje {
            background: rgba(0, 123, 255, 0.2);
            color: #004085;
            padding: 0.35em 0.65em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid rgba(0, 123, 255, 0.5);
        }

        .badge-monto-fijo {
            background: rgba(255, 193, 7, 0.2);
            color: #856404;
            padding: 0.35em 0.65em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid rgba(255, 193, 7, 0.5);
        }

        .badge-combo {
            background: rgba(108, 117, 125, 0.2);
            color: #495057;
            padding: 0.35em 0.65em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid rgba(108, 117, 125, 0.5);
        }

        .badge-productos {
            background: rgba(23, 162, 184, 0.2);
            color: #0c5460;
            padding: 0.35em 0.65em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid rgba(23, 162, 184, 0.5);
        }

        .badge-servicios {
            background: rgba(40, 167, 69, 0.2);
            color: #155724;
            padding: 0.35em 0.65em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid rgba(40, 167, 69, 0.5);
        }

        .btn-beauty {
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
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

        .btn-reset-beauty {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-reset-beauty:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
            color: white;
        }

        .acciones-btns {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: nowrap;
        }

        .pagination-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
        }

        .pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin: 0;
        }

        .pagination .page-item .page-link {
            color: #7B2A8D;
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(228, 0, 124, 0.2);
            border-radius: 10px;
            padding: 0.5rem 0.75rem;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(123, 42, 141, 0.1);
            text-decoration: none;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            color: white;
            border-color: #E4007C;
            box-shadow: 0 4px 12px rgba(228, 0, 124, 0.3);
            transform: scale(1.1);
        }

        .pagination .page-link:hover {
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.1), rgba(123, 42, 141, 0.1));
            color: #E4007C;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(228, 0, 124, 0.2);
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.15);
            animation: slideInDown 0.5s ease-out;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(25, 135, 84, 0.05));
            border-left: 4px solid #28a745;
        }

        /* Estilos para el rango de fechas */
        .date-range-single-container {
            position: relative;
        }

        .date-range-single-container .form-control {
            background: rgba(255, 255, 255, 0.95);
            cursor: pointer;
            padding-right: 2.5rem;
        }

        .date-range-single-container .form-control:hover {
            background: white;
            border-color: #E4007C;
        }

        .date-range-single-container::after {
            content: '\f073';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #7B2A8D;
            pointer-events: none;
        }

        .form-text {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            color: #6c757d !important;
            margin-top: 0.3rem;
        }

        .form-text i {
            color: #E4007C;
        }

        /* Modal personalizado para el selector de rango */
        .date-range-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            backdrop-filter: blur(3px);
        }

        .date-range-content {
            background: white;
            padding: 1.8rem;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(123, 42, 141, 0.3);
            max-width: 420px;
            width: 90%;
            position: relative;
            transform: scale(0.9);
            transition: all 0.3s ease;
            margin: auto;
            border: 2px solid rgba(228, 0, 124, 0.1);
        }

        .date-range-modal.show .date-range-content {
            transform: scale(1);
        }

        .date-range-header {
            text-align: center;
            margin-bottom: 1rem;
            color: #7B2A8D;
            font-weight: 600;
        }

        .date-range-inputs {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .date-range-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .btn-apply-range {
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-clear-range {
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-cancel-range {
            background: transparent;
            color: #6c757d;
            border: 1px solid #6c757d;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Ocultar elementos automáticos de paginación */
        div[role="status"] {
            display: none !important;
        }

        /* Ocultar divs automáticos de Laravel que no sean nuestra paginación personalizada */
        .pagination-container > div:not(.pagination):not(.pagination-info):not(nav) {
            display: none !important;
        }

        /* Ocultar párrafos y spans automáticos que no sean de nuestra paginación */
        .pagination-container p:not(.pagination-info),
        .pagination-container span:not(.page-link):not(.badge):not(.pagination-info *) {
            display: none !important;
        }

        /* Específicamente para elementos que contengan "Showing" */
        .pagination-container [class*="showing"],
        .pagination-container [class*="results"],
        .pagination-container [id*="showing"],
        .pagination-container [id*="results"] {
            display: none !important;
        }

        /* Ocultar texto que aparezca fuera de los elementos de paginación */
        .pagination-container > *:not(.pagination):not(.pagination-info):not(nav) {
            display: none !important;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .acciones-btns {
                display: flex;
                gap: 0.4rem;
                justify-content: center;
                align-items: center;
                flex-wrap: nowrap;
            }

            .acciones-btns a {
                padding: 0.4rem 1rem;
                font-size: 0.8rem;
                border-radius: 15px;
                font-weight: 600;
                white-space: nowrap;
            }

            .date-range-single-container {
                margin-bottom: 0.5rem;
            }

            .form-text {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h2 {
                font-size: 1.3rem;
            }

            .filters-container .row > div {
                margin-bottom: 1rem;
            }

            .pagination-container + div[role="status"] {
                display: none !important;
            }

            div[role="status"] {
                display: none !important;
            }
        }

        .text-fecha {
            color: #7B2A8D !important;
            font-weight: 600;
        }

        .valor-badge {
            background: rgba(228, 0, 124, 0.1);
            color: #7B2A8D;
            padding: 0.25em 0.5em;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* Alineación perfecta de filtros */
        .filters-container .form-control,
        .filters-container .form-select {
            height: 38px;
            padding: 0.375rem 0.75rem;
        }

        .filters-container .form-label {
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            height: 1.2rem; /* Altura fija para labels */
            display: block;
        }

        /* Botón reset alineado */
        .btn-reset-beauty {
            height: 38px;
            min-height: 38px;
            width: 38px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Contenedor de fecha y botón */
        .filters-container .d-flex.gap-2 {
            height: 38px;
        }

        .filters-container .flex-grow-1 {
            display: flex;
            flex-direction: column;
        }

        .filters-container .date-range-single-container {
            flex-grow: 1;
        }

        /* Mejorar espaciado responsive */
        @media (max-width: 992px) {
            .filters-container .col-lg-4 .d-flex {
                flex-direction: column;
                gap: 0.5rem;
                height: auto;
            }

            .btn-reset-beauty {
                width: 100%;
                height: 38px;
            }
        }

        @media (max-width: 768px) {
            .filters-container .d-flex.gap-2 {
                flex-direction: column;
                align-items: stretch;
                height: auto;
            }

            .btn-reset-beauty {
                width: 100%;
                margin-top: 0.5rem;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-tags"></i> Listado de promociones</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> ¡Éxito!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <!-- Botón de acción principal -->
    <div class="row mb-3">
        <div class="col-12 text-end">
            <a href="{{ route('promociones.create') }}" class="btn btn-beauty btn-primary-beauty">
                <i class="fas fa-plus"></i> Crear nueva promoción
            </a>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filters-container">
        <div class="row g-3 align-items-end">
            <!-- Búsqueda por nombre - 3 columnas -->
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-search"></i> Buscar por nombre
                </label>
                <input type="text" id="buscar" class="form-control" placeholder="Buscar promoción por nombre" autocomplete="off">
            </div>

            <!-- Tipo - 2 columnas -->
            <div class="col-lg-2 col-md-6">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-tag"></i> Tipo
                </label>
                <select id="tipo" class="form-select">
                    <option value="">Todos</option>
                    <option value="porcentaje">Porcentaje</option>
                    <option value="monto_fijo">Monto fijo</option>
                    <option value="combo">Combo</option>
                </select>
            </div>

            <!-- Aplica a - 2 columnas -->
            <div class="col-lg-2 col-md-6">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-bullseye"></i> Aplica a
                </label>
                <select id="aplica_a" class="form-select">
                    <option value="">Todos</option>
                    <option value="productos">Productos</option>
                    <option value="servicios">Servicios</option>
                </select>
            </div>

            <!-- Estado - 1 columna -->
            <div class="col-lg-1 col-md-6">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-toggle-on"></i> Estado
                </label>
                <select id="estado" class="form-select">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

            <!-- Rango de fechas - 3 columnas -->
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-calendar-week"></i> Vigencia
                </label>
                <div class="date-range-single-container">
                    <input type="text" id="rango_fechas" class="form-control" placeholder="Rango de vigencia..." readonly>
                    <input type="hidden" id="fecha_desde">
                    <input type="hidden" id="fecha_hasta">
                </div>
            </div>

            <!-- Botón Reset - 1 columna -->
            <div class="col-lg-1 col-md-6">
                <button type="button" id="btn-reset-filtros" class="btn btn-reset-beauty w-100" title="Limpiar filtros">
                    <i class="fas fa-undo"></i>
                </button>
            </div>
        </div>

        <!-- Texto de ayuda FUERA del row principal -->
        <div class="row mt-2">
            <div class="col-lg-3 offset-lg-8">
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle"></i> Filtra por fecha de inicio y expiración
                </small>
            </div>
        </div>
    </div>



    <!-- Tabla -->
    <div class="table-container">
        <div id="tabla-container">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Vigencia</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <!-- Fila para mensajes de filtros -->
                <tr id="fila-mensaje" style="display: none;">
                    <td colspan="7" class="text-center p-2"></td>
                </tr>

                @forelse($promociones as $promocion)
                    <tr>
                        <td>
                            <strong>{{ $promocion->nombre }}</strong>
                        </td>
                        <td>
                            <span class="badge-{{ $promocion->tipo }}">
                                @if($promocion->tipo == 'porcentaje')
                                    <i class="fas fa-percentage"></i> Porcentaje
                                @elseif($promocion->tipo == 'monto_fijo')
                                    <i class="fas fa-dollar-sign"></i> Monto fijo
                                @else
                                    <i class="fas fa-gift"></i> Combo
                                @endif
                            </span>
                        </td>
                        <td>
                        <td>
                            @if($promocion->tipo == 'porcentaje')
                                {{ $promocion->valor }}%
                            @else
                                L. {{ number_format($promocion->valor, 0, '.', ',') }}
                            @endif
                        </td>
                        </td>
                        <td>
                            <div class="text-fecha">
                                {{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }}
                            </div>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($promocion->fecha_expiracion)->format('d/m/Y') }}
                            </small>
                        </td>
                        <td>
                            <span class="badge-{{ $promocion->estado }}">
                                @if($promocion->estado == 'activo')
                                    <i class="fas fa-check-circle"></i> Activo
                                @else
                                    <i class="fas fa-times-circle"></i> Inactivo
                                @endif
                            </span>
                        </td>
                        <td>
                            <div class="acciones-btns">
                                <a href="{{ route('promociones.show', $promocion) }}" class="btn btn-ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-percentage fa-2x mb-2"></i>
                            <p>No hay promociones registradas</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Paginación -->
            @if($promociones->hasPages())
                <div class="pagination-container" id="paginacion">
                    {{ $promociones->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para seleccionar rango de fechas -->
<div class="date-range-modal" id="dateRangeModal">
    <div class="date-range-content">
        <div class="date-range-header">
            <i class="fas fa-calendar-week"></i> Seleccionar Rango de Fechas
        </div>
        <div class="date-range-inputs">
            <div>
                <label class="form-label">Fecha desde:</label>
                <input type="date" id="modal_fecha_desde" class="form-control">
            </div>
            <div>
                <label class="form-label">Fecha hasta:</label>
                <input type="date" id="modal_fecha_hasta" class="form-control">
            </div>
        </div>
        <div class="date-range-buttons">
            <button type="button" class="btn-cancel-range" onclick="cerrarModal()">
                <i class="fas fa-times"></i> Cancelar
            </button>
            <button type="button" class="btn-clear-range" onclick="limpiarRango()">
                <i class="fas fa-eraser"></i> Limpiar
            </button>
            <button type="button" class="btn-apply-range" onclick="aplicarRango()">
                <i class="fas fa-check"></i> Aplicar
            </button>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let searchTimeout;

    $('#buscar').on('input', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => filtrarPromociones(1), 300);
    });

    $('#tipo, #aplica_a, #estado').on('change', () => filtrarPromociones(1));

    // Evento para abrir modal de rango de fechas
    $('#rango_fechas').on('click', function() {
        $('#dateRangeModal').fadeIn(300);
    });

    // Cerrar modal al hacer clic fuera
    $('#dateRangeModal').on('click', function(e) {
        if (e.target === this) {
            cerrarModal();
        }
    });

    // Funciones para el modal de rango de fechas
    function cerrarModal() {
        $('#dateRangeModal').fadeOut(300);
    }

    function aplicarRango() {
        const fechaDesde = $('#modal_fecha_desde').val();
        const fechaHasta = $('#modal_fecha_hasta').val();

        $('#fecha_desde').val(fechaDesde);
        $('#fecha_hasta').val(fechaHasta);

        // Actualizar el texto del input principal
        let textoRango = '';
        if (fechaDesde && fechaHasta) {
            textoRango = `${fechaDesde} a ${fechaHasta}`;
        } else if (fechaDesde) {
            textoRango = `Desde ${fechaDesde}`;
        } else if (fechaHasta) {
            textoRango = `Hasta ${fechaHasta}`;
        } else {
            textoRango = '';
        }

        $('#rango_fechas').val(textoRango);
        cerrarModal();
        filtrarPromociones(1);
    }

    function limpiarRango() {
        $('#modal_fecha_desde').val('');
        $('#modal_fecha_hasta').val('');
        $('#fecha_desde').val('');
        $('#fecha_hasta').val('');
        $('#rango_fechas').val('');
        cerrarModal();
        filtrarPromociones(1);
    }

    // Botón para restablecer filtros
    $('#btn-reset-filtros').on('click', function() {
        $('#buscar').val('');
        $('#tipo').val('');
        $('#aplica_a').val('');
        $('#estado').val('');
        $('#fecha_desde').val('');
        $('#fecha_hasta').val('');
        $('#rango_fechas').val('');
        filtrarPromociones(1);
    });

    function filtrarPromociones(page = 1) {
        const buscar = $('#buscar').val();
        const tipo = $('#tipo').val();
        const aplica_a = $('#aplica_a').val();
        const estado = $('#estado').val();
        const fecha_desde = $('#fecha_desde').val();
        const fecha_hasta = $('#fecha_hasta').val();

        // NOTA: Necesitarás crear esta ruta en tu web.php
        // Route::get('/promociones/buscar', [PromocionController::class, 'buscar'])->name('promociones.buscar');

        $.ajax({
            url: "/promociones/buscar?page=" + page,
            type: 'GET',
            data: { buscar, tipo, aplica_a, estado, fecha_desde, fecha_hasta },
            success: function (data) {
                $('#tabla-container').html(data.tabla);

                const totalFiltrados = data.totalFiltrado;
                const totalGeneral = data.totalGeneral;
                const estaFiltrando = buscar !== '' || tipo !== '' || aplica_a !== '' || estado !== '' || fecha_desde !== '' || fecha_hasta !== '';
                const itemsPorPagina = 8; // Ajusta según backend

                const filaMensaje = $('#fila-mensaje');
                const celdaMensaje = filaMensaje.find('td');

                if (estaFiltrando) {
                    filaMensaje.show();

                    if (totalFiltrados > 0) {
                        let rangoTexto = '';
                        if (fecha_desde && fecha_hasta) {
                            rangoTexto = ` (vigentes del ${fecha_desde} al ${fecha_hasta})`;
                        } else if (fecha_desde) {
                            rangoTexto = ` (vigentes desde ${fecha_desde})`;
                        } else if (fecha_hasta) {
                            rangoTexto = ` (vigentes hasta ${fecha_hasta})`;
                        }

                        celdaMensaje.html(`
                <div class="alert alert-info text-center mb-0 p-2 rounded-pill" role="alert" style="background: linear-gradient(135deg, #ffeef8, #f3e6f9); color: #7B2A8D;">
                    <i class="fas fa-info-circle"></i> ${totalFiltrados} promoción${totalFiltrados > 1 ? 'es' : ''} de ${totalGeneral} total${totalGeneral > 1 ? 'es' : ''}${rangoTexto}.
                </div>
            `);

                        if (totalFiltrados > itemsPorPagina) {
                            $('#paginacion').show();
                            $('div[role="status"], .pagination-info').show();
                        } else {
                            $('#paginacion').hide();
                            $('div[role="status"], .pagination-info').hide();
                        }
                    } else {
                        celdaMensaje.html(`
                <div class="alert alert-warning text-center mb-0 p-2 rounded-pill" role="alert" style="background: linear-gradient(135deg, #fff3cd, #fae9b5); color: #856404;">
                    <i class="fas fa-exclamation-circle"></i> No se encontraron promociones con los filtros aplicados.
                </div>
            `);
                        $('#paginacion').hide();
                        $('div[role="status"], .pagination-info').hide();
                    }

                } else {
                    filaMensaje.hide();
                    celdaMensaje.text('');
                    $('#paginacion').show();
                    $('div[role="status"], .pagination-info').show();
                }

                ocultarTextoInglesPaginacion();
            },

            error: function () {
                alert('Error al filtrar las promociones');
            }
        });
    }

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = new URL($(this).attr('href'), window.location.origin);
        const page = url.searchParams.get('page');
        filtrarPromociones(page);
    });

    function ocultarTextoInglesPaginacion() {
        document.querySelectorAll('div[role="status"]').forEach(div => {
            if (/Showing \d+ to \d+ of \d+ results/.test(div.textContent)) {
                div.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        ocultarTextoInglesPaginacion();
        filtrarPromociones(1);
    });

    $(document).on('click', '.pagination a', function () {
        setTimeout(ocultarTextoInglesPaginacion, 100);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>