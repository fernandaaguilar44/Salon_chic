<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Empleados</title>
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
        .btn-editar {
            background: linear-gradient(135deg, #7B2A8D, #FF69B4);
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-editar:hover {
            background: linear-gradient(135deg, #6a217f, #f955a9);
            box-shadow: 0 8px 20px rgba(123, 42, 141, 0.3);
            transform: translateY(-2px);
        }

        .btn-ver {
            background: linear-gradient(135deg, #7B2A8D, #FF69B4);
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-ver:hover {
            background: linear-gradient(135deg, #6a217f, #f955a9);
            box-shadow: 0 8px 20px rgba(255, 105, 180, 0.3);
            transform: translateY(-2px);
        }

        .btn-ver:hover {
            background: linear-gradient(135deg, #9963d0, #653bb7);
            box-shadow: 0 8px 20px rgba(138, 82, 204, 0.4);
            transform: translateY(-2px);
        }


        /* Filtros mejorados */
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

        /* Estilo para el contador de resultados */
        .results-counter {
            font-size: 0.75rem;
            color: #28a745;
            margin-top: 0.25rem;
            font-weight: 500;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .results-counter.show {
            opacity: 1;
        }

        /* Tabla mejorada */
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
            position: relative;
        }

        .table thead th:first-child {
            border-top-left-radius: 0;
        }

        .table thead th:last-child {
            border-top-right-radius: 0;
        }

        .table tbody td {
            padding: 0.875rem 0.75rem;
            vertical-align: middle;
            border-color: rgba(228, 0, 124, 0.1);
            font-size: 0.9rem;
            text-align: center;
        }

        .table tbody tr {
            transition: all 0.3s ease;
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

        /* Botones mejorados */
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
            gap: 0.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .acciones-btns a {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        /* Paginación mejorada y centrada */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
        }

        .pagination {
            margin: 0;
            gap: 4px;
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

        /* Alertas mejoradas */
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

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                margin: 0 0.5rem;
                padding: 1.5rem;
            }

            .filters-container {
                padding: 1rem;
            }

            .beauty-header h2 {
                font-size: 1.5rem;
            }

            .table-responsive {
                border-radius: 15px;
            }

            .acciones-btns {
                flex-direction: column;
                gap: 0.25rem;
            }

            .acciones-btns a {
                width: 100%;
                justify-content: center;
            }

            .pagination {
                flex-wrap: wrap;
                gap: 2px;
            }

            .pagination .page-link {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h2 {
                font-size: 1.3rem;
            }

            .filters-container .row > div {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-users"></i> Listado de empleados</h2>
    </div>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> Felicidades:</strong> {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="filters-container">
        <div class="row align-items-end">
            <div class="col-md-4 mb-3 mb-md-0">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-search"></i> Buscar empleado
                </label>
                <input type="text" id="buscar" class="form-control" placeholder="Buscar por nombre o cargo...">
                <div id="results-counter" class="results-counter"></div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-filter"></i> Filtrar por estado
                </label>
                <select id="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="activo">Empleados activos</option>
                    <option value="inactivo">Empleados inactivos</option>
                </select>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('empleados.create') }}" class="btn btn-beauty btn-primary-beauty">
                    <i class="fas fa-user-plus"></i> Registrar un nuevo empleado
                </a>
            </div>
        </div>
    </div>

    <div class="table-container">
        <div id="tabla-empleados">
            @include('empleados.partials.tabla')
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function buscarEmpleados() {
        let buscar = $('#buscar').val();
        let estado = $('#estado').val();

        $.ajax({
            url: '{{ route('empleados.buscar') }}',
            type: 'GET',
            data: { buscar: buscar, estado: estado },
            success: function(data) {
                $('#tabla-empleados').html(data);

                // Actualizar contador de resultados después de cargar datos del servidor
                updateResultsCounter();
            }
        });
    }

    function updateResultsCounter() {
        // Contar las filas de empleados visibles (excluyendo el header)
        let totalRows = $('#tabla-empleados table tbody tr').length;
        let counterElement = $('#results-counter');

        if (totalRows > 0) {
            let text = totalRows === 1 ? 'resultado encontrado' : 'resultados encontrados';
            counterElement.text(`${totalRows} ${text}`).addClass('show');
        } else {
            counterElement.text('No se encontraron resultados').addClass('show');
        }
    }

    function updateInstantCounter() {
        let buscar = $('#buscar').val().toLowerCase();
        let estado = $('#estado').val();
        let counterElement = $('#results-counter');

        if (buscar === '') {
            // Si no hay texto de búsqueda, ocultar contador
            counterElement.removeClass('show').text('');
            return;
        }

        // Contar filas que coinciden con la búsqueda actual
        let visibleRows = 0;
        $('#tabla-empleados table tbody tr').each(function() {
            let row = $(this);
            let nombre = row.find('td:nth-child(2)').text().toLowerCase(); // Columna nombre
            let cargo = row.find('td:nth-child(3)').text().toLowerCase();  // Columna cargo
            let estadoEmpleado = row.hasClass('inactivo') ? 'inactivo' : 'activo';

            let matchesSearch = buscar === '' || nombre.includes(buscar) || cargo.includes(buscar);
            let matchesStatus = estado === '' || estado === estadoEmpleado;

            if (matchesSearch && matchesStatus) {
                visibleRows++;
            }
        });

        if (visibleRows > 0) {
            let text = visibleRows === 1 ? 'resultado encontrado' : 'resultados encontrados';
            counterElement.text(`${visibleRows} ${text}`).addClass('show');
        } else {
            counterElement.text('No se encontraron resultados').addClass('show');
        }
    }

    // Inicializar contador al cargar la página (vacío inicialmente)
    $(document).ready(function() {
        $('#results-counter').removeClass('show').text('');
    });

    // Actualizar contador en tiempo real mientras escribes
    $('#buscar').on('input keyup', function() {
        updateInstantCounter();
    });

    // Actualizar contador cuando cambias el filtro de estado
    $('#estado').on('change', function() {
        updateInstantCounter();
    });

    // Hacer búsqueda completa con un pequeño retraso para mejor UX
    let searchTimeout;
    $('#buscar').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(buscarEmpleados, 500); // Espera 500ms después de dejar de escribir
    });

    $('#estado').on('change', buscarEmpleados);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>