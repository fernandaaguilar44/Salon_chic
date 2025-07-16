<!-- resources/views/facturas/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Facturas</title>
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

        /* Header de acciones mejorado */
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

        /* Tabla mejorada */
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
            background: linear-gradient(135deg, #7b2a8d 0%, #ff69b4 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgb(123, 42, 141);
            color: white;
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

        /* Mensaje de resultados */
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

        /* Responsive */
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
        <h2><i class="fas fa-file-invoice"></i> Listado de Facturas de Compra</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> Éxito:</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="header-actions">
        <div class="row align-items-end">

        </div>

        <form id="filtroFacturas" method="GET" action="{{ route('facturas.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="proveedor" class="form-label">
                    <i class="fas fa-truck"></i> Proveedor
                </label>
                <input type="text" id="proveedor" name="proveedor" class="form-control"
                       placeholder="Nombre proveedor..." value="{{ request('proveedor') }}">
            </div>

            <div class="col-md-3">
                <label for="anio" class="form-label">
                    <i class="fas fa-calendar"></i> Año
                </label>
                <select id="anio" name="anio" class="form-select">
                    <option value="">-- Todos --</option>
                    @php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 10;
                    @endphp
                    @for ($year = $currentYear; $year >= $startYear; $year--)
                        <option value="{{ $year }}" {{ request('anio') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3">
                <label for="mes" class="form-label">
                    <i class="fas fa-calendar-alt"></i> Mes
                </label>
                <select id="mes" name="mes" class="form-select">
                    <option value="">-- Todos --</option>
                    @foreach ([
                        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                    ] as $num => $nombre)
                        <option value="{{ $num }}" {{ request('mes') == $num ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 text-end mt-5">
                <a href="{{ route('facturas.create') }}" class="btn btn-beauty btn-primary-beauty w-100">
                    <i class="fas fa-plus"></i> Nueva Factura
                </a>
            </div>

        </form>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Proveedor</th>
                    <th>Número de Factura</th>
                    <th>Fecha</th>
                    <th>Total (L)</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id }}</td>
                        <td>{{ $factura->proveedor->nombre }}</td>
                        <td>{{ $factura->numero_factura }}</td>
                        <td>{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                        <td>{{ number_format($factura->total, 2) }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-beauty btn-secondary-beauty">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay facturas registradas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if(!is_null($totalResultados))
            <div id="mensajeResultados">
                <i class="fas fa-info-circle"></i>
                {{ $totalResultados }} resultado{{ $totalResultados !== 1 ? 's' : '' }} encontrado{{ $totalResultados !== 1 ? 's' : '' }}.
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('formFactura'); // Asume que tu formulario tiene este id, ajústalo si es otro
        const inputProveedor = document.getElementById('proveedor');
        const inputNumFactura = document.getElementById('numeroFactura'); // Cambia si tu input tiene otro id
        const inputProductos = document.getElementById('productosComprados'); // Cambia según tu input

        // Mostrar mensajes
        function mostrarError(input, mensaje) {
            let error = input.nextElementSibling;
            if (!error || !error.classList.contains('error-text')) {
                error = document.createElement('div');
                error.classList.add('error-text');
                error.style.color = 'red';
                error.style.fontSize = '0.85rem';
                error.style.marginTop = '0.25rem';
                input.parentNode.insertBefore(error, input.nextSibling);
            }
            error.textContent = mensaje;
            input.classList.add('is-invalid');
        }

        function limpiarError(input) {
            let error = input.nextElementSibling;
            if (error && error.classList.contains('error-text')) {
                error.remove();
            }
            input.classList.remove('is-invalid');
        }

        // Validar formato número factura y forzar mayúsculas y guion automático
        inputNumFactura.addEventListener('input', () => {
            let val = inputNumFactura.value.toUpperCase().replace(/[^A-Z0-9]/g, '');

            // Forzar 3 letras mayúsculas
            let letras = val.slice(0, 3).replace(/[^A-Z]/g, '');

            // Forzar guion después de las 3 letras
            let numeros = val.slice(3, 6).replace(/[^0-9]/g, '');

            let nuevoValor = letras;
            if (letras.length === 3) {
                nuevoValor += '-';
            }
            nuevoValor += numeros;

            inputNumFactura.value = nuevoValor;
        });

        form.addEventListener('submit', (e) => {
            let valid = true;

            // Limpiar errores previos
            limpiarError(inputProveedor);
            limpiarError(inputNumFactura);
            limpiarError(inputProductos);

            // Validar proveedor (no vacío)
            if (inputProveedor.value.trim() === '') {
                mostrarError(inputProveedor, 'El proveedor es obligatorio.');
                valid = false;
            }

            // Validar número factura (formato ABC-123)
            const regexNumFactura = /^[A-Z]{3}-\d{3}$/;
            if (inputNumFactura.value.trim() === '') {
                mostrarError(inputNumFactura, 'El número de factura es obligatorio.');
                valid = false;
            } else if (!regexNumFactura.test(inputNumFactura.value.trim())) {
                mostrarError(inputNumFactura, 'El número de factura debe tener el formato ABC-123.');
                valid = false;
            }

            // Validar productos comprados (no vacío)
            if (inputProductos.value.trim() === '') {
                mostrarError(inputProductos, 'Debe seleccionar al menos un producto.');
                valid = false;
            }

            if (!valid) {
                e.preventDefault(); // Evitar envío si hay errores
            }
        });
    });
    const form = document.getElementById('filtroFacturas');
    let timeout = null;

    function submitForm() {
        // Envía el formulario (GET) para recargar la vista con los filtros
        form.submit();
    }

    function debounceSubmit() {
        clearTimeout(timeout);
        timeout = setTimeout(submitForm, 700); // Espera 700ms tras última tecla/cambio
    }

    // Detecta escritura en el input proveedor
    document.getElementById('proveedor').addEventListener('input', debounceSubmit);

    // Detecta cambios en selects de año y mes
    document.getElementById('anio').addEventListener('change', submitForm);
    document.getElementById('mes').addEventListener('change', submitForm);

    document.addEventListener('DOMContentLoaded', () => {
        const filtroProveedor = document.getElementById('proveedor');
        const filtroMes = document.getElementById('mes');
        const filtroAnio = document.getElementById('anio');
        const mensajeResultados = document.getElementById('mensajeResultados');

        function actualizarMensajeResultados() {
            if (filtroProveedor && filtroMes && filtroAnio && mensajeResultados) {
                if (filtroProveedor.value.trim() === '' && filtroMes.value === '' && filtroAnio.value === '') {
                    mensajeResultados.style.display = 'none';
                } else {
                    mensajeResultados.style.display = 'block';
                }
            }
        }

        actualizarMensajeResultados();

        [filtroProveedor, filtroMes, filtroAnio].forEach(el => {
            if (el) {
                el.addEventListener('input', () => {
                    actualizarMensajeResultados();
                });
            }
        });
    });
</script>
</body>
</html>
