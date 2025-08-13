<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Servicios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        .table tbody tr.inactivo {
            background-color: rgba(248, 249, 250, 0.8);
            opacity: 0.7;
        }

        .table tbody tr.inactivo td {
            color: #6c757d;
        }

        .badge-suspendido {
            background: rgba(255, 193, 7, 0.2); /* Ámbar suave */
            color: #856404; /* Marrón oscuro elegante */
            padding: 0.25em 0.2em; /* Badge más pequeño */
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem; /* Letra más pequeña y proporcional */
            border: 1px solid rgba(255, 193, 7, 0.5); /* Borde sutil */
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


        .btn-secondary-beauty {
            background: linear-gradient(135deg, #9017b8 0%, #521396 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(23, 162, 184, 0.4);
            color: white;
        }

        .btn-warning-beauty {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            color: #212529;
        }

        .btn-warning-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            color: #212529;
        }


        .acciones-btns {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: nowrap; /* ← Evita que se coloquen uno debajo del otro */
        }


        .pagination-container {
            display: flex;
            flex-direction: column; /* Poner en columna (texto arriba, paginación abajo) */
            align-items: center;    /* Centrar horizontalmente */
            gap: 0.25rem;           /* Espacio pequeño entre texto y paginación */
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
        /* Ocultar específicamente elementos con role="status" */
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
    <div class="beauty-header">
        <h2><i class="fas fa-concierge-bell"></i> Listado de servicios</h2>
    </div>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> Felicidades:</strong> {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> ¡Éxito!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="text-end mb-4">
        <a href="{{ route('servicios.create') }}" class="btn btn-beauty btn-primary-beauty">
            <i class="fas fa-plus-circle"></i> Crear un servicio
        </a>
    </div>

    <div class="filters-container">
        <div class="row align-items-end">
            <div class="col-md-4 mb-3 mb-md-0">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-search"></i> Buscar por nombre
                </label>
                <input type="text" id="buscar" class="form-control" placeholder="Buscar por nombre o código " autocomplete="off">
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-layer-group"></i> Filtrar por categoría
                </label>
                <select id="categoria" class="form-select">
                    <option value="">Todas las categorías</option>
                    <option value="basico">Básico</option>
                    <option value="intermedio">Intermedio</option>
                    <option value="avanzado">Avanzado</option>
                </select>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-filter"></i> Filtrar por estado
                </label>
                <select id="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="temporalmente_suspendido">Suspendido temporalmente</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-container">
        <div id="tabla-container">
            @include('servicios.partials.tabla')
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // Búsqueda completa con retraso
    let searchTimeout;
    $('#buscar').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => filtrarServicios(1), 300);
    });

    $('#categoria, #estado').on('change', () => filtrarServicios(1));

    function filtrarServicios(page = 1) {
        const buscar = $('#buscar').val();
        const categoria = $('#categoria').val();
        const estado = $('#estado').val();

        $.ajax({
            url: "{{ route('servicios.buscar') }}?page=" + page,
            type: 'GET',
            data: { buscar, categoria, estado },
            success: function(data) {
                $('#tabla-container').html(data.tabla);

                const totalFiltrados = data.totalFiltrado;
                const totalGeneral = data.totalGeneral;  // <--- Agrega esta línea

                const estaFiltrando = buscar !== '' || categoria !== '' || estado !== '';

                const filaMensaje = $('#fila-mensaje');
                const celdaMensaje = filaMensaje.find('td');

                if (estaFiltrando) {
                    filaMensaje.show();
                    $('#paginacion').hide();
                    $('div[role="status"], .pagination-info').hide();

                    if (totalFiltrados > 0) {
                        celdaMensaje.html(`
                <div class="alert alert-info text-center mb-0 p-2 rounded-pill" role="alert" style="background: linear-gradient(135deg, #ffeef8, #f3e6f9); color: #7B2A8D;">
                    <i class="fas fa-info-circle"></i> ${totalFiltrados} resultado${totalFiltrados > 1 ? 's' : ''} de ${totalGeneral} registrado${totalGeneral > 1 ? 's' : ''}.
                </div>
            `);
                    } else {
                        celdaMensaje.html(`
                <div class="alert alert-warning text-center mb-0 p-2 rounded-pill" role="alert" style="background: linear-gradient(135deg, #fff3cd, #fae9b5); color: #856404;">
                    <i class="fas fa-exclamation-circle"></i> No se encontraron servicios.

                </div>
            `);
                    }

                } else {
                    filaMensaje.hide();
                    celdaMensaje.text('');
                    $('#paginacion').show();
                    $('div[role="status"], .pagination-info').show();
                }

                ocultarTextoInglesPaginacion();
            },

            error: function() {
                alert('Error al filtrar los servicios');
            }
        });
    }

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const url = new URL($(this).attr('href'), window.location.origin);
        const page = url.searchParams.get('page');
        filtrarServicios(page);
    });

    function ocultarTextoInglesPaginacion() {
        document.querySelectorAll('div[role="status"]').forEach(div => {
            if (/Showing \d+ to \d+ of \d+ results/.test(div.textContent)) {
                div.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        ocultarTextoInglesPaginacion();
        filtrarServicios(1);
    });

    $(document).on('click', '.pagination a', function() {
        setTimeout(ocultarTextoInglesPaginacion, 100);
    });

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>