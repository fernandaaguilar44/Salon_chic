
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registrar factura de compra</title>
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

@include('layouts.slider')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
        </div>
    </div>
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="form-container">
                <h2><i class="fas fa-file-invoice-dollar"></i> Registrar factura de compra</h2>

                <form id="facturaForm" method="POST" action="{{ route('facturas.store') }}" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 position-relative">
                            <label for="nombre_empresa"><i class="fas fa-truck"></i> Buscar proveedor</label>
                            <input type="text" id="nombre_empresa" name="nombre_empresa"
                                   class="form-control @error('proveedor_id') is-invalid @enderror"
                                   placeholder="Escriba el nombre de la empresa para buscar..." autocomplete="off"
                                   value="{{ old('nombre_empresa') }}">
                            <input type="hidden" name="proveedor_id" id="proveedor_id" value="{{ old('proveedor_id') }}">

                            <div class="list-group position-absolute w-100" id="listaProveedores" style="max-height: 200px; overflow-y: auto; z-index: 1000; display: none;"></div>

                            <div class="form-text text-muted mt-1" id="resultadosProveedor"></div>
                            @error('proveedor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                            <label><i class="fas fa-boxes"></i> Productos comprados</label>
                            <div class="table-responsive table-products-wrapper" id="productosTableWrapper">
                                <table class="table table-bordered bg-white text-center align-middle" id="productosTable">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Tipo Impuesto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario (L)</th>
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
                                <h5 class="card-title"><i class="fas fa-calculator"></i> Resumen de la Factura</h5>
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
                                        <label class="fw-bold">Total de la Factura (L):</label>
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
                        <a href="{{ route('facturas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                        <button type="reset" class="btn btn-danger" id="btnLimpiarFactura"><i class="fas fa-eraser"></i> Limpiar</button>
                        <button type="submit" class="btn btn-primary">Guardar Factura</button>
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
                                <th>Ver Detalles</th>
                            </tr>
                            </thead>
                            <tbody id="modalBodyProductos">
                            @foreach ($productos as $index => $producto)
                                <tr data-product-id="{{ $producto->id }}"
                                    data-nombre="{{ $producto->nombre }}"
                                    data-precio-compra="{{ $producto->precio_compra }}"
                                    data-precio-venta="{{ $producto->precio_venta }}"
                                    data-impuesto="gravado15">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>
                                        <span class="badge bg-success">Gravado 15%</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info verDetalles">
                                            <i class="fas fa-eye"></i> Detalles
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
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody id="detalleProductoTablaBody">
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button id="btnVolver" type="button" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver a la Lista
                        </button>
                        <button id="btnAgregarConfirmar" type="button" class="btn btn-success">
                            <i class="fas fa-plus"></i> Agregar a Factura
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--</div>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // --- REFERENCIAS A ELEMENTOS DEL DOM ---
        // Del modal de productos
        const productSearchInput = document.getElementById('productSearchInput');
        const modalBodyProducts = document.getElementById('modalBodyProductos');
        const productRows = modalBodyProducts.getElementsByTagName('tr');
        const resultadosBusquedaProductos = document.getElementById('resultadosBusquedaProductos');
        const modalProductos = document.getElementById('modalProductos');
        const modalListaProductos = document.getElementById('modalListaProductos');
        const modalDetallesProducto = document.getElementById('modalDetallesProducto');
        const detalleProductoTablaBody = document.getElementById('detalleProductoTablaBody');
        const btnVolver = document.getElementById('btnVolver');
        const btnAgregarConfirmar = document.getElementById('btnAgregarConfirmar');

        // De la factura principal
        const form = document.getElementById('facturaForm');
        const productosTableBody = document.getElementById('productosTable').querySelector('tbody');
        const productosTableWrapper = document.getElementById('productosTableWrapper');
        const productosButtonsContainer = document.getElementById('productosButtonsContainer');
        const btnLimpiarFactura = document.getElementById('btnLimpiarFactura');
        const granTotalLabel = document.getElementById('granTotalLabel');
        const numeroFacturaDisplay = document.getElementById('numero_factura_display');
        const listaProveedores = document.getElementById('listaProveedores');
        const resultadosProveedor = document.getElementById('resultadosProveedor');
        const itemsContainer = document.getElementById('itemsContainer');
        const importeExoneradoInput = document.getElementById('importe_exonerado');
        const importeExentoInput = document.getElementById('importe_exento');
        const importeGravado15Input = document.getElementById('importe_gravado_15');
        const isv15Input = document.getElementById('isv_15');
        const totalInput = document.getElementById('gran_total');
        const inputNombreEmpresa = document.getElementById('nombre_empresa');
        const inputProveedorId = document.getElementById('proveedor_id');
        const numeroFactura = document.getElementById('numero_factura');
        const notas = document.getElementById('notas');
        const ISV_RATE = 0.15;
        let itemIndex = 0;


        // --- FUNCIONES DE VALIDACIÓN Y CÁLCULO ---
        const generarNumeroFacturaUnico = async () => {
            const generarNumeroAleatorio = () => {
                const prefijo = '000-001-01-0-';
                let parteUnica = '';
                for (let i = 0; i < 7; i++) {
                    parteUnica += Math.floor(Math.random() * 10);
                }
                return prefijo + parteUnica;
            };

            let esUnico = false;
            let nuevoNumeroFactura;

            while (!esUnico) {
                nuevoNumeroFactura = generarNumeroAleatorio();
                const url = "{{ route('facturas.checkUniqueNumeroFactura') }}";
                try {
                    const response = await fetch(url + '?numero_factura=' + nuevoNumeroFactura);
                    const data = await response.json();
                    if (data.is_unique) {
                        esUnico = true;
                    }
                } catch (error) {
                    console.error('Error al verificar unicidad:', error);
                    break;
                }
            }
            numeroFactura.value = nuevoNumeroFactura;
            numeroFacturaDisplay.textContent = nuevoNumeroFactura;
        };

        const validarUnicidadNumeroFactura = async (numero) => {
            const url = "{{ route('facturas.checkUniqueNumeroFactura') }}";
            try {
                const response = await fetch(url + '?numero_factura=' + numero);
                if (!response.ok) return true;
                const data = await response.json();
                return data.is_unique;
            } catch (error) {
                console.error('Error al verificar unicidad:', error);
                return false;
            }
        };

        const actualizarTotales = () => {
            let importeExonerado = 0;
            let importeExento = 0;
            let importeGravado15 = 0;

            const itemInputs = itemsContainer.querySelectorAll('input[name$="[tipo_impuesto]"]');

            if (itemInputs.length > 0) {
                productosTableWrapper.style.display = 'block';
            } else {
                productosTableWrapper.style.display = 'none';
            }

            itemInputs.forEach(input => {
                const itemIndex = input.name.match(/\[(\d+)\]/)[1];
                const cantidad = parseFloat(document.querySelector(`input[name="items[${itemIndex}][cantidad]"]`).value) || 0;
                const precio = parseFloat(document.querySelector(`input[name="items[${itemIndex}][precio_unitario]"]`).value) || 0;
                const tipoImpuesto = input.value;
                const subtotal = cantidad * precio;

                if (tipoImpuesto === 'exonerado') {
                    importeExonerado += subtotal;
                } else if (tipoImpuesto === 'exento') {
                    importeExento += subtotal;
                } else if (tipoImpuesto === 'gravado15') {
                    importeGravado15 += subtotal;
                }
            });

            const isv15 = importeGravado15 * ISV_RATE;
            const total = importeExonerado + importeExento + importeGravado15 + isv15;

            document.getElementById('subtotalExoneradoLabel').textContent = importeExonerado.toFixed(2);
            document.getElementById('subtotalExentoLabel').textContent = importeExento.toFixed(2);
            document.getElementById('subtotalGravado15Label').textContent = importeGravado15.toFixed(2);
            document.getElementById('isv15Label').textContent = isv15.toFixed(2);
            granTotalLabel.textContent = total.toFixed(2);

            importeExoneradoInput.value = importeExonerado.toFixed(2);
            importeExentoInput.value = importeExento.toFixed(2);
            importeGravado15Input.value = importeGravado15.toFixed(2);
            isv15Input.value = isv15.toFixed(2);
            totalInput.value = total.toFixed(2);
        };

        const addProductRow = (productId, productName, productPrice, productQuantity, taxType, forceNew = false) => {
            if (!productId || !productPrice || !productQuantity) {
                alert('Error: Producto, precio o cantidad inválidos.');
                return false;
            }

            if (!forceNew) {
                const existingItem = itemsContainer.querySelector(`input[name$="[producto_id]"][value="${productId}"]`);
                if (existingItem) {
                    const existingRow = productosTableBody.querySelector(`tr[data-product-id="${productId}"]`);
                    if (existingRow) {
                        existingRow.style.backgroundColor = '#fff3cd';
                        setTimeout(() => existingRow.style.backgroundColor = '', 2000);
                    }
                    alert(`${productName} ya está en la factura.`);
                    return false;
                }
            }

            const productSubtotal = productPrice * productQuantity;

            const newRow = document.createElement('tr');
            newRow.dataset.productId = productId;
            newRow.dataset.itemIndex = itemIndex;
            newRow.innerHTML = `
            <td>${productName}</td>
            <td>
                <span class="badge ${taxType === 'exonerado' ? 'bg-info' : (taxType === 'exento' ? 'bg-secondary' : 'bg-success')}">
                    ${taxType === 'exonerado' ? 'Exonerado' : (taxType === 'exento' ? 'Exento' : 'Gravado 15%')}
                </span>
            </td>
            <td>${productQuantity}</td>
            <td>${productPrice.toFixed(2)}</td>
            <td>${productSubtotal.toFixed(2)}</td>
            <td><button type="button" class="btn btn-sm btn-danger remove-product"><i class="fas fa-minus-circle"></i></button></td>
        `;

            productosTableBody.appendChild(newRow);

            const hiddenInputsHTML = `
            <input type="hidden" name="items[${itemIndex}][producto_id]" value="${productId}" data-item-index="${itemIndex}">
            <input type="hidden" name="items[${itemIndex}][nombre_producto]" value="${productName}" data-item-index="${itemIndex}">
            <input type="hidden" name="items[${itemIndex}][tipo_impuesto]" value="${taxType}" data-item-index="${itemIndex}">
            <input type="hidden" name="items[${itemIndex}][cantidad]" value="${productQuantity}" data-item-index="${itemIndex}">
            <input type="hidden" name="items[${itemIndex}][precio_unitario]" value="${productPrice.toFixed(2)}" data-item-index="${itemIndex}">
        `;
            itemsContainer.insertAdjacentHTML('beforeend', hiddenInputsHTML);

            itemIndex++;
            actualizarTotales();
            return true;
        };

        const limpiarCalculosModal = () => {
            document.getElementById('calculoPrecioCompra').textContent = '0.00';
            document.getElementById('calculoPrecioVenta').textContent = '0.00';
            document.getElementById('calculoCantidad').textContent = '0';
            document.getElementById('calculoSubtotalCompraSinIsv').textContent = '0.00';
            document.getElementById('calculoIsv').textContent = '0.00';
            document.getElementById('calculoTotalCompraConIsv').textContent = '0.00';
            document.getElementById('calculoSubtotalVenta').textContent = '0.00';
            document.getElementById('calculoGanancia').textContent = '0.00';
        };

        const validarCampoDetalle = (inputElement) => {
            const value = parseFloat(inputElement.value);
            const max = 99999;
            const feedbackId = `${inputElement.id}-feedback`;

            inputElement.classList.remove('is-invalid');
            const oldFeedback = document.getElementById(feedbackId);
            if (oldFeedback) {
                oldFeedback.remove();
            }

            let isValid = true;
            let message = '';

            if (inputElement.id === 'cantidadDetalle') {
                const quantity = parseInt(inputElement.value, 10);
                if (isNaN(quantity) || quantity <= 0 || quantity > max || !Number.isInteger(quantity)) {
                    isValid = false;
                    message = `La cantidad debe ser un número entero entre 1 y ${max}.`;
                }
            } else { // Para precio de compra y precio de venta
                if (isNaN(value) || value <= 0 || value > max) {
                    isValid = false;
                    message = `El precio debe ser un número entre 0.01 y ${max}.`;
                }
            }

            if (!isValid) {
                inputElement.classList.add('is-invalid');
                const feedbackDiv = document.createElement('div');
                feedbackDiv.id = feedbackId;
                feedbackDiv.classList.add('invalid-feedback', 'd-block');
                feedbackDiv.textContent = message;
                inputElement.parentNode.appendChild(feedbackDiv);
            }
            return isValid;
        };

        // --- NUEVA FUNCIÓN PARA LIMPIAR EL MODAL ---
        const limpiarModalProductos = () => {
            // Ocultar el panel de detalles y mostrar la lista
            modalDetallesProducto.classList.add('d-none');
            modalListaProductos.classList.remove('d-none');

            // Limpiar el campo de búsqueda y la tabla de resultados
            productSearchInput.value = '';
            resultadosBusquedaProductos.classList.add('d-none');
            // Mostrar todas las filas de productos
            for (let i = 0; i < productRows.length; i++) {
                productRows[i].style.display = '';
            }

            // Limpiar la tabla de detalles del producto
            detalleProductoTablaBody.innerHTML = '';

            // Limpiar cálculos si los tienes en el modal
            limpiarCalculosModal();
        };


        // --- EVENT LISTENERS ---

        // Evento para el filtro de búsqueda del modal
        productSearchInput.addEventListener('keyup', function () {
            const filter = productSearchInput.value.toLowerCase();
            let count = 0;
            for (let i = 0; i < productRows.length; i++) {
                const productName = productRows[i].dataset.nombre.toLowerCase();
                if (productName.includes(filter)) {
                    productRows[i].style.display = '';
                    count++;
                } else {
                    productRows[i].style.display = 'none';
                }
            }

            if (filter.length > 0) {
                resultadosBusquedaProductos.textContent = `${count} resultado(s) encontrado(s).`;
                resultadosBusquedaProductos.classList.remove('d-none');
            } else {
                resultadosBusquedaProductos.classList.add('d-none');
            }
        });

        // Evento para el clic en el botón "Ver Detalles" del modal
        modalProductos.addEventListener('click', function (e) {
            if (e.target.classList.contains('verDetalles') || e.target.closest('.verDetalles')) {
                const fila = e.target.closest('tr');
                const producto = {
                    id: fila.dataset.productId,
                    nombre: fila.dataset.nombre,
                    impuesto: fila.dataset.impuesto,
                    precio_compra: parseFloat(fila.dataset.precioCompra),
                    precio_venta: parseFloat(fila.dataset.precioVenta),
                    cantidad: 1
                };

                modalListaProductos.classList.add('d-none');
                modalDetallesProducto.classList.remove('d-none');

                detalleProductoTablaBody.innerHTML = `
                <tr>
                    <td>${producto.id}</td>
                    <td>${producto.nombre}</td>
                    <td>
                        <span class="badge bg-success">Gravado 15%</span>
                    </td>
                    <td>
                        <input type="number" class="form-control" id="precioCompraDetalle" value="${producto.precio_compra.toFixed(2)}" step="0.01">
                    </td>
                    <td>
                        <input type="number" class="form-control" id="precioVentaDetalle" value="${producto.precio_venta.toFixed(2)}" step="0.01">
                    </td>
                    <td>
                        <input type="number" class="form-control" id="cantidadDetalle" value="${producto.cantidad}" min="1">
                    </td>
                </tr>
            `;
                btnAgregarConfirmar.dataset.productId = producto.id;
            }
        });

        // Evento para el botón "Volver"
        btnVolver.addEventListener('click', function() {
            limpiarModalProductos();
        });

        // Evento para el botón "Agregar a Factura"
        btnAgregarConfirmar.addEventListener('click', function() {
            const precioCompraInput = document.getElementById('precioCompraDetalle');
            const precioVentaInput = document.getElementById('precioVentaDetalle');
            const cantidadInput = document.getElementById('cantidadDetalle');

            const isPrecioCompraValid = validarCampoDetalle(precioCompraInput);
            const isPrecioVentaValid = validarCampoDetalle(precioVentaInput);
            const isCantidadValid = validarCampoDetalle(cantidadInput);

            if (!isPrecioCompraValid || !isPrecioVentaValid || !isCantidadValid) {
                return;
            }

            const productId = this.dataset.productId;
            const nombre = document.querySelector(`[data-product-id="${productId}"]`).dataset.nombre;
            const precioUnitario = parseFloat(precioCompraInput.value);
            const cantidad = parseInt(cantidadInput.value, 10);
            const tipoImpuesto = document.querySelector(`[data-product-id="${productId}"]`).dataset.impuesto;

            const agregado = addProductRow(productId, nombre, precioUnitario, cantidad, tipoImpuesto, false);
            if (agregado) {
                const modalInstance = bootstrap.Modal.getInstance(modalProductos) || new bootstrap.Modal(modalProductos);
                modalInstance.hide();
                limpiarModalProductos();
            }
        });

        // Evento para eliminar productos de la tabla principal de la factura
        productosTableBody.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-product') || event.target.closest('.remove-product')) {
                const row = event.target.closest('tr');
                const indexToRemove = row.dataset.itemIndex;
                itemsContainer.querySelectorAll(`input[data-item-index="${indexToRemove}"]`).forEach(input => input.remove());
                row.remove();
                actualizarTotales();
            }
        });

        // Evento para la búsqueda de proveedores
        let proveedorSearchTimeout = null;
        inputNombreEmpresa.addEventListener('input', function() {
            const query = this.value.trim();
            clearTimeout(proveedorSearchTimeout);
            listaProveedores.style.display = 'none';
            resultadosProveedor.textContent = '';
            inputProveedorId.value = '';

            if (query.length < 2) {
                return;
            }

            proveedorSearchTimeout = setTimeout(() => {
                fetch(`/api/buscar-proveedores?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        listaProveedores.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(proveedor => {
                                const item = document.createElement('button');
                                item.type = 'button';
                                item.classList.add('list-group-item', 'list-group-item-action');
                                item.textContent = proveedor.nombre_empresa;
                                item.setAttribute('data-id', proveedor.id);
                                item.addEventListener('click', function() {
                                    inputNombreEmpresa.value = this.textContent;
                                    inputProveedorId.value = this.getAttribute('data-id');
                                    listaProveedores.style.display = 'none';
                                    resultadosProveedor.textContent = `Proveedor seleccionado: ${this.textContent}`;
                                    inputNombreEmpresa.classList.remove('is-invalid');
                                });
                                listaProveedores.appendChild(item);
                            });
                            listaProveedores.style.display = 'block';
                            resultadosProveedor.textContent = `${data.length} resultado(s) encontrado(s).`;
                        } else {
                            resultadosProveedor.textContent = 'No se encontraron proveedores.';
                        }
                    });
            }, 300);
        });

        document.addEventListener('click', function(event) {
            if (!inputNombreEmpresa.contains(event.target) && !listaProveedores.contains(event.target)) {
                listaProveedores.style.display = 'none';
            }
        });

        // Evento para la validación del formulario de factura
        form.setAttribute('novalidate', true);
        form.addEventListener('submit', async function(e) {
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            let error = false;

            if (!inputProveedorId.value) {
                inputNombreEmpresa.classList.add('is-invalid');
                inputNombreEmpresa.insertAdjacentHTML('afterend', '<div class="invalid-feedback">Debe seleccionar un proveedor válido de la lista.</div>');
                error = true;
            }

            const numeroFacturaValue = numeroFactura.value;
            const esNumeroUnico = await validarUnicidadNumeroFactura(numeroFacturaValue);
            if (!esNumeroUnico) {
                error = true;
            }

            const fechaInput = document.getElementById('fecha');
            if (fechaInput && !fechaInput.value.trim()) {
                fechaInput.classList.add('is-invalid');
                fechaInput.insertAdjacentHTML('afterend', '<div class="invalid-feedback d-block">La fecha es obligatoria.</div>');
                error = true;
            }

            const filas = itemsContainer.querySelectorAll('input[name$="[cantidad]"]');
            if (filas.length === 0) {
                productosButtonsContainer.insertAdjacentHTML('afterend', '<div class="invalid-feedback d-block mt-2">Debe agregar al menos un producto a la factura.</div>');
                error = true;
            } else {
                filas.forEach(cantidadInput => {
                    const index = cantidadInput.name.match(/\[(\d+)\]/)[1];
                    const precioInput = itemsContainer.querySelector(`input[name="items[${index}][precio_unitario]"]`);

                    const cantidad = parseFloat(cantidadInput.value);
                    const precio = parseFloat(precioInput.value);

                    if (isNaN(cantidad) || cantidad <= 0 || isNaN(precio) || precio <= 0) {
                        error = true;
                    }
                });
            }

            if (error) {
                e.preventDefault();
            }
        });

        // Evento para limpiar el formulario de la factura
        btnLimpiarFactura.addEventListener('click', function() {
            form.reset();
            inputProveedorId.value = '';
            inputNombreEmpresa.value = '';
            numeroFactura.value = '';
            numeroFacturaDisplay.textContent = 'Generando...';
            resultadosProveedor.textContent = '';
            listaProveedores.innerHTML = '';
            listaProveedores.style.display = 'none';
            productosTableBody.innerHTML = '';
            itemsContainer.innerHTML = '';
            itemIndex = 0;
            productosTableWrapper.style.display = 'none';
            importeExoneradoInput.value = '0.00';
            importeExentoInput.value = '0.00';
            importeGravado15Input.value = '0.00';
            isv15Input.value = '0.00';
            totalInput.value = '0.00';
            document.getElementById('subtotalExoneradoLabel').textContent = '0.00';
            document.getElementById('subtotalExentoLabel').textContent = '0.00';
            document.getElementById('subtotalGravado15Label').textContent = '0.00';
            document.getElementById('isv15Label').textContent = '0.00';
            granTotalLabel.textContent = '0.00';
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            generarNumeroFacturaUnico();
            limpiarModalProductos();
        });

        // Evento para que cuando el modal se abra, se limpie
        modalProductos.addEventListener('show.bs.modal', function () {
            limpiarModalProductos();
        });


        // --- LÓGICA AL CARGAR LA PÁGINA ---
        @if(old('items'))
        const oldItems = @json(old('items'));
        oldItems.forEach(item => {
            const productId = item.producto_id ?? '';
            const productName = item.nombre_producto ?? 'Producto desconocido';
            const productPrice = parseFloat(item.precio_unitario) || 0;
            const productQuantity = parseInt(item.cantidad) || 0;
            const taxType = item.tipo_impuesto ?? 'gravado15';
            if (productId && productPrice > 0 && productQuantity > 0) {
                addProductRow(productId, productName, productPrice, productQuantity, taxType, true);
            }
        });
        @endif

        actualizarTotales();
        generarNumeroFacturaUnico();

    });
</script>
</body>
</html>
