<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        /* Estilos CSS (se mantienen los mismos que el original para la estética) */
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

        .header-actions {
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

        .form-label {
            font-weight: 600;
            color: #7B2A8D;
            margin-bottom: 0.5rem;
        }

        .table-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(123, 42, 141, 0.1);
            margin-bottom: 1rem;
        }

        .table {
            table-layout: fixed;
            width: 100%;
            word-wrap: break-word;
        }

        .table-responsive {
            overflow-x: visible !important;
        }

        .table td, .table th {
            word-break: break-word;
            white-space: normal !important;
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
            background: linear-gradient(135deg, #7b2a8d 0%, #ff69b4 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgb(123, 42, 141);
            color: white;
        }

        .btn-danger-beauty {
            background: linear-gradient(135deg, #dc3545 0%, #a42a3a 100%);
            color: white;
        }

        .btn-danger-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
            color: white;
        }

        .btn-beauty.active {
            background: #E4007C;
            box-shadow: 0 0 10px rgba(228, 0, 124, 0.5);
            transform: scale(1.01);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            border-radius: 8px;
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

        #mensajeResultados {
            background: rgba(123, 42, 141, 0.05);
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 15px;
            padding: 1rem;
            margin-top: 1rem;
            font-weight: 600;
            color: #7B2A8D;
            text-align: center;
            animation: slideInUp 0.5s ease-out;
        }

        @media (max-width: 768px) {
            .container {
                margin: 0 0.5rem;
                padding: 1.5rem;
            }

            .header-actions {
                padding: 1rem;
            }

            .beauty-header h2 {
                font-size: 1.5rem;
            }

            .table-responsive {
                border-radius: 15px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }

            .action-buttons .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h2 {
                font-size: 1.3rem;
            }

            .header-actions .row > div {
                margin-bottom: 1rem;
            }

            .table th, .table td {
                font-size: 0.75rem;
                padding: 0.4rem 0.2rem;
            }

            .btn {
                font-size: 0.7rem;
                padding: 0.2rem 0.4rem;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>


<div class="container py-5">
    <div class="beauty-header">
        <!-- Título cambiado a "Listado de Facturas de Venta" -->
        <h2><i class="fas fa-file-invoice"></i> Listado de Facturas de Venta</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> Éxito:</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <!-- Ruta cambiada a 'ventas.create' -->
        <a href="{{ route('facturaventa.create') }}" class="btn btn-beauty btn-primary-beauty">
            <i class="fas fa-plus"></i> Nueva Venta
        </a>
    </div>

    <div class="header-actions">
        <!-- Formulario apuntando a la ruta 'ventas.index' -->
        <form id="filtroVentas" method="GET" action="{{ route('facturaventa.index') }}" class="row g-3 align-items-end">
            <div class="col-md-5">
                <!-- Campo de filtro cambiado a "Cliente" -->
                <label for="cliente" class="form-label">
                    <i class="fas fa-user-tag"></i> Cliente
                </label>
                <input type="text" id="cliente" name="cliente" class="form-control"
                       placeholder="Nombre cliente..." value="{{ request('cliente') }}">
            </div>

            <div class="col-md-5">
                <label for="fecha_rango" class="form-label">
                    <i class="fas fa-calendar-alt"></i> Rango de Fechas
                </label>
                <input type="text" id="fecha_rango" name="fecha_rango" class="form-control"
                       placeholder="Seleccionar rango de fechas..." value="{{ request('fecha_rango') }}">
            </div>

            <div class="col-md-2 text-md-end text-start">
                <button type="button" class="btn btn-beauty btn-danger-beauty w-100" id="btn-recargar">
                    <i class="fas fa-sync-alt"></i> Recargar
                </button>
            </div>
        </form>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <!-- Columna cambiada a "Cliente" -->
                    <th>Cliente</th>
                    <th>Número de Factura</th>
                    <th>Fecha</th>
                    <th>Total (L)</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <!-- Bucle de datos cambiado a $ventas y acceso a $venta->cliente->nombre_empresa -->
                @forelse ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->cliente->nombre_empresa }}</td>
                        <td>{{ $venta->numero_factura }}</td>
                        <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                        <td>{{ number_format($venta->total, 2) }}</td>
                        <td class="action-buttons">
                            <!-- Ruta cambiada a 'ventas.show' -->
                            <a href="{{ route('facturaventa.show', $venta->id) }}" class="btn btn-beauty btn-secondary-beauty">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                @empty
                    <!-- Mensaje de tabla vacía cambiado -->
                    <tr>
                        <td colspan="6" class="text-center">No hay ventas registradas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($totalResultados))
            <div id="mensajeResultados">
                <i class="fas fa-info-circle"></i>
                {{ $totalResultados }} resultado{{ $totalResultados !== 1 ? 's' : '' }} encontrado{{ $totalResultados !== 1 ? 's' : '' }}.
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
<script>
    // Script JavaScript (cambio de ID de formulario y nombres de campos si aplica)
    const form = document.getElementById('filtroVentas'); // ID del formulario actualizado
    let timeout = null;

    function submitForm() {
        form.submit();
    }

    function debounceSubmit() {
        clearTimeout(timeout);
        timeout = setTimeout(submitForm, 700);
    }

    // Inicializa Flatpickr con las nuevas restricciones
    const fechaRangoInput = document.getElementById('fecha_rango');
    const fp = flatpickr(fechaRangoInput, {
        mode: "range",
        dateFormat: "Y-m-d",
        locale: "es",
        maxDate: "today",      // No permite fechas futuras
        minDate: "2000-01-01", // No permite fechas anteriores al 1 de enero del 2000
        onClose: function(selectedDates, dateStr, instance) {
            submitForm();
        }
    });

    // Lógica para el nuevo botón "Recargar"
    document.getElementById('btn-recargar').addEventListener('click', function() {
        // Reinicia los campos del formulario, ID de campo actualizado
        document.getElementById('cliente').value = '';
        fp.clear(); // Limpia la selección de fechas
        submitForm();
    });

    // Event listener para el campo 'cliente'
    document.getElementById('cliente').addEventListener('input', debounceSubmit);

    document.addEventListener('DOMContentLoaded', () => {
        // ID de campo actualizado
        const filtroCliente = document.getElementById('cliente');
        const mensajeResultados = document.getElementById('mensajeResultados');

        function actualizarMensajeResultados() {
            if (filtroCliente && mensajeResultados) {
                if (filtroCliente.value.trim() === '' && fechaRangoInput.value === '') {
                    mensajeResultados.style.display = 'none';
                } else {
                    mensajeResultados.style.display = 'block';
                }
            }
        }

        actualizarMensajeResultados();
        filtroCliente.addEventListener('input', actualizarMensajeResultados);
        fechaRangoInput.addEventListener('change', actualizarMensajeResultados);
    });
</script>
</body>
</html>
