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
                        <div class="col-md-6">
                            <label for="proveedor_nombre"><i class="fas fa-truck"></i> Buscar proveedor</label>
                            <input list="listaProveedores" id="proveedor_nombre" name="proveedor_nombre"
                                   class="form-control @error('proveedor_id') is-invalid @enderror"
                                   placeholder="Escriba para buscar..." autocomplete="off"
                                   value="{{ old('proveedor_nombre') }}" />
                            <datalist id="listaProveedores">
                                @foreach ($proveedores ?? [] as $proveedor)
                                    <option data-id="{{ $proveedor->id }}" value="{{ $proveedor->nombre_proveedor }}"></option>
                                @endforeach

                            </datalist>
                            <input type="hidden" name="proveedor_id" id="proveedor_id" value="{{ old('proveedor_id') }}">
                            <div class="form-text text-muted mt-1" id="resultadosProveedor">Se encontraron {{ count($proveedores) }} proveedores.</div>
                            @error('proveedor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="numero_factura"><i class="fas fa-file-alt"></i> Número de factura</label>
                            <input type="text" id="numero_factura" name="numero_factura" class="form-control @error('numero_factura') is-invalid @enderror"
                                   value="{{ old('numero_factura') }}" placeholder="Ej. ABC-123" maxlength="7" />
                            @error('numero_factura')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                    {{-- Product rows will be added here dynamically --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex gap-2 flex-wrap mt-2" id="productosButtonsContainer">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalProductos">
                                    <i class="fas fa-box-open"></i> Seleccionar de productos
                                </button>
                            </div>
                            {{-- Aquí se insertará el mensaje de error para productos --}}
                            @error('items')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" id="importe_exonerado" name="importe_exonerado" value="0" />
                        <input type="hidden" id="importe_exento" name="importe_exento" value="0" />
                        <input type="hidden" id="importe_gravado_15" name="importe_gravado_15" value="0" />
                        <input type="hidden" id="isv_15" name="isv_15" value="0" />

                        <div class="col-md-4">
                            <label><i class="fas fa-money-bill-wave"></i> Total de la Factura (L)</label>
                            <div class="form-control calculated-field"><span id="granTotalLabel">0.00</span></div>
                            <input type="hidden" id="gran_total" name="gran_total" value="0" />
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
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white" style="background: linear-gradient(135deg,#E4007C,#7B2A8D) !important;">
                <h5 class="modal-title" id="modalProductosLabel"><i class="fas fa-box"></i> Productos disponibles</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario (L)</th>
                        <th>Tipo Impuesto</th>
                        <th>Cantidad</th>
                        <th>Subtotal (L)</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="modalBodyProductos">
                    @foreach ($productos ?? [] as $producto)
                        <tr data-product-id="{{ $producto->id }}">
                            <td>{{ $producto->nombre }}</td>
                            <td class="precioUnitario" data-price="{{ $producto->precio }}">{{ number_format($producto->precio, 2) }}</td>
                            <td>
                                <select class="form-select tipoImpuestoModal">
                                    <option value="gravado15">Gravado 15%</option>
                                    <option value="exento">Exento</option>
                                    <option value="exonerado">Exonerado</option>
                                </select>
                            </td>
                            <td><input type="number" class="form-control cantidadModal" min="1" value="1" /></td>
                            <td class="subtotalModal">{{ number_format($producto->precio, 2) }}</td>
                            <td><button type="button" class="btn btn-sm btn-success agregarDesdeModal">
                                    <i class="fas fa-plus-circle"></i> Agregar
                                </button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('facturaForm');
        const productosTableBody = document.getElementById('productosTable').querySelector('tbody');
        const productosTableWrapper = document.getElementById('productosTableWrapper');
        const productosButtonsContainer = document.getElementById('productosButtonsContainer');
        const btnLimpiarFactura = document.getElementById('btnLimpiarFactura');

        const granTotalLabel = document.getElementById('granTotalLabel');

        const importeExoneradoInput = document.getElementById('importe_exonerado');
        const importeExentoInput = document.getElementById('importe_exento');
        const importeGravado15Input = document.getElementById('importe_gravado_15');
        const isv15Input = document.getElementById('isv_15');
        const granTotalInput = document.getElementById('gran_total');


        // Referencias a campos que validamos
        const inputProveedorNombre = document.getElementById('proveedor_nombre');
        const inputProveedorId = document.getElementById('proveedor_id');
        const numeroFactura = document.getElementById('numero_factura');
        const notas = document.getElementById('notas');

        let itemIndex = 0;
        const ISV_RATE = 0.15; // 15% ISV rate

        // --- Funciones para el número de factura (LLL-NNN) ---
        const formatNumeroFactura = (value) => {
            let formattedValue = '';
            let lettersPart = '';
            let numbersPart = '';
            let guionFound = false;

            const cleanedValue = value.replace(/[^a-zA-Z0-9-]/g, ''); // Remove all invalid chars first

            for (let i = 0; i < cleanedValue.length; i++) {
                const char = cleanedValue[i];
                if (/[a-zA-Z]/.test(char) && lettersPart.length < 3 && !guionFound) {
                    lettersPart += char.toUpperCase();
                } else if (char === '-' && !guionFound) {
                    guionFound = true;
                } else if (/\d/.test(char) && numbersPart.length < 3 && guionFound) {
                    numbersPart += char;
                } else if (/\d/.test(char) && lettersPart.length < 3 && !guionFound) {
                    // This case handles if user types "123" first, we discard it
                }
            }

            formattedValue = lettersPart;

            if (lettersPart.length === 3) {
                formattedValue += '-';
            }

            formattedValue += numbersPart;

            // Ensure hyphen is in correct place (after 3 letters)
            if (formattedValue.length > 3 && formattedValue[3] !== '-') {
                formattedValue = formattedValue.substring(0, 3) + '-' + formattedValue.substring(3).replace('-', '');
            }

            return formattedValue.substring(0, 7); // Max LLL-NNN is 7 characters
        };


        // Función para validar el formato LLL-NNN
        const validateNumeroFactura = (showErrors = false) => {
            const value = numeroFactura.value.trim();
            const feedbackElement = numeroFactura.nextElementSibling;
            const requiredMessage = 'El número de factura es obligatorio.';
            const formatMessage = 'El formato debe ser LLL-NNN (ej. ABC-123).';
            const required = numeroFactura.nextElementSibling;
            const uniqueMessage = 'Este número de factura ya existe.';

            // Clear previous feedback specific to format
            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                // Only remove if it's not the 'unique' message from previous check
                if (!feedbackElement.dataset.uniqueCheck) {
                    feedbackElement.remove();
                }
            }
            numeroFactura.classList.remove('is-invalid');

            if (value === '') {
                if (showErrors) {
                    numeroFactura.classList.add('is-invalid');
                    numeroFactura.insertAdjacentHTML('afterend', `<div class="invalid-feedback">${requiredMessage}</div>`);
                }
                return false;
            } else {
                // Regex: 3 letras (case-insensitive) - 3 dígitos
                const isValidFormat = /^[A-Z]{3}-\d{3}$/.test(value);
                if (!isValidFormat) {
                    if (showErrors) {
                        numeroFactura.classList.add('is-invalid');
                        numeroFactura.insertAdjacentHTML('afterend', `<div class="invalid-feedback">${formatMessage}</div>`);
                    }
                    return false;
                }
            }
            return true;
        };

        numeroFactura.addEventListener('input', async function() { // Agregamos 'async' aquí
            const cursorPosition = this.selectionStart;
            const originalValue = this.value;
            const formattedValue = formatNumeroFactura(originalValue);

            this.value = formattedValue;

            // Ajusta la posición del cursor, solo si es necesario para mantener la UX
            if (originalValue.length < 3 && formattedValue.length === 3) {
                this.setSelectionRange(4, 4);
            } else if (originalValue.length === 3 && formattedValue.length === 4 && formattedValue[3] === '-') {
                this.setSelectionRange(4, 4);
            } else {
                this.setSelectionRange(cursorPosition, cursorPosition);
            }


            // Validar formato en tiempo real
            const isFormatValid = validateNumeroFactura(true);

            // Si el formato es válido, verificar unicidad
            if (isFormatValid) {
                await checkNumeroFacturaUnico(formattedValue, true); // Agregamos 'await' aquí
            }
        });


        function actualizarTotales() {
            let importeExonerado = 0;
            let importeExento = 0;
            let importeGravado15 = 0;

            const rows = productosTableBody.querySelectorAll('tr');

            if (rows.length > 0) {
                productosTableWrapper.style.display = 'block';
            } else {
                productosTableWrapper.style.display = 'none';
            }

            rows.forEach(row => {
                const cantidadInput = row.querySelector('.cantidad');
                const precioInput = row.querySelector('.precio_unitario');
                const tipoImpuestoInput = row.querySelector('input[name^="items"][name$="[tipo_impuesto]"]'); // Get hidden input for tax type
                const subtotalInput = row.querySelector('.subtotal');

                const cantidad = parseFloat(cantidadInput.value) || 0;
                const precio = parseFloat(precioInput.value) || 0;
                const tipoImpuesto = tipoImpuestoInput ? tipoImpuestoInput.value : 'gravado15'; // Default to gravado15

                const subtotal = cantidad * precio;
                subtotalInput.value = subtotal.toFixed(2);

                if (tipoImpuesto === 'exonerado') {
                    importeExonerado += subtotal;
                } else if (tipoImpuesto === 'exento') {
                    importeExento += subtotal;
                } else if (tipoImpuesto === 'gravado15') {
                    importeGravado15 += subtotal;
                }
            });

            const isv15 = importeGravado15 * ISV_RATE;
            const granTotal = importeExonerado + importeExento + importeGravado15 + isv15;

            granTotalLabel.textContent = granTotal.toFixed(2);

            // Update hidden inputs for submission
            importeExoneradoInput.value = importeExonerado.toFixed(2);
            importeExentoInput.value = importeExento.toFixed(2);
            importeGravado15Input.value = importeGravado15.toFixed(2);
            isv15Input.value = isv15.toFixed(2);
            granTotalInput.value = granTotal.toFixed(2);
        }

        // Modified addProductRow to include tax type
        function addProductRow(productId, productName, productPrice, productQuantity, taxType, forceNew = false) {
            if (!productId) {
                alert('Error: Producto inválido sin ID.');
                return false;
            }

            if (!forceNew) {
                let existingRow = null;
                productosTableBody.querySelectorAll('tr').forEach(row => {
                    const idInput = row.querySelector('input[name^="items"][name$="[producto_id]"]');
                    if (idInput && idInput.value == productId) {
                        existingRow = row;
                    }
                });

                if (existingRow) {
                    existingRow.style.backgroundColor = '#fff3cd';
                    existingRow.style.border = '2px solid #ffeaa7';

                    const productNameElement = existingRow.querySelector('input[name^="items"][name$="[nombre_producto]"]');
                    const existingName = productNameElement ? productNameElement.value : 'Este producto';

                    alert(`${existingName} ya está en la factura.`);

                    setTimeout(() => {
                        existingRow.style.backgroundColor = '';
                        existingRow.style.border = '';
                    }, 2000);

                    return false;
                }
            }

            const productSubtotal = productPrice * productQuantity;
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <input type="hidden" name="items[${itemIndex}][producto_id]" value="${productId}" />
                    <input type="text" name="items[${itemIndex}][nombre_producto]" class="form-control" value="${productName}" readonly />
                </td>
                <td>
                    <input type="hidden" name="items[${itemIndex}][tipo_impuesto]" value="${taxType}" />
                    <span class="badge ${taxType === 'exonerado' ? 'bg-info' : (taxType === 'exento' ? 'bg-secondary' : 'bg-success')}">
                        ${taxType === 'exonerado' ? 'Exonerado' : (taxType === 'exento' ? 'Exento' : 'Gravado 15%')}
                    </span>
                </td>
                <td><input type="number" name="items[${itemIndex}][cantidad]" class="form-control cantidad" value="${productQuantity}" min="1" required /></td>
                <td><input type="number" name="items[${itemIndex}][precio_unitario]" class="form-control precio_unitario" value="${productPrice.toFixed(2)}" step="0.01" required /></td>
                <td><input type="text" name="items[${itemIndex}][subtotal]" class="form-control subtotal" value="${productSubtotal.toFixed(2)}" readonly /></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-product"><i class="fas fa-minus-circle"></i></button></td>
            `;

            productosTableBody.appendChild(newRow);

            itemIndex++;

            actualizarTotales();

            return true;
        }


        inputProveedorNombre.addEventListener('input', function() {
            const val = this.value;
            const dataList = document.getElementById('listaProveedores');
            let found = false;
            let selectedId = '';

            for (const option of dataList.options) {
                if (option.value === val) {
                    selectedId = option.dataset.id;
                    found = true;
                    break;
                }
            }
            if (found) {
                inputProveedorId.value = selectedId;
                inputProveedorNombre.classList.remove('is-invalid');
                const existingFeedback = inputProveedorNombre.nextElementSibling;
                if (existingFeedback && existingFeedback.classList.contains('invalid-feedback')) {
                    existingFeedback.remove();
                }
            } else {
                inputProveedorId.value = '';
            }
        });

        document.getElementById('modalProductos').addEventListener('click', function (e) {
            if (e.target.classList.contains('agregarDesdeModal')) {
                const fila = e.target.closest('tr');
                const productId = fila.dataset.productId.trim();
                const nombre = fila.cells[0].textContent.trim();
                const precioUnitario = parseFloat(fila.querySelector('.precioUnitario').dataset.price);
                const cantidad = parseFloat(fila.querySelector('.cantidadModal').value);
                const tipoImpuesto = fila.querySelector('.tipoImpuestoModal').value; // Get selected tax type

                if (isNaN(cantidad) || cantidad <= 0) {
                    alert('Por favor, ingresa una cantidad válida.');
                    return;
                }

                const agregado = addProductRow(productId, nombre, precioUnitario, cantidad, tipoImpuesto, false);

                if (agregado) {
                    alert(`${nombre} agregado correctamente a la factura.`);
                    // Asumiendo que usas Bootstrap 5, la forma correcta de ocultar el modal es así:
                    const modalElement = document.getElementById('modalProductos');
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (modalInstance) {
                        modalInstance.hide();
                    } else {
                        // Si la instancia no existe (ej. el modal no fue inicializado por JS), créala y ocúltala
                        const newModalInstance = new bootstrap.Modal(modalElement);
                        newModalInstance.hide();
                    }
                }
            }
        });

        productosTableBody.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-product') || event.target.closest('.remove-product')) {
                const row = event.target.closest('tr');
                const productName = row.querySelector('input[name^="items"][name$="[nombre_producto]"]').value;

                row.remove();
                actualizarTotales();

                alert(`${productName} eliminado de la factura.`);
            }
        });

        // --- INICIO DE CORRECCIÓN: Definición correcta de inputElement ---
        productosTableBody.addEventListener('input', function(event) {
            const inputElement = event.target; // ¡CORREGIDO! Aquí se define inputElement
            const value = parseFloat(inputElement.value);
            let isValid = true;
            let errorMessage = '';

            // Limpiar feedback de error previo para este input
            const existingFeedback = inputElement.nextElementSibling;
            if (existingFeedback && existingFeedback.classList.contains('invalid-feedback')) {
                existingFeedback.remove();
            }
            inputElement.classList.remove('is-invalid');

            if (inputElement.classList.contains('cantidad')) {
                // Validar si es un número entero entre 1 y 99,999
                if (isNaN(value) || value < 1 || value > 99999 || !Number.isInteger(value)) {
                    isValid = false;
                    errorMessage = 'La cantidad debe ser un número entero entre 1 y 99,999.';
                }
            } else if (inputElement.classList.contains('precio_unitario')) {
                // Validar formato con regex para hasta 2 decimales y rango
                const regex = /^\d{1,5}(\.\d{1,2})?$/;
                if (!regex.test(inputElement.value) || isNaN(value) || value < 0.01 || value > 99999.99) {
                    isValid = false;
                    errorMessage = 'El precio unitario debe ser un número entre 0.01 y 99,999.99, con hasta 2 decimales.';
                }
            }

            if (!isValid) {
                inputElement.classList.add('is-invalid');
                inputElement.insertAdjacentHTML('afterend', `<div class="invalid-feedback d-block">${errorMessage}</div>`);
            }

            actualizarTotales();
        });

        productosTableBody.innerHTML = '';
        @if(old('items'))
        const oldItems = @json(old('items'));
        oldItems.forEach(item => {
            const productId = item.producto_id ?? '';
            const productName = item.nombre_producto ?? item.nombre_producto_manual ?? 'Producto desconocido';
            const productPrice = parseFloat(item.precio_unitario) || 0;
            const productQuantity = parseInt(item.cantidad) || 0;
            const taxType = item.tipo_impuesto ?? 'gravado15'; // Retrieve old tax type

            if (productId && productPrice > 0 && productQuantity > 0) {
                addProductRow(productId, productName, productPrice, productQuantity, taxType, true);
            }
        });
        @endif

        actualizarTotales();

        if (productosTableBody.querySelectorAll('tr').length > 0) {
            productosTableWrapper.style.display = 'block';
        }

        form.setAttribute('novalidate', true);

        // --- Modificación del event listener del submit del formulario para incluir validación asíncrona ---
        form.addEventListener('submit', async function(e) { // Agregamos 'async' aquí
            // Limpiar errores previos de todo el formulario
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

            let error = false; // Variable para rastrear si hay algún error

            // Validar proveedor
            if (!inputProveedorNombre.value.trim() || !inputProveedorId.value) {
                inputProveedorNombre.classList.add('is-invalid');
                inputProveedorNombre.insertAdjacentHTML('afterend', '<div class="invalid-feedback">Debe seleccionar un proveedor válido de la lista.</div>');
                error = true;
            }

            // Validar número de factura (formato y unicidad)
            const isFormatValid = validateNumeroFactura(true);
            // Esperar la verificación de unicidad
            const isNumeroUnique = await checkNumeroFacturaUnico(numeroFactura.value, true);

            if (!isFormatValid || !isNumeroUnique) {
                error = true;
            }


            // Validar productos agregados y sus valores
            const filas = productosTableBody.querySelectorAll('tr');
            if (filas.length === 0) {
                productosButtonsContainer.insertAdjacentHTML('afterend', '<div class="invalid-feedback d-block mt-2">Debe agregar al menos un producto a la factura.</div>');
                error = true;
            } else {
                filas.forEach(row => {
                    const cantidadInput = row.querySelector('.cantidad');
                    const precioInput = row.querySelector('.precio_unitario');

                    const cantidad = parseFloat(cantidadInput.value);
                    const precio = parseFloat(precioInput.value);

                    // Validar Cantidad
                    if (isNaN(cantidad) || cantidad <= 0 || !Number.isInteger(cantidad) || cantidad > 99999) {
                        cantidadInput.classList.add('is-invalid');
                        cantidadInput.insertAdjacentHTML('afterend', '<div class="invalid-feedback d-block">La cantidad debe ser un número entero positivo entre 1 y 99,999.</div>');
                        error = true;
                    }

                    // Validar Precio Unitario
                    const regexPrecio = /^\d{1,5}(\.\d{1,2})?$/;
                    if (!regexPrecio.test(precioInput.value) || isNaN(precio) || precio <= 0 || precio > 99999.99) {
                        precioInput.classList.add('is-invalid');
                        precioInput.insertAdjacentHTML('afterend', '<div class="invalid-feedback d-block">El precio unitario debe ser un número positivo entre 0.01 y 99,999.99, con hasta 2 decimales.</div>');
                        error = true;
                    }
                });
            }

            // Si hay algún error, prevenir el envío del formulario
            if (error) {
                e.preventDefault();
            }
            // Si no hay errores, el formulario se enviará de forma natural
        });
        // --- Fin de modificación del submit ---

        // Initialize validation state on load for numero_factura if old data exists
        if (numeroFactura.value.trim() !== '') {
            numeroFactura.value = formatNumeroFactura(numeroFactura.value); // Re-format old value on load
            validateNumeroFactura(); // Validate on load to show initial state
        }

        // --- Event Listener para el botón "Limpiar" ---
        // --- INICIO DE CORRECCIÓN: Cierre correcto de la función ---
        btnLimpiarFactura.addEventListener('click', function() {
            form.reset(); // Restablece todos los campos del formulario

            // Limpiar campos ocultos y específicos
            inputProveedorId.value = '';
            numeroFactura.value = ''; // Asegura que el número de factura se limpie completamente

            // Eliminar todas las filas de productos de la tabla
            productosTableBody.innerHTML = '';
            itemIndex = 0; // Resetear el índice de los ítems

            // Ocultar la tabla de productos
            productosTableWrapper.style.display = 'none';

            // Resetear y actualizar los totales calculados (los inputs ocultos)
            importeExoneradoInput.value = '0.00';
            importeExentoInput.value = '0.00';
            importeGravado15Input.value = '0.00';
            isv15Input.value = '0.00';
            granTotalInput.value = '0.00';

            // Resetear solo el label del Gran Total que es visible
            granTotalLabel.textContent = '0.00';

            // Limpiar cualquier mensaje de error visible
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

        }); // ¡CORREGIDO! Cierre de la función y addEventListener
        // --- FIN DE CORRECCIÓN ---

        // --- Inicio: Código para actualizar el subtotal en el MODAL ---
        const modalBodyProductos = document.getElementById('modalBodyProductos');

        modalBodyProductos.addEventListener('input', function(e) {
            const target = e.target;
            if (target.classList.contains('cantidadModal')) {
                const row = target.closest('tr');
                const precioUnitarioElement = row.querySelector('.precioUnitario');
                const subtotalModalElement = row.querySelector('.subtotalModal');

                const cantidad = parseFloat(target.value) || 0;
                const precio = parseFloat(precioUnitarioElement.dataset.price) || 0;

                const subtotal = cantidad * precio;
                subtotalModalElement.textContent = subtotal.toFixed(2);
            }
        });
        // Dentro de numeroFactura.addEventListener('input', ...
        numeroFactura.addEventListener('input', async function() {
            console.log('Input en numeroFactura detectado. Valor:', this.value);
            const formattedValue = formatNumeroFactura(this.value);
            this.value = formattedValue;

            const isFormatValid = validateNumeroFactura(true);
            console.log('Formato de factura válido:', isFormatValid);

            if (isFormatValid) {
                console.log('Verificando unicidad para:', formattedValue);
                const isNumeroUnique = await checkNumeroFacturaUnico(formattedValue, true);
                console.log('Resultado de unicidad:', isNumeroUnique); // ¿Es true o false?
            }
        });

// Dentro de checkNumeroFacturaUnico
        const checkNumeroFacturaUnico = async (numero, showErrors = false) => {
            console.log('Llamando a checkNumeroFacturaUnico con:', numero);
            const feedbackElement = numeroFactura.nextElementSibling;

            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback') && feedbackElement.dataset.uniqueCheck) {
                feedbackElement.remove();
            }
            if (!numeroFactura.classList.contains('is-invalid')) {
                numeroFactura.classList.remove('is-invalid');
            }

            if (numero.length === 7 && /^[A-Z]{3}-\d{3}$/.test(numero)) {
                try {
                    // Asegúrate de que esta URL es correcta en el entorno de producción/local
                    const url = `{{ route('facturas.checkUniqueNumeroFactura') }}?numero_factura=${numero}`;
                    console.log('URL de la solicitud AJAX:', url);
                    const response = await fetch(url);
                    console.log('Respuesta de la API (raw):', response);

                    if (!response.ok) { // Verifica si la respuesta HTTP es exitosa (código 200-299)
                        console.error('Error HTTP:', response.status, response.statusText);
                        return true; // Asume único para no bloquear el envío si hay error de red/servidor
                    }

                    const data = await response.json();
                    console.log('Datos de la API (JSON):', data); // ¿Qué valor tiene data.is_unique?

                    if (!data.is_unique) {
                        console.log('Número de factura NO es único. Mostrando error.');
                        if (showErrors) {
                            numeroFactura.classList.add('is-invalid');
                            const div = document.createElement('div');
                            div.classList.add('invalid-feedback');
                            div.textContent = 'Este número de factura ya existe.';
                            div.dataset.uniqueCheck = 'true';
                            numeroFactura.insertAdjacentElement('afterend', div);
                        }
                        return false;
                    } else {
                        console.log('Número de factura SÍ es único.');
                    }
                } catch (error) {
                    console.error('Error al verificar unicidad del número de factura:', error);
                    // Aquí puedes decidir si quieres que esto bloquee el envío o no.
                    // Para depurar, es mejor que no bloquee para ver si el resto del formulario se envía.
                }
            }
            return true;
        };
    });
</script>
</body>
</html>
