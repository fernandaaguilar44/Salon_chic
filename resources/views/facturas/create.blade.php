
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

{{-- Tu código para el modal no cambia --}}
<div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalProductosLabel">Seleccionar Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Cantidad</th>
                                    <th>Agregar</th>
                                </tr>
                                </thead>
                                <tbody id="modalBodyProductos">
                                @foreach ($productos as $index => $producto)
                                    <tr data-product-id="{{ $producto->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $producto->nombre }}
                                            <input type="hidden" class="tipoImpuestoModal" value="gravado15">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control precioUnitario" value="{{ $producto->precio_compra }}" step="0.01" data-price="{{ $producto->precio_compra }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control precioVenta" value="{{ $producto->precio_venta }}" step="0.01">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control cantidadModal" value="1" min="1">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success agregarDesdeModal">
                                                <i class="fas fa-plus"></i> Agregar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header bg-gradient-pink-purple text-white">
                            </div>
                            <div class="card-body">
                                <p><strong>Precio Compra:</strong> L. <span id="calculoPrecioCompra">0.00</span></p>
                                <p><strong>Precio Venta:</strong> L. <span id="calculoPrecioVenta">0.00</span></p>
                                <p><strong>Cantidad:</strong> <span id="calculoCantidad">0</span></p>
                                <p><strong>Subtotal Compra (sin ISV):</strong> L. <span id="calculoSubtotalCompraSinIsv">0.00</span></p>
                                <p><strong>ISV Estimado (15%):</strong> L. <span id="calculoIsv">0.00</span></p>
                                <p><strong>Total Compra (con ISV):</strong> L. <span id="calculoTotalCompraConIsv">0.00</span></p>
                                <p><strong>Subtotal Venta:</strong> L. <span id="calculoSubtotalVenta">0.00</span></p>
                                <p><strong>Ganancia Estimada:</strong> L. <span id="calculoGanancia">0.00</span></p>
                            </div>
                        </div>
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
            const form = document.getElementById('facturaForm');
            const productosTableBody = document.getElementById('productosTable').querySelector('tbody');
            const productosTableWrapper = document.getElementById('productosTableWrapper');
            const productosButtonsContainer = document.getElementById('productosButtonsContainer');
            const btnLimpiarFactura = document.getElementById('btnLimpiarFactura');
            const granTotalLabel = document.getElementById('granTotalLabel');
            const numeroFacturaDisplay = document.getElementById('numero_factura_display');
            const listaProveedores = document.getElementById('listaProveedores');
            const resultadosProveedor = document.getElementById('resultadosProveedor');
            const modalProductos = document.getElementById('modalProductos');
            const modalBodyProductos = document.getElementById('modalBodyProductos');

            // CORRECCIÓN: Agregamos la referencia al nuevo contenedor de ítems
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

            let itemIndex = 0;
            const ISV_RATE = 0.15;

            // --- Función para generar un número de factura único ---
            const generateUniqueNumeroFactura = async () => {
                const generateRandomNumber = () => {
                    const prefix = '000-001-01-0-';
                    let uniquePart = '';
                    for (let i = 0; i < 7; i++) {
                        uniquePart += Math.floor(Math.random() * 10);
                    }
                    return prefix + uniquePart;
                };

                let isUnique = false;
                let newNumeroFactura;

                while (!isUnique) {
                    newNumeroFactura = generateRandomNumber();
                    const url = "{{ route('facturas.checkUniqueNumeroFactura') }}";
                    try {
                        const response = await fetch(url + '?numero_factura=' + newNumeroFactura);
                        const data = await response.json();
                        if (data.is_unique) {
                            isUnique = true;
                        }
                    } catch (error) {
                        console.error('Error al verificar unicidad:', error);
                        break;
                    }
                }

                numeroFactura.value = newNumeroFactura;
                numeroFacturaDisplay.textContent = newNumeroFactura;
            };

            // --- Funciones de validación ---
            const validateNumeroFactura = () => {
                const value = numeroFactura.value.trim();
                const isValidFormat = /^000-001-01-0-\d{7}$/.test(value);
                return value !== '' && isValidFormat;
            };

            const checkNumeroFacturaUnico = async (numero) => {
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

            // --- Funciones para manejar la tabla de productos y los totales ---
            const actualizarTotales = () => {
                let importeExonerado = 0;
                let importeExento = 0;
                let importeGravado15 = 0;

                // CORRECCIÓN: Obtener los inputs del contenedor oculto
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
                    // CORRECCIÓN: Ahora buscamos en los inputs ocultos para evitar duplicados
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

                // Creamos la fila visible en la tabla
                const newRow = document.createElement('tr');
                newRow.dataset.productId = productId; // Usamos el ID para fácil referencia
                newRow.dataset.itemIndex = itemIndex; // Asignamos un índice para eliminar
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

                // CORRECCIÓN: Creamos los inputs ocultos y los agregamos al contenedor oculto
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

            // --- Event listeners para el formulario y la tabla ---
            productosTableBody.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-product') || event.target.closest('.remove-product')) {
                    const row = event.target.closest('tr');
                    const indexToRemove = row.dataset.itemIndex;

                    // CORRECCIÓN: Eliminar los inputs ocultos correspondientes
                    itemsContainer.querySelectorAll(`input[data-item-index="${indexToRemove}"]`).forEach(input => input.remove());

                    // Eliminar la fila visual de la tabla
                    row.remove();

                    actualizarTotales();
                }
            });

            // NOTA: Los listeners de 'input' en la tabla ya no son necesarios
            // porque los campos de cantidad y precio ahora son estáticos en la tabla visible.
            // Si necesitas editarlos, deberías modificar addProductRow y reintroducir la lógica.

            let timeoutModal;
            const validarCampoModal = (inputElement) => {
                inputElement.classList.remove('is-invalid');
                const feedback = inputElement.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) feedback.remove();
                let isValid = true;
                const value = parseFloat(inputElement.value);
                if (inputElement.classList.contains('precioUnitario') || inputElement.classList.contains('precioVenta')) {
                    if (isNaN(value) || value <= 0 || value > 99999) {
                        isValid = false;
                        inputElement.insertAdjacentHTML('afterend', '<div class="invalid-feedback">El precio debe ser un número entre 0.01 y 99,999.</div>');
                    }
                } else if (inputElement.classList.contains('cantidadModal')) {
                    if (isNaN(value) || value <= 0 || value > 99999 || !Number.isInteger(value)) {
                        isValid = false;
                        inputElement.insertAdjacentHTML('afterend', '<div class="invalid-feedback">La cantidad debe ser un entero entre 1 y 99,999.</div>');
                    }
                }
                if (!isValid) {
                    inputElement.classList.add('is-invalid');
                }
                return isValid;
            };

            const validarFilaCompletaModal = (row) => {
                const precioCompraInput = row.querySelector('.precioUnitario');
                const precioVentaInput = row.querySelector('.precioVenta');
                const cantidadInput = row.querySelector('.cantidadModal');
                let isValid = true;
                if (!validarCampoModal(precioCompraInput)) isValid = false;
                if (!validarCampoModal(precioVentaInput)) isValid = false;
                if (!validarCampoModal(cantidadInput)) isValid = false;
                return isValid;
            };

            modalBodyProductos.addEventListener('input', function (e) {
                const target = e.target;
                const row = target.closest('tr');
                if (!row) return;
                clearTimeout(timeoutModal);
                timeoutModal = setTimeout(() => {
                    const allInputsValid = validarCampoModal(target);
                    if (!allInputsValid) {
                        document.getElementById('calculoPrecioCompra').textContent = '0.00';
                        document.getElementById('calculoPrecioVenta').textContent = '0.00';
                        document.getElementById('calculoCantidad').textContent = '0';
                        document.getElementById('calculoSubtotalCompraSinIsv').textContent = '0.00';
                        document.getElementById('calculoIsv').textContent = '0.00';
                        document.getElementById('calculoTotalCompraConIsv').textContent = '0.00';
                        document.getElementById('calculoSubtotalVenta').textContent = '0.00';
                        document.getElementById('calculoGanancia').textContent = '0.00';
                        return;
                    }
                    const precioCompra = parseFloat(row.querySelector('.precioUnitario').value);
                    const precioVenta = parseFloat(row.querySelector('.precioVenta').value);
                    const cantidad = parseInt(row.querySelector('.cantidadModal').value, 10);
                    const tipoImpuesto = row.querySelector('.tipoImpuestoModal').value;
                    const subtotalCompraSinImpuesto = precioCompra * cantidad;
                    let isv = 0;
                    if (tipoImpuesto === 'gravado15') {
                        isv = subtotalCompraSinImpuesto * ISV_RATE;
                    }
                    const totalCompraConIsv = subtotalCompraSinImpuesto + isv;
                    const subtotalVenta = precioVenta * cantidad;
                    const ganancia = subtotalVenta - totalCompraConIsv;
                    document.getElementById('calculoPrecioCompra').textContent = precioCompra.toFixed(2);
                    document.getElementById('calculoPrecioVenta').textContent = precioVenta.toFixed(2);
                    document.getElementById('calculoCantidad').textContent = cantidad;
                    document.getElementById('calculoSubtotalCompraSinIsv').textContent = subtotalCompraSinImpuesto.toFixed(2);
                    document.getElementById('calculoIsv').textContent = isv.toFixed(2);
                    document.getElementById('calculoTotalCompraConIsv').textContent = totalCompraConIsv.toFixed(2);
                    document.getElementById('calculoSubtotalVenta').textContent = subtotalVenta.toFixed(2);
                    document.getElementById('calculoGanancia').textContent = ganancia.toFixed(2);
                }, 300);
            });

            modalProductos.addEventListener('click', function (e) {
                if (e.target.classList.contains('agregarDesdeModal')) {
                    const fila = e.target.closest('tr');
                    if (!fila) {
                        console.error("Error: No se encontró la fila del producto.");
                        return;
                    }
                    if (!validarFilaCompletaModal(fila)) {
                        alert('Por favor, corrija los errores en los campos antes de agregar el producto.');
                        return;
                    }
                    const productId = fila.dataset.productId ? fila.dataset.productId.trim() : null;
                    const nombre = fila.cells[1].textContent.trim(); // CORRECCIÓN: El nombre está en la segunda celda (índice 1)
                    const precioUnitario = parseFloat(fila.querySelector('.precioUnitario').value);
                    const cantidad = parseInt(fila.querySelector('.cantidadModal').value, 10);
                    const tipoImpuesto = fila.querySelector('.tipoImpuestoModal').value;
                    if (!productId || !precioUnitario || !cantidad || !tipoImpuesto) {
                        console.error("Error: Faltan elementos clave para agregar el producto.");
                        return;
                    }
                    const agregado = addProductRow(productId, nombre, precioUnitario, cantidad, tipoImpuesto, false);
                    if (agregado) {
                        const modalInstance = bootstrap.Modal.getInstance(modalProductos) || new bootstrap.Modal(modalProductos);
                        modalInstance.hide();
                    }
                }
            });

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

            modalProductos.addEventListener('show.bs.modal', function () {
                limpiarCalculosModal();
            });

            // --- Búsqueda de proveedores ---
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

            // --- Lógica al cargar la página ---
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
            generateUniqueNumeroFactura();

            // --- Envío y validación del formulario ---
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
                const isNumeroUnique = await checkNumeroFacturaUnico(numeroFacturaValue);
                if (!isNumeroUnique) {
                    error = true;
                }

                // Verificación del campo 'fecha'
                const fechaInput = document.getElementById('fecha');
                if (fechaInput && !fechaInput.value.trim()) {
                    fechaInput.classList.add('is-invalid');
                    fechaInput.insertAdjacentHTML('afterend', '<div class="invalid-feedback d-block">La fecha es obligatoria.</div>');
                    error = true;
                }

                // CORRECCIÓN: Validamos los inputs ocultos
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

                        // La validación del frontend aquí es más complicada al ser inputs ocultos,
                        // por eso el controlador es el que realmente debe validar.
                        // Aquí solo se valida si existen.
                        if (isNaN(cantidad) || cantidad <= 0 || isNaN(precio) || precio <= 0) {
                            error = true;
                        }
                    });
                }

                if (error) {
                    e.preventDefault();
                }
            });

            // --- Limpiar formulario completo ---
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
                itemsContainer.innerHTML = ''; // CORRECCIÓN: Limpiamos también el contenedor oculto
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

                generateUniqueNumeroFactura();
            });
        });
    </script>
</body>
</html>
