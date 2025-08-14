<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registrar Factura de Venta</title> {{-- Título de la página actualizado --}}
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            padding: 1rem 0;
        }
        .form-container {
            max-width: 900px;
            background: rgba(255,255,255,0.95);
            margin: auto;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228,0,124,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            animation: slideInUp 0.6s ease-out;
        }
        @keyframes slideInUp {
            from { opacity:0; transform: translateY(30px); }
            to { opacity:1; transform: translateY(0); }
        }
        h2 {
            color: #7B2A8D; font-weight:700; font-size:1.8rem;
            text-align:center; margin-bottom:1.5rem; text-shadow:0 2px 4px rgba(123,42,141,0.1);
            position:relative;
        }
        h2::after {
            content: ''; display:block; width:100px; height:3px;
            background: linear-gradient(90deg,#E4007C,#7B2A8D);
            margin:8px auto 0; border-radius:2px;
        }
        label { font-weight:600; color:#4a4a4a; font-size:0.9rem; display:flex; align-items:center; gap:6px; }
        .form-control {
            border:2px solid #e9ecef; border-radius:10px;
            padding:0.6rem 1rem; font-size:0.9rem;
            transition:all 0.3s ease; background:rgba(255,255,255,0.8); color:#333;
        }
        .form-control:focus {
            border-color:#E4007C; box-shadow:0 0 0 0.2rem rgba(228,0,124,0.15);
            background:white; color:#000;
        }
        .invalid-feedback { font-size:0.8rem; }
        .btn { padding:0.7rem 1.8rem; border-radius:25px; font-weight:600; display:flex; align-items:center; gap:8px; border:none; transition:all 0.3s ease; }
        .btn-primary { background: linear-gradient(135deg,#E4007C,#7B2A8D); color:#fff; }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(228,0,124,0.4); }
        .btn-secondary, .btn-danger { background: linear-gradient(135deg,#6c757d,#495057); color:#fff; }
        .btn-secondary:hover, .btn-danger:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(108,117,125,0.4); }
        .btn-group-left { display:flex; gap:1rem; justify-content:flex-start; margin-top:1.5rem; padding-top:1rem; border-top:2px solid rgba(228,0,124,0.1); }
        .btn-sm { font-size:0.8rem; padding:0.4rem 0.8rem; }
        @media(max-width:768px) {
            .btn-group-left { flex-direction:column; }
            .btn, .btn-sm { width:100%; justify-content:center; }
        }
        .table-products-wrapper {
            margin-top: 1rem;
            display: none; /* Initially hidden */
        }
        /* Style for read-only calculated fields */
        .calculated-field {
            background-color: #e9ecef !important;
            color: #333 !important;
            border: none !important;
            user-select: none;
            cursor: default;
            font-weight: bold; /* Make calculated fields stand out */
        }

        /* Estilos unificados para TODAS las tablas con degradado rosa-morado */
        .table {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(228,0,124,0.15);
            border: 2px solid rgba(228,0,124,0.1);
        }

        .table thead {
            background: linear-gradient(135deg, #E4007C, #7B2A8D) !important;
        }

        .table thead th {
            color: white !important;
            border-color: rgba(255,255,255,0.3) !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border-bottom: 3px solid rgba(255,255,255,0.2) !important;
        }

        .table tbody {
            background: rgba(255,255,255,0.95);
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(228,0,124,0.1);
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, rgba(228,0,124,0.05), rgba(123,42,141,0.05)) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(228,0,124,0.1);
        }

        .table tbody td {
            color: #333 !important;
            border-color: rgba(228,0,124,0.15) !important;
            vertical-align: middle;
            padding: 0.875rem 0.75rem;
            font-weight: 500;
        }

        /* Estilos específicos para la tabla de productos principal */
        #productosTable {
            margin-top: 1rem;
            background: rgba(255,255,255,0.98) !important;
            border-radius: 15px !important;
            overflow: hidden !important;
            box-shadow: 0 12px 30px rgba(228,0,124,0.2) !important;
            border: 3px solid rgba(228,0,124,0.15) !important;
        }

        #productosTable thead {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 50%, #E4007C 100%) !important;
            position: relative;
        }

        #productosTable thead::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, rgba(255,255,255,0.3), rgba(255,255,255,0.7), rgba(255,255,255,0.3));
        }

        #productosTable thead th {
            color: #000000 !important;
            border-color: rgba(255,255,255,0.3) !important;
            font-weight: 700 !important;
            text-shadow: 0 2px 6px rgba(0,0,0,0.4) !important;
            padding: 1.2rem 0.75rem !important;
            font-size: 0.95rem !important;
            letter-spacing: 0.5px !important;
            text-transform: uppercase !important;
            background: none !important;
        }

        #productosTable tbody {
            background: rgba(255,255,255,0.95) !important;
        }

        #productosTable tbody tr {
            background: rgb(0, 0, 0) !important;
            transition: all 0.4s ease !important;
            border-bottom: 1px solid rgba(228,0,124,0.1) !important;
        }

        #productosTable tbody tr:nth-child(even) {
            background: linear-gradient(135deg, rgba(255,238,248,0.3), rgba(243,230,249,0.3)) !important;
        }

        #productosTable tbody tr:hover {
            background: linear-gradient(135deg, rgba(228,0,124,0.08), rgba(123,42,141,0.08)) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(228,0,124,0.15) !important;
        }

        #productosTable tbody td {
            color: #2c2c2c !important;
            border-color: rgba(228,0,124,0.12) !important;
            font-weight: 500 !important;
            padding: 1rem 0.75rem !important;
            vertical-align: middle !important;
        }

        #productosTable .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #productosTable .btn-danger:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(220,53,69,0.4);
        }

        /* Eliminar estilos conflictivos de Bootstrap */
        #productosTable.table-bordered,
        #productosTable.bg-white {
            background: none !important;
            border: none !important;
        }

        #productosTable thead.table-light {
            background: none !important;
        }

        .btn-quitar {
            background-color: transparent;
            color: #dc3545;
            border: none;
            font-size: 1.2rem;
        }

        .btn-quitar:hover {
            color: #e4007c;
        }

        /* Modal Styles - Unified with main theme */
        .modal-content {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228,0,124,0.15);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .modal-header {
            background: linear-gradient(135deg,#E4007C,#7B2A8D) !important;
            color: white !important;
            border-bottom: 2px solid rgba(228,0,124,0.2);
            border-radius: 20px 20px 0 0 !important;
        }

        .modal-title {
            color: white !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-close-white {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            background: rgba(255,255,255,0.95);
        }

        /* Tabla del modal con degradado rosa-morado mejorado */
        #modalProductos .table {
            background: rgba(255,255,255,0.98);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(228,0,124,0.2);
            border: 3px solid rgba(228,0,124,0.15);
        }

        #modalProductos .table thead {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 50%, #E4007C 100%) !important;
            position: relative;
        }

        #modalProductos .table thead::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, rgba(255,255,255,0.3), rgba(255,255,255,0.7), rgba(255,255,255,0.3));
        }

        #modalProductos .table thead th {
            color: white !important;
            border-color: rgba(255,255,255,0.3) !important;
            font-weight: 700;
            text-shadow: 0 2px 6px rgba(0,0,0,0.4);
            padding: 1.2rem 0.75rem;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        #modalProductos .table tbody tr {
            background: rgba(255,255,255,0.9);
            transition: all 0.4s ease;
        }

        #modalProductos .table tbody tr:nth-child(even) {
            background: linear-gradient(135deg, rgba(255,238,248,0.3), rgba(243,230,249,0.3));
        }

        #modalProductos .table tbody tr:hover {
            background: linear-gradient(135deg, rgba(228,0,124,0.08), rgba(123,42,141,0.08)) !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228,0,124,0.15);
        }

        #modalProductos .table tbody td {
            color: #2c2c2c !important;
            border-color: rgba(228,0,124,0.12) !important;
            font-weight: 500;
            padding: 1rem 0.75rem;
        }

        /* Modal form controls con tema rosa-morado */
        #modalProductos .form-control {
            border: 2px solid rgba(228,0,124,0.2);
            border-radius: 10px;
            background: rgba(255,255,255,0.95);
            color: #2c2c2c;
            transition: all 0.3s ease;
        }

        #modalProductos .form-control:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.25rem rgba(228,0,124,0.2);
            background: white;
            transform: scale(1.02);
        }

        /* Modal buttons mejorados */
        #modalProductos .btn-success {
            background: linear-gradient(135deg,#E4007C,#7B2A8D);
            border: none;
            color: white;
            border-radius: 20px;
            font-weight: 600;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        #modalProductos .btn-success:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(228,0,124,0.4);
        }

        /* Modal card styling mejorado */
        #modalProductos .card {
            background: rgba(255,255,255,0.95);
            border: 3px solid rgba(228,0,124,0.15);
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(228,0,124,0.15);
            overflow: hidden;
        }

        #modalProductos .card-header {
            background: linear-gradient(135deg, #E4007C, #7B2A8D) !important;
            color: white !important;
            border-bottom: 3px solid rgba(255,255,255,0.2);
            border-radius: 20px 20px 0 0 !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            padding: 1rem 1.25rem;
        }

        #modalProductos .card-body {
            background: rgba(255,255,255,0.98);
            padding: 1.5rem;
        }

        #modalProductos .card-body p {
            color: #495057;
            margin-bottom: 0.75rem;
            font-weight: 500;
        }

        #modalProductos .card-body span {
            color: #2c2c2c;
            font-weight: 700;
        }

        .bg-gradient-pink-purple {
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
        }

        /* Efectos adicionales para mejor visualización */
        .table-responsive {
            border-radius: 15px;
            padding: 0;
        }

        /* Animaciones suaves para las tablas */
        .table tbody tr {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Estilos adicionales para mejor visualización */
        .container {
            padding: 2rem;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: none;
        }

        .card-header {
            font-weight: bold;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .card-body {
            padding: 2rem;
        }

    </style>
</head>
<body>


<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="form-container">
                {{-- Título del formulario cambiado a "Registrar Factura de Venta" --}}
                <h2><i class="fas fa-file-invoice-dollar"></i> Registrar Factura de Venta</h2>

                {{-- La acción del formulario ahora apunta a la ruta de ventas --}}
                <form id="ventaForm" method="POST" action="{{ route('ventas.store') }}" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 position-relative">
                            {{-- Etiqueta y campo de búsqueda de cliente --}}
                            <label for="nombre_empresa"><i class="fas fa-user-tag"></i> Buscar cliente</label>
                            <input type="text" id="nombre_empresa" name="nombre_cliente" {{-- name cambiado para claridad --}}
                            class="form-control @error('cliente_id') is-invalid @enderror" {{-- Validacion actualizada --}}
                                   placeholder="Escriba el nombre del cliente para buscar..." autocomplete="off"
                                   value="{{ old('nombre_cliente') }}"> {{-- value actualizado --}}
                            <input type="hidden" name="cliente_id" id="cliente_id" value="{{ old('cliente_id') }}"> {{-- ID de cliente --}}

                            {{-- Lista de resultados de búsqueda de clientes --}}
                            <div class="list-group position-absolute w-100" id="listaClientes" style="max-height: 200px; overflow-y: auto; z-index: 1000; display: none;"></div>

                            {{-- Mensaje de resultados de búsqueda de clientes --}}
                            <div class="form-text text-muted mt-1" id="resultadosCliente"></div>
                            @error('cliente_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="numero_factura_display"><i class="fas fa-file-alt"></i> Número de factura</label>
                            <input type="hidden" id="numero_factura" name="numero_factura"
                                   value="{{ old('numero_factura') }}" />

                            <p class="form-control-plaintext" id="numero_factura_display"
                               style="font-weight: bold; font-size: 1.2em;">
                                {{ old('numero_factura', 'Generando...') }}
                            </p>

                            @error('numero_factura')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label><i class="fas fa-boxes"></i> Productos vendidos</label> {{-- Texto actualizado --}}
                            <div class="table-responsive table-products-wrapper" id="productosTableWrapper">
                                <table class="table table-bordered bg-white text-center align-middle" id="productosTable">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Tipo Impuesto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario (L)</th> {{-- Cambiado de "Precio Compra" --}}
                                        <th>Subtotal (L)</th>
                                        <th style="width:50px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex gap-2 flex-wrap mt-2" id="productosButtonsContainer">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalProductos">
                                    <i class="fas fa-box-open"></i> Seleccionar de productos
                                </button>
                            </div>
                            @error('items')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-none" id="itemsContainer"></div>

                        <div class="card bg-light p-3">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-calculator"></i> Resumen de la Venta</h5> {{-- Título actualizado --}}
                                <div class="row mb-2">
                                    <div class="col-6 text-end">
                                        <label>Importe Exonerado (L):</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-control calculated-field"><span id="subtotalExoneradoLabel">0.00</span></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-end">
                                        <label>Importe Exento (L):</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-control calculated-field"><span id="subtotalExentoLabel">0.00</span></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-end">
                                        <label>Importe Gravado 15% (L):</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-control calculated-field"><span id="subtotalGravado15Label">0.00</span></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6 text-end">
                                        <label>ISV 15% (L):</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-control calculated-field"><span id="isv15Label">0.00</span></div>
                                    </div>
                                </div>
                                <hr class="my-2" />
                                <div class="row">
                                    <div class="col-6 text-end">
                                        <label class="fw-bold">Total de la Venta (L):</label> {{-- Texto actualizado --}}
                                    </div>
                                    <div class="col-6">
                                        <div class="form-control calculated-field bg-primary text-white fw-bold">
                                            <span id="granTotalLabel">0.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-none">
                                    <input type="hidden" id="importe_exonerado" name="importe_exonerado" value="0.00">
                                    <input type="hidden" id="importe_exento" name="importe_exento" value="0.00">
                                    <input type="hidden" id="importe_gravado_15" name="importe_gravado_15" value="0.00">
                                    <input type="hidden" id="isv_15" name="isv_15" value="0.00">
                                    <input type="hidden" id="gran_total" name="total" value="0.00">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="notas"><i class="fas fa-align-left"></i> Notas / Comentarios</label>
                            <textarea id="notas" name="notas" rows="3" maxlength="200" class="form-control @error('notas') is-invalid @enderror">{{ old('notas') }}</textarea>
                            @error('notas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="btn-group-left">
                        {{-- Botón de cancelar con ruta de ventas --}}
                        <a href="{{ route('ventas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                        <button type="reset" class="btn btn-danger" id="btnLimpiarFactura"><i class="fas fa-eraser"></i> Limpiar</button>
                        {{-- Texto del botón de guardar actualizado --}}
                        <button type="submit" class="btn btn-primary">Guardar Venta</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Modal for Products with Search Filter --}}
<div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-image: linear-gradient(to right, #a8c0ff, #3f2b96);">
                <h5 class="modal-title" id="modalProductosLabel">Seleccionar Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div id="modalListaProductos">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="productSearchInput" placeholder="Buscar producto por nombre...">
                    </div>
                    <div id="resultadosBusquedaProductos" class="alert alert-info mt-3 d-none"></div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Impuesto</th>
                                <th>Precio Venta</th> {{-- Cambiado de "Precio Compra" --}}
                                <th>Acción</th> {{-- Añadida columna para el botón de agregar --}}
                            </tr>
                            </thead>
                            <tbody id="modalBodyProductos">
                            @foreach ($productos as $index => $producto)
                                <tr data-product-id="{{ $producto->id }}"
                                    data-nombre="{{ $producto->nombre }}"
                                    data-precio-venta="{{ $producto->precio_venta }}" {{-- Solo precio_venta --}}
                                    data-impuesto="gravado15"> {{-- Asumiendo gravado 15% por defecto para ventas --}}
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>
                                        <span class="badge bg-success">Gravado 15%</span>
                                    </td>
                                    <td>L {{ number_format($producto->precio_venta, 2) }}</td> {{-- Mostrando precio_venta --}}
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary agregarProductoModal">
                                            <i class="fas fa-plus"></i> Agregar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="modalDetallesProducto" class="d-none">
                    <h5 class="mb-3">Detalle del Producto Seleccionado</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Impuesto</th>
                                <th>Precio Venta</th> {{-- Cambiado de "Precio Compra" --}}
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody id="detalleProductoTablaBody">
                            {{-- Los detalles del producto se cargarán aquí dinámicamente --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button id="btnVolver" type="button" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver a la Lista
                        </button>
                        <button id="btnAgregarConfirmar" type="button" class="btn btn-success">
                            <i class="fas fa-plus"></i> Agregar a Venta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Variables globales para la gestión de productos
    let productosSeleccionados = [];
    let productosDisponibles = @json($productos ?? []); // Asegura que $productos esté disponible en JS

    // Función para manejar el autocompletado de clientes
    const searchClientes = async (query) => {
        const listaClientes = document.getElementById('listaClientes');
        if (query.length < 2) {
            listaClientes.style.display = 'none';
            return;
        }

        try {
            // Asumiendo una ruta API para buscar clientes
            const response = await fetch(`/api/clientes?query=${query}`); // Modifica esta ruta si es diferente
            const clientes = await response.json();

            listaClientes.innerHTML = '';
            if (clientes.length > 0) {
                clientes.forEach(cliente => {
                    const item = document.createElement('a');
                    item.href = '#';
                    item.classList.add('list-group-item', 'list-group-item-action');
                    item.textContent = cliente.nombre_empresa;
                    item.addEventListener('click', (e) => {
                        e.preventDefault();
                        document.getElementById('nombre_empresa').value = cliente.nombre_empresa;
                        document.getElementById('cliente_id').value = cliente.id;
                        listaClientes.style.display = 'none';
                    });
                    listaClientes.appendChild(item);
                });
                listaClientes.style.display = 'block';
            } else {
                listaClientes.style.display = 'none';
            }
        } catch (error) {
            console.error('Error buscando clientes:', error);
            listaClientes.style.display = 'none';
        }
    };

    // Event listener para el campo de búsqueda de cliente
    document.getElementById('nombre_empresa').addEventListener('input', (e) => {
        searchClientes(e.target.value);
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.position-relative') || e.target.id === 'nombre_empresa') {
            document.getElementById('listaClientes').style.display = 'none';
        }
    });

    // Generar un número de factura inicial (puedes reemplazar esto con una llamada a tu backend)
    document.addEventListener('DOMContentLoaded', () => {
        const numeroFacturaInput = document.getElementById('numero_factura');
        const numeroFacturaDisplay = document.getElementById('numero_factura_display');
        if (!numeroFacturaInput.value) { // Solo si no hay un valor antiguo (old value)
            const randomNum = Math.floor(1000 + Math.random() * 9000); // Ejemplo simple
            const prefix = 'VEN'; // Prefijo para ventas
            const newNumeroFactura = `${prefix}-${randomNum}`;
            numeroFacturaInput.value = newNumeroFactura;
            numeroFacturaDisplay.textContent = newNumeroFactura;
        }
        updateTotals(); // Asegura que los totales se calculen al cargar la página
    });

    // Lógica para el modal de productos
    const modalProductos = new bootstrap.Modal(document.getElementById('modalProductos'));
    const modalBodyProductos = document.getElementById('modalBodyProductos');
    const modalListaProductos = document.getElementById('modalListaProductos');
    const modalDetallesProducto = document.getElementById('modalDetallesProducto');
    const detalleProductoTablaBody = document.getElementById('detalleProductoTablaBody');
    const btnVolver = document.getElementById('btnVolver');
    const btnAgregarConfirmar = document.getElementById('btnAgregarConfirmar');
    const productSearchInput = document.getElementById('productSearchInput');
    const resultadosBusquedaProductos = document.getElementById('resultadosBusquedaProductos');

    let productoSeleccionadoDetalle = null; // Para almacenar el producto seleccionado en el modal

    // Función para mostrar los productos en el modal (puede ser filtrada)
    function renderModalProducts(filter = '') {
        modalBodyProductos.innerHTML = '';
        const filteredProducts = productosDisponibles.filter(producto =>
            producto.nombre.toLowerCase().includes(filter.toLowerCase())
        );

        if (filteredProducts.length === 0) {
            resultadosBusquedaProductos.classList.remove('d-none');
            resultadosBusquedaProductos.textContent = 'No se encontraron productos con ese nombre.';
            return;
        } else {
            resultadosBusquedaProductos.classList.add('d-none');
        }

        filteredProducts.forEach((producto, index) => {
            const row = document.createElement('tr');
            row.dataset.productId = producto.id;
            row.dataset.nombre = producto.nombre;
            row.dataset.precioVenta = producto.precio_venta; // Solo precio_venta
            row.dataset.impuesto = 'gravado15'; // Asumiendo esto por simplicidad

            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${producto.nombre}</td>
                <td><span class="badge bg-success">Gravado 15%</span></td>
                <td>L ${number_format(producto.precio_venta, 2)}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary agregarProductoModal">
                        <i class="fas fa-plus"></i> Agregar
                    </button>
                </td>
            `;
            modalBodyProductos.appendChild(row);
        });
        attachModalProductListeners();
    }

    // Event listener para buscar productos en el modal
    productSearchInput.addEventListener('input', (e) => {
        renderModalProducts(e.target.value);
    });

    // Función para adjuntar listeners a los botones de "Agregar" en el modal
    function attachModalProductListeners() {
        document.querySelectorAll('.agregarProductoModal').forEach(button => {
            button.onclick = (event) => {
                const row = event.target.closest('tr');
                productoSeleccionadoDetalle = {
                    id: row.dataset.productId,
                    nombre: row.dataset.nombre,
                    precio_venta: parseFloat(row.dataset.precioVenta),
                    tipo_impuesto: row.dataset.impuesto,
                    cantidad: 1 // Cantidad inicial por defecto
                };
                showProductDetailsInModal(productoSeleccionadoDetalle);
            };
        });
    }

    // Función para mostrar los detalles del producto en el modal
    function showProductDetailsInModal(producto) {
        modalListaProductos.classList.add('d-none');
        modalDetallesProducto.classList.remove('d-none');
        detalleProductoTablaBody.innerHTML = `
            <tr>
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td><span class="badge bg-success">${producto.tipo_impuesto.replace('gravado', 'Gravado ')}%</span></td>
                <td>L ${number_format(producto.precio_venta, 2)}</td>
                <td>
                    <input type="number" class="form-control form-control-sm" value="${producto.cantidad}" min="1" id="cantidadProductoModal">
                </td>
            </tr>
        `;

        // Event listener para la cantidad en el modal de detalles
        document.getElementById('cantidadProductoModal').addEventListener('input', (e) => {
            productoSeleccionadoDetalle.cantidad = parseInt(e.target.value) || 1;
        });
    }

    // Volver a la lista de productos en el modal
    btnVolver.addEventListener('click', () => {
        modalListaProductos.classList.remove('d-none');
        modalDetallesProducto.classList.add('d-none');
        productoSeleccionadoDetalle = null;
        productSearchInput.value = ''; // Limpiar búsqueda
        renderModalProducts(); // Volver a renderizar sin filtro
    });

    // Confirmar y agregar producto a la tabla principal
    btnAgregarConfirmar.addEventListener('click', () => {
        if (productoSeleccionadoDetalle) {
            addProductToMainTable(productoSeleccionadoDetalle);
            modalProductos.hide(); // Cerrar el modal
            btnVolver.click(); // Resetear el modal a la vista de lista
        }
    });

    // Función para añadir un producto a la tabla principal
    function addProductToMainTable(producto) {
        const productosTableBody = document.querySelector('#productosTable tbody');
        const existingRow = productosTableBody.querySelector(`tr[data-product-id="${producto.id}"]`);

        if (existingRow) {
            // Si el producto ya está en la tabla, actualiza la cantidad y el subtotal
            let currentQuantity = parseInt(existingRow.querySelector('.product-cantidad').value);
            currentQuantity += producto.cantidad;
            existingRow.querySelector('.product-cantidad').value = currentQuantity;
            updateRowSubtotal(existingRow);
        } else {
            // Si es un nuevo producto, crea una nueva fila
            const newRow = document.createElement('tr');
            newRow.dataset.productId = producto.id;
            newRow.dataset.tipoImpuesto = producto.tipo_impuesto;
            newRow.dataset.precioUnitario = producto.precio_venta; // Usar precio_venta como precio_unitario
            newRow.innerHTML = `
                <td>${producto.nombre}</td>
                <td><span class="badge bg-primary">${producto.tipo_impuesto.replace('gravado', 'Gravado ')}%</span></td>
                <td><input type="number" class="form-control form-control-sm product-cantidad" value="${producto.cantidad}" min="1"></td>
                <td>L <span class="product-precio-unitario">${number_format(producto.precio_venta, 2)}</span></td>
                <td>L <span class="product-subtotal">0.00</span></td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-product">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            productosTableBody.appendChild(newRow);

            // Adjuntar event listener para cambios de cantidad
            newRow.querySelector('.product-cantidad').addEventListener('input', (e) => {
                updateRowSubtotal(newRow);
            });

            // Adjuntar event listener para quitar producto
            newRow.querySelector('.remove-product').addEventListener('click', () => {
                newRow.remove();
                updateTotals(); // Recalcular totales después de quitar
                checkProductosTableVisibility();
            });
        }
        updateRowSubtotal(existingRow || newRow); // Asegura que el subtotal se calcule para la fila nueva o existente
        checkProductosTableVisibility();
    }

    // Función para actualizar el subtotal de una fila y los totales generales
    function updateRowSubtotal(row) {
        const cantidad = parseFloat(row.querySelector('.product-cantidad').value);
        const precioUnitario = parseFloat(row.dataset.precioUnitario);
        const subtotal = cantidad * precioUnitario;
        row.querySelector('.product-subtotal').textContent = number_format(subtotal, 2);
        updateTotals();
    }

    // Función principal para calcular y actualizar los totales de la factura
    function updateTotals() {
        let totalExonerado = 0;
        let totalExento = 0;
        let totalGravado15 = 0;
        let totalIsv15 = 0;

        document.querySelectorAll('#productosTable tbody tr').forEach(row => {
            const subtotal = parseFloat(row.querySelector('.product-subtotal').textContent.replace(/[^0-9.-]+/g, ""));
            const tipoImpuesto = row.dataset.tipoImpuesto;

            if (tipoImpuesto === 'exonerado') {
                totalExonerado += subtotal;
            } else if (tipoImpuesto === 'exento') {
                totalExento += subtotal;
            } else if (tipoImpuesto === 'gravado15') {
                totalGravado15 += subtotal;
                totalIsv15 += subtotal * 0.15; // 15% de ISV
            }
            // Agrega más tipos de impuestos si los tienes (e.g., gravado18)
        });

        const granTotal = totalExonerado + totalExento + totalGravado15 + totalIsv15;

        document.getElementById('subtotalExoneradoLabel').textContent = number_format(totalExonerado, 2);
        document.getElementById('subtotalExentoLabel').textContent = number_format(totalExento, 2);
        document.getElementById('subtotalGravado15Label').textContent = number_format(totalGravado15, 2);
        document.getElementById('isv15Label').textContent = number_format(totalIsv15, 2);
        document.getElementById('granTotalLabel').textContent = number_format(granTotal, 2);

        // Actualizar campos ocultos para enviar al backend
        document.getElementById('importe_exonerado').value = totalExonerado.toFixed(2);
        document.getElementById('importe_exento').value = totalExento.toFixed(2);
        document.getElementById('importe_gravado_15').value = totalGravado15.toFixed(2);
        document.getElementById('isv_15').value = totalIsv15.toFixed(2);
        document.getElementById('gran_total').value = granTotal.toFixed(2);

        updateHiddenItemsInput(); // Actualizar el input oculto para los items
    }

    // Función para mostrar/ocultar la tabla de productos
    function checkProductosTableVisibility() {
        const productosTableBody = document.querySelector('#productosTable tbody');
        if (productosTableBody.children.length > 0) {
            document.getElementById('productosTableWrapper').style.display = 'block';
        } else {
            document.getElementById('productosTableWrapper').style.display = 'none';
        }
    }

    // Función para actualizar el input oculto 'items' con los datos de los productos seleccionados
    function updateHiddenItemsInput() {
        const items = [];
        document.querySelectorAll('#productosTable tbody tr').forEach(row => {
            items.push({
                producto_id: row.dataset.productId,
                nombre_producto_manual: row.querySelector('td:nth-child(1)').textContent, // Opcional si el nombre viene del producto
                tipo_impuesto: row.dataset.tipoImpuesto,
                cantidad: parseInt(row.querySelector('.product-cantidad').value),
                precio_unitario: parseFloat(row.dataset.precioUnitario),
                subtotal: parseFloat(row.querySelector('.product-subtotal').textContent.replace(/[^0-9.-]+/g, ""))
            });
        });
        document.getElementById('itemsContainer').innerHTML = `<input type="hidden" name="items" value='${JSON.stringify(items)}'>`;
    }

    // Función para formatear números (similar a number_format de PHP)
    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        const n = !isFinite(+number) ? 0 : +number;
        const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
        const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
        const dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
        let s = '';
        const toFixedFix = function (n, prec) {
            const k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k).toFixed(prec);
        };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Lógica para el botón "Limpiar"
    document.getElementById('btnLimpiarFactura').addEventListener('click', () => {
        document.getElementById('nombre_empresa').value = '';
        document.getElementById('cliente_id').value = '';
        document.getElementById('numero_factura').value = ''; // Limpiar el número de factura
        document.getElementById('numero_factura_display').textContent = 'Generando...'; // Resetear display
        document.querySelector('#productosTable tbody').innerHTML = ''; // Limpiar productos de la tabla
        document.getElementById('notas').value = '';
        checkProductosTableVisibility();
        updateTotals(); // Recalcular todos los totales a cero
        // Volver a generar el número de factura para una nueva transacción
        const randomNum = Math.floor(1000 + Math.random() * 9000);
        const prefix = 'VEN';
        const newNumeroFactura = `${prefix}-${randomNum}`;
        document.getElementById('numero_factura').value = newNumeroFactura;
        document.getElementById('numero_factura_display').textContent = newNumeroFactura;
    });

    // Inicializar la tabla de productos del modal
    renderModalProducts();
    checkProductosTableVisibility(); // Llama esto al inicio para manejar la visibilidad inicial
</script>
</body>
</html>

