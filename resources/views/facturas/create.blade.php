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
    </style>
</head>
<body>

<div class="form-container">
    <h2><i class="fas fa-file-invoice-dollar"></i> Registrar factura de compra</h2>

    <form id="facturaForm" method="POST" action="{{ route('facturas.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="proveedor_nombre"><i class="fas fa-truck"></i> Buscar proveedor</label>
                <input list="listaProveedores" id="proveedor_nombre" name="proveedor_nombre"
                       class="form-control @error('proveedor_id') is-invalid @enderror"
                       placeholder="Escriba para buscar..." autocomplete="off"
                       value="{{ old('proveedor_nombre') }}" />
                <datalist id="listaProveedores">
                    @foreach ($proveedores as $proveedor)
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
                <table class="table table-bordered bg-white text-center align-middle" id="productosTable" style="display: none;">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th><th>Cantidad</th><th>Precio Unitario (L)</th><th>Subtotal (L)</th><th style="width:50px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" name="producto[]" class="form-control" required /></td>
                        <td><input type="number" name="cantidad[]" class="form-control cantidad" min="1" required /></td>
                        <td><input type="number" name="precio_unitario[]" class="form-control precio" step="0.01" required /></td>
                        <td><input type="text" name="subtotal[]" class="form-control subtotal" readonly /></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <div class="d-flex gap-2 flex-wrap">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalProductos">
                        <i class="fas fa-box-open"></i> Seleccionar de productos
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <label><i class="fas fa-calculator"></i> Total de la factura (L)</label>
                <div class="form-control" style="background-color:#e9ecef; color:#333; border:none; user-select:none; cursor: default;">
                    <span id="totalLabel">0.00</span>
                </div>
                <input type="hidden" id="total" name="total" value="0" />
                @error('total')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label for="notas"><i class="fas fa-align-left"></i> Notas / Comentarios</label>
                <textarea id="notas" name="notas" rows="3" maxlength="200" class="form-control">{{ old('notas') }}</textarea>
            </div>
        </div>

        <div class="btn-group-left">
            <a href="{{ route('facturas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            <button type="reset" class="btn btn-danger" id="btnLimpiarFactura"><i class="fas fa-eraser"></i> Limpiar</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </form>
</div>
<!-- Modal de productos registrados -->
<div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title" id="modalProductosLabel"><i class="fas fa-box"></i> Productos disponibles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario (L)</th>
                        <th>Cantidad</th>
                        <th>Subtotal (L)</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="modalBodyProductos">
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td class="precioUnitario">{{ number_format($producto->precio, 2) }}</td>
                            <td><input type="number" class="form-control cantidadModal" min="1" value="1" /></td>
                            <td class="subtotalModal"> {{ number_format($producto->precio, 2) }} </td>
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
    const form = document.getElementById('facturaForm');
    const productosTable = document.getElementById('productosTable').querySelector('tbody');

    document.getElementById('addProducto').addEventListener('click', () => {
        const newRow = productosTable.rows[0].cloneNode(true);
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        productosTable.appendChild(newRow);
    });

    function actualizarFilas() {
        let total = 0;
        document.querySelectorAll('#productosTable tbody tr').forEach(row => {
            const qty = parseFloat(row.querySelector('.cantidad').value) || 0;
            const price = parseFloat(row.querySelector('.precio').value) || 0;
            const sub = qty * price;
            row.querySelector('.subtotal').value = sub.toFixed(2);
            total += sub;
        });

        document.getElementById('total').value = total.toFixed(2);
        document.getElementById('totalLabel').textContent = total.toFixed(2);

        // Nuevos cálculos
        const importeExonerado = 0;
        const importeExento = 0;
        const importeGravado = total;
        const isv = importeGravado * 0.15;
        const totalConISV = importeGravado + isv;

        document.getElementById('importeExonerado').textContent = importeExonerado.toFixed(2);
        document.getElementById('importeExento').textContent = importeExento.toFixed(2);
        document.getElementById('importeGravado').textContent = importeGravado.toFixed(2);
        document.getElementById('isv').textContent = isv.toFixed(2);
        document.getElementById('totalConISV').textContent = totalConISV.toFixed(2);
    }

    productosTable.parentNode.addEventListener('input', e => {
        if (e.target.matches('.cantidad, .precio')) actualizarFilas();
    });

    document.getElementById('btnLimpiarFactura').addEventListener('click', e => {
        e.preventDefault();
        form.reset();
        document.getElementById('total').value = '';
        document.querySelectorAll('.subtotal').forEach(i => i.value = '');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    });

    form.addEventListener('submit', e => {
        document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        let valid = true;

        const prov = form.proveedor_id;
        if (!prov.value) {
            valid = false; prov.classList.add('is-invalid');
            prov.insertAdjacentHTML('afterend','<div class="invalid-feedback">Seleccione un proveedor.</div>');
        }
        [['numero_factura','Número de factura'], ['fecha','Fecha de la compra']].forEach(([id, text]) => {
            const el = form[id];
            if (!el.value.trim()) {
                valid = false; el.classList.add('is-invalid');
                el.insertAdjacentHTML('afterend',`<div class="invalid-feedback">${text} es obligatorio.</div>`);
            }
        });
        if (parseFloat(form.total.value) <= 0 || !form.total.value) {
            valid = false; form.total.classList.add('is-invalid');
            form.total.insertAdjacentHTML('afterend','<div class="invalid-feedback">El total debe ser mayor a cero.</div>');
        }
        document.querySelectorAll('#productosTable tbody tr').forEach(row => {
            ['producto[]','cantidad[]','precio_unitario[]'].forEach(name => {
                const inp = row.querySelector(`[name="${name}"]`);
                if (!inp.value.trim()) {
                    valid = false; inp.classList.add('is-invalid');
                    inp.insertAdjacentHTML('afterend','<div class="invalid-feedback">Requerido.</div>');
                }
            });
        });
        if (!valid) e.preventDefault();
    });

    const inputProveedor = document.getElementById('nombreProveedor');
    const proveedorIdHidden = document.getElementById('proveedor_id');
    const resultadosTexto = document.getElementById('resultados');
    const listaProveedores = document.querySelectorAll('#listaProveedores option');

    inputProveedor.addEventListener('input', function () {
        const texto = this.value.trim().toLowerCase();
        let encontrados = 0;

        if (texto === '') {
            resultadosTexto.textContent = '';
            proveedorIdHidden.value = '';
            return;
        }

        listaProveedores.forEach(op => {
            if (op.value.toLowerCase().includes(texto)) {
                encontrados++;
            }
        });

        resultadosTexto.textContent = `Se encontraron ${encontrados} proveedores.`;
        // No asignamos proveedor_id aquí para evitar problemas con texto incompleto
        proveedorIdHidden.value = '';
    });

    // Evento que asigna el proveedor_id cuando el usuario selecciona una opción del datalist
    inputProveedor.addEventListener('change', function () {
        const valor = this.value;
        let id = '';

        listaProveedores.forEach(op => {
            if (op.value === valor) {
                id = op.dataset.id;
            }
        });

        proveedorIdHidden.value = id;
    });


    // Actualizar subtotal en el modal cuando cambia cantidad
    document.querySelectorAll('.cantidadModal').forEach(input => {
        input.addEventListener('input', function () {
            const row = input.closest('tr');
            const precio = parseFloat(row.querySelector('.precioUnitario').textContent) || 0;
            const cantidad = parseFloat(input.value) || 0;
            row.querySelector('.subtotalModal').textContent = (precio * cantidad).toFixed(2);
        });
    });

    // Agregar producto seleccionado a la tabla de factura
    document.querySelectorAll('.agregarDesdeModal').forEach(boton => {
        boton.addEventListener('click', function () {
            const row = boton.closest('tr');
            const nombre = row.cells[0].textContent;
            const precio = parseFloat(row.querySelector('.precioUnitario').textContent) || 0;
            const cantidad = parseFloat(row.querySelector('.cantidadModal').value) || 1;
            const subtotal = precio * cantidad;

            const nuevaFila = document.createElement('tr');
            nuevaFila.innerHTML = `
            <td><input type="text" name="producto[]" class="form-control" value="${nombre}" readonly /></td>
            <td><input type="number" name="cantidad[]" class="form-control cantidad" value="${cantidad}" min="1" required /></td>
            <td><input type="number" name="precio_unitario[]" class="form-control precio" value="${precio.toFixed(2)}" step="0.01" required /></td>
            <td><input type="text" name="subtotal[]" class="form-control subtotal" value="${subtotal.toFixed(2)}" readonly /></td>
            <td></td>
        `;
            productosTable.appendChild(nuevaFila);
            productosTable.parentElement.querySelector('table').style.display = 'table';
            actualizarFilas();
        });
    });

</script>
</body>
</html>
