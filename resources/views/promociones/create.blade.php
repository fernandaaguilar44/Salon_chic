<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear nueva promoción</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding-top: 0.5rem;
            padding-bottom: 2rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 0.5s ease-out;
        }
        h2 {
            text-align: center;
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
        }
        .form-label {
            color: #7B2A8D;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .form-label i {
            font-size: 0.95rem;
        }
        .form-control,
        .form-select {
            border-radius: 10px;
            background-color: white;
            color: black;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.25);
        }
        .btn {
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #6a267f 0%, #c3006a 100%);
            color: white;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            border: none;
            color: white;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
        }
        .btn-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.44) 0%, #a71e2a 100%);
            border: none;
            color: white;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, rgba(189, 33, 48, 0.41) 0%, #861c26 100%);
        }
        .invalid-feedback {
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
            display: block;
        }
        .productos-servicios-section {
            background: rgba(123, 42, 141, 0.05);
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 1rem;
            border: 2px dashed rgba(123, 42, 141, 0.2);
        }

        /* ✅ NUEVA CLASE PARA LIMITACIONES SIN COLOR DIFERENTE */
        .limitaciones-section {
            background: rgba(123, 42, 141, 0.05);
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 1rem;
            border: 2px dashed rgba(123, 42, 141, 0.2);
        }

        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 10px;
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
        }
        .form-check {
            margin-bottom: 0.5rem;
        }
        .form-check-label {
            color: #333;
            font-weight: 500;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .section-hidden {
            display: none;
        }

        /* ESTILOS PARA EL SISTEMA DE BÚSQUEDA */
        .search-container {
            position: relative;
        }

        .search-input {
            border-radius: 10px;
            padding-left: 2.5rem;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #7B2A8D;
            z-index: 3;
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(123, 42, 141, 0.15);
            display: none;
        }

        .search-result-item {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.2s;
        }

        .search-result-item:hover {
            background-color: #f8f9fa;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .selected-item-card {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-radius: 10px;
            padding: 12px;
            border-left: 4px solid #E4007C;
            margin-bottom: 10px;
            position: relative;
        }

        .selected-item-card.servicio {
            border-left-color: #4CAF50;
        }

        .selected-item-card.producto {
            border-left-color: #2196F3;
        }

        .selected-item-text {
            font-weight: 600;
            color: #333;
            margin: 0;
            padding-right: 30px;
        }

        .remove-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-btn:hover {
            background: #c82333;
        }

        .no-results {
            padding: 10px 15px;
            color: #666;
            font-style: italic;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="form-container">
                <h2><i class="fas fa-tags"></i> Crear una nueva promoción</h2>

                <form method="POST" action="{{ route('promociones.store') }}" id="promocionForm">
                    @csrf

                    <div class="row g-3">
                        <!-- SECCIÓN 1: INFORMACIÓN BÁSICA -->
                        <div class="col-12">
                            <div class="row g-3">
                                <!-- Nombre de la promoción -->
                                <div class="col-12 col-md-6">
                                    <label for="nombre" class="form-label">
                                        <i class="fas fa-tag"></i> Nombre de la promoción
                                    </label>
                                    <input type="text" id="nombre" name="nombre" maxlength="50"
                                           class="form-control @error('nombre') is-invalid @enderror"
                                           value="{{ old('nombre') }}"
                                           placeholder="Ej: Descuento de verano" />
                                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <!-- Tipo de promoción -->
                                <div class="col-12 col-md-6">
                                    <label for="tipo" class="form-label">
                                        <i class="fas fa-list"></i> Tipo de promoción
                                    </label>
                                    <select id="tipo" name="tipo" class="form-select @error('tipo') is-invalid @enderror">
                                        <option value="">Seleccione un tipo</option>
                                        <option value="porcentaje" {{ old('tipo') == 'porcentaje' ? 'selected' : '' }}>Porcentaje (%)</option>
                                        <option value="monto_fijo" {{ old('tipo') == 'monto_fijo' ? 'selected' : '' }}>Monto fijo</option>
                                        <option value="combo" {{ old('tipo') == 'combo' ? 'selected' : '' }}>Combo</option>
                                    </select>
                                    @error('tipo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 2: APLICACIÓN Y SELECCIÓN (MÁS CERCA) -->
                        <div class="col-12">
                            <div class="row g-3">
                                <!-- Aplica a -->
                                <div class="col-12 col-md-6">
                                    <label for="aplica_a" class="form-label">
                                        <i class="fas fa-bullseye"></i> Aplica a
                                    </label>
                                    <select id="aplica_a" name="aplica_a" class="form-select @error('aplica_a') is-invalid @enderror">
                                        <option value="">Seleccione una opción</option>
                                        <option value="productos" {{ old('aplica_a') == 'productos' ? 'selected' : '' }}>Productos</option>
                                        <option value="servicios" {{ old('aplica_a') == 'servicios' ? 'selected' : '' }}>Servicios</option>
                                    </select>
                                    @error('aplica_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <!-- Valor -->
                                <div class="col-12 col-md-3">
                                    <label for="valor" class="form-label">
                                        <i class="fas fa-dollar-sign"></i> Valor
                                    </label>
                                    <input type="text" id="valor" name="valor"
                                           class="form-control @error('valor') is-invalid @enderror"
                                           value="{{ old('valor') }}"
                                           placeholder="Ej: 300"
                                           maxlength="4" inputmode="numeric" />
                                    @error('valor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <!-- Monto mínimo -->
                                <div class="col-12 col-md-3">
                                    <label for="monto_minimo" class="form-label">
                                        <i class="fas fa-coins"></i> Monto mínimo
                                    </label>
                                    <input type="text" id="monto_minimo" name="monto_minimo"
                                           class="form-control @error('monto_minimo') is-invalid @enderror"
                                           value="{{ old('monto_minimo') }}"
                                           placeholder="Ej: 100"
                                           maxlength="4" inputmode="numeric" />
                                    @error('monto_minimo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 3: SELECCIÓN DE PRODUCTOS/SERVICIOS (INMEDIATAMENTE DESPUÉS) -->
                        <!-- Sección de Servicios -->
                        <div class="col-12 productos-servicios-section section-hidden" id="servicios-section">
                            <h5><i class="fas fa-cogs"></i> Seleccionar servicios</h5>

                            <!-- Campo de búsqueda de servicios -->
                            <div class="search-container mb-3">
                                <input type="text" id="buscarServicio"
                                       class="form-control search-input"
                                       placeholder="Buscar servicios por nombre..." />
                                <i class="fas fa-search search-icon"></i>
                                <div id="resultadosServicios" class="search-results"></div>
                            </div>

                            <!-- Servicios seleccionados -->
                            <div id="serviciosSeleccionados">
                                <div class="text-muted mb-2">
                                    <i class="fas fa-info-circle"></i> Servicios seleccionados aparecerán aquí
                                </div>
                            </div>
                            @error('servicios') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Sección de Productos -->
                        <div class="col-12 productos-servicios-section section-hidden" id="productos-section">
                            <h5><i class="fas fa-box"></i> Seleccionar productos</h5>

                            <!-- Campo de búsqueda de productos -->
                            <div class="search-container mb-3">
                                <input type="text" id="buscarProducto"
                                       class="form-control search-input"
                                       placeholder="Buscar productos por nombre..." />
                                <i class="fas fa-search search-icon"></i>
                                <div id="resultadosProductos" class="search-results"></div>
                            </div>

                            <!-- Productos seleccionados -->
                            <div id="productosSeleccionados">
                                <div class="text-muted mb-2">
                                    <i class="fas fa-info-circle"></i> Productos seleccionados aparecerán aquí
                                </div>
                            </div>
                            @error('productos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- SECCIÓN 4: FECHAS -->
                        <div class="col-12">
                            <div class="row g-3">
                                <!-- Fecha de inicio -->
                                <div class="col-12 col-md-6">
                                    <label for="fecha_inicio" class="form-label">
                                        <i class="fas fa-calendar-alt"></i> Fecha de inicio
                                    </label>
                                    <input type="date" id="fecha_inicio" name="fecha_inicio"
                                           class="form-control @error('fecha_inicio') is-invalid @enderror"
                                           value="{{ old('fecha_inicio') }}" />
                                    @error('fecha_inicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <!-- Fecha de expiración -->
                                <div class="col-12 col-md-6">
                                    <label for="fecha_expiracion" class="form-label">
                                        <i class="fas fa-calendar-times"></i> Fecha de expiración
                                    </label>
                                    <input type="date" id="fecha_expiracion" name="fecha_expiracion"
                                           class="form-control @error('fecha_expiracion') is-invalid @enderror"
                                           value="{{ old('fecha_expiracion') }}" />
                                    @error('fecha_expiracion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 5: LIMITACIONES Y CONTROL DE USO (SIN COLOR DIFERENTE) -->
                        <div class="col-12">
                            <div class="limitaciones-section">
                                <h5><i class="fas fa-shield-alt"></i> Limitaciones y control de uso</h5>

                                <div class="row">
                                    <!-- Uso máximo total -->
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="uso_maximo" class="form-label">
                                            <i class="fas fa-hashtag"></i> Uso máximo total
                                        </label>
                                        <input type="text" id="uso_maximo" name="uso_maximo"
                                               class="form-control @error('uso_maximo') is-invalid @enderror"
                                               value="{{ old('uso_maximo') }}"
                                               placeholder="Ej: 100"
                                               maxlength="4" inputmode="numeric" />
                                        <div class="form-text text-muted">
                                            Número máximo de veces que se puede usar esta promoción en total
                                        </div>
                                        @error('uso_maximo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <!-- Uso por cliente -->
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="uso_por_cliente" class="form-label">
                                            <i class="fas fa-user-check"></i> Uso por cliente
                                        </label>
                                        <input type="text" id="uso_por_cliente" name="uso_por_cliente"
                                               class="form-control @error('uso_por_cliente') is-invalid @enderror"
                                               value="{{ old('uso_por_cliente') }}"
                                               placeholder="Ej: 3"
                                               maxlength="3" inputmode="numeric" />
                                        <div class="form-text text-muted">
                                            Máximo de veces que un cliente puede usar esta promoción
                                        </div>
                                        @error('uso_por_cliente') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <!-- Es combinable -->
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="combinable" class="form-label">
                                            <i class="fas fa-layer-group"></i> ¿Es combinable?
                                        </label>
                                        <select id="combinable" name="combinable" class="form-select @error('combinable') is-invalid @enderror">
                                            <option value="">Seleccione una opción</option>
                                            <option value="si" {{ old('combinable') == 'si' ? 'selected' : '' }}>Sí, se puede combinar</option>
                                            <option value="no" {{ old('combinable') == 'no' ? 'selected' : '' }}>No, es exclusiva</option>
                                        </select>
                                        <div class="form-text text-muted">
                                            Indica si se puede usar junto con otras promociones
                                        </div>
                                        @error('combinable') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 6: DESCRIPCIÓN (AL FINAL) -->
                        <div class="col-12">
                            <label for="descripcion" class="form-label">
                                <i class="fas fa-align-left"></i> Descripción
                            </label>
                            <textarea id="descripcion" name="descripcion" maxlength="200" rows="4"
                                      class="form-control @error('descripcion') is-invalid @enderror"
                                      placeholder="Ej: Promoción especial de verano con descuentos en servicios de cabello.">{{ old('descripcion') }}</textarea>
                            @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Botones -->
                        <div class="mt-4 d-flex gap-3 flex-wrap justify-content-start">
                            <a href="{{ route('promociones.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="reset" class="btn btn-danger" id="btnLimpiar">
                                <i class="fas fa-eraser"></i> Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar promoción
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Elementos del DOM
        const tipoSelect = document.getElementById('tipo');
        const aplicaASelect = document.getElementById('aplica_a');
        const serviciosSection = document.getElementById('servicios-section');
        const productosSection = document.getElementById('productos-section');

        const buscarServicioInput = document.getElementById('buscarServicio');
        const resultadosServicios = document.getElementById('resultadosServicios');
        const serviciosSeleccionadosDiv = document.getElementById('serviciosSeleccionados');

        const buscarProductoInput = document.getElementById('buscarProducto');
        const resultadosProductos = document.getElementById('resultadosProductos');
        const productosSeleccionadosDiv = document.getElementById('productosSeleccionados');

        // Arrays para almacenar elementos seleccionados
        let serviciosSeleccionados = [];
        let productosSeleccionados = [];

        // Datos del servidor
        const servicios = @json($servicios);
        const productos = @json($productos);

        // Variables para timeouts
        let timeoutServicio, timeoutProducto;

        // ✅ FUNCIÓN PARA RESTAURAR SELECCIONES AL CARGAR LA PÁGINA
        function restaurarSeleccionesAlCargar() {
            // Obtener datos de old() de Laravel
            const oldServicios = @json(old('servicios', []));
            const oldProductos = @json(old('productos', []));
            const oldItemsIncluidos = @json(old('items_incluidos', ''));

            console.log('🔄 Restaurando selecciones...');
            console.log('- Old servicios:', oldServicios);
            console.log('- Old productos:', oldProductos);
            console.log('- Old items incluidos:', oldItemsIncluidos);

            // Si hay items_incluidos (combo), parsearlos
            if (oldItemsIncluidos && oldItemsIncluidos.trim() !== '') {
                const items = oldItemsIncluidos.split(',');

                items.forEach(item => {
                    if (item.startsWith('s')) {
                        // Es un servicio
                        const servicioId = parseInt(item.substring(1));
                        const servicio = servicios.find(s => s.id === servicioId);
                        if (servicio && !serviciosSeleccionados.find(s => s.id === servicioId)) {
                            serviciosSeleccionados.push(servicio);
                            console.log('✅ Servicio restaurado desde combo:', servicio.nombre_servicio);
                        }
                    } else if (item.startsWith('p')) {
                        // Es un producto
                        const productoId = parseInt(item.substring(1));
                        const producto = productos.find(p => p.id === productoId);
                        if (producto && !productosSeleccionados.find(p => p.id === productoId)) {
                            productosSeleccionados.push(producto);
                            console.log('✅ Producto restaurado desde combo:', producto.nombre);
                        }
                    }
                });
            }

            // Si hay arrays normales (promociones no combo), restaurarlos
            if (oldServicios && Array.isArray(oldServicios) && oldServicios.length > 0) {
                oldServicios.forEach(servicioId => {
                    const servicio = servicios.find(s => s.id === parseInt(servicioId));
                    if (servicio && !serviciosSeleccionados.find(s => s.id === servicio.id)) {
                        serviciosSeleccionados.push(servicio);
                        console.log('✅ Servicio restaurado desde array:', servicio.nombre_servicio);
                    }
                });
            }

            if (oldProductos && Array.isArray(oldProductos) && oldProductos.length > 0) {
                oldProductos.forEach(productoId => {
                    const producto = productos.find(p => p.id === parseInt(productoId));
                    if (producto && !productosSeleccionados.find(p => p.id === producto.id)) {
                        productosSeleccionados.push(producto);
                        console.log('✅ Producto restaurado desde array:', producto.nombre);
                    }
                });
            }

            // Actualizar las vistas
            actualizarServiciosSeleccionados();
            actualizarProductosSeleccionados();

            console.log('✅ Selecciones restauradas:', {
                servicios: serviciosSeleccionados.length,
                productos: productosSeleccionados.length
            });
        }

        function toggleSections() {
            const valor = aplicaASelect.value;

            // Ocultar ambas secciones primero
            serviciosSection.classList.add('section-hidden');
            productosSection.classList.add('section-hidden');

            // Solo limpiar búsquedas, NO las selecciones
            buscarServicioInput.value = '';
            buscarProductoInput.value = '';
            resultadosServicios.style.display = 'none';
            resultadosProductos.style.display = 'none';

            // Mostrar la sección correspondiente SIN limpiar selecciones
            if (valor === 'servicios') {
                serviciosSection.classList.remove('section-hidden');
            } else if (valor === 'productos') {
                productosSection.classList.remove('section-hidden');
            }

            // Actualizar inputs según el tipo de promoción
            actualizarInputsSegunTipo();
        }

        // ✅ FUNCIÓN CORREGIDA: Actualizar inputs según si es combo o promoción normal
        function actualizarInputsSegunTipo() {
            const tipo = tipoSelect.value;
            const aplica = aplicaASelect.value;

            console.log('🔧 Actualizando inputs - Tipo:', tipo, 'Aplica:', aplica);

            if (tipo === 'combo') {
                // Para combos: generar items_incluidos
                generarItemsIncluidos();
                // No usar inputs de array normal
                eliminarInputsArray();
                console.log('📦 Modo COMBO activado');
            } else {
                // Para promociones normales: usar arrays
                if (aplica === 'servicios') {
                    actualizarInputsServicios();
                    eliminarInputsProductos(); // Limpiar productos si cambia a servicios
                    console.log('🔧 Modo SERVICIOS activado');
                } else if (aplica === 'productos') {
                    actualizarInputsProductos();
                    eliminarInputsServicios(); // Limpiar servicios si cambia a productos
                    console.log('🔧 Modo PRODUCTOS activado');
                }
                // No usar items_incluidos
                eliminarItemsIncluidos();
            }
        }

        // ✅ FUNCIÓN CORREGIDA: Generar items_incluidos para combos
        function generarItemsIncluidos() {
            let items = [];

            // Agregar servicios seleccionados
            serviciosSeleccionados.forEach(servicio => {
                items.push('s' + servicio.id);
            });

            // Agregar productos seleccionados
            productosSeleccionados.forEach(producto => {
                items.push('p' + producto.id);
            });

            // Eliminar input existente
            const inputExistente = document.querySelector('input[name="items_incluidos"]');
            if (inputExistente) {
                inputExistente.remove();
            }

            // Crear nuevo input si hay items
            if (items.length > 0) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'items_incluidos';
                input.value = items.join(',');
                document.getElementById('promocionForm').appendChild(input);

                console.log('✅ Items incluidos generados:', input.value);
            } else {
                console.log('⚠️ No hay items para generar items_incluidos');
            }
        }

        // ✅ FUNCIONES DE LIMPIEZA MEJORADAS
        function eliminarItemsIncluidos() {
            const input = document.querySelector('input[name="items_incluidos"]');
            if (input) {
                input.remove();
                console.log('❌ Items incluidos eliminados (no es combo)');
            }
        }

        function eliminarInputsArray() {
            eliminarInputsServicios();
            eliminarInputsProductos();
            console.log('❌ Todos los arrays eliminados (es combo)');
        }

        function eliminarInputsServicios() {
            document.querySelectorAll('input[name="servicios[]"]').forEach(input => input.remove());
        }

        function eliminarInputsProductos() {
            document.querySelectorAll('input[name="productos[]"]').forEach(input => input.remove());
        }

        // Eventos
        aplicaASelect.addEventListener('change', toggleSections);
        tipoSelect.addEventListener('change', actualizarInputsSegunTipo);

        // BÚSQUEDA DE SERVICIOS
        buscarServicioInput.addEventListener('input', function() {
            const busqueda = this.value.trim().toLowerCase();
            clearTimeout(timeoutServicio);
            timeoutServicio = setTimeout(() => {
                if (busqueda.length >= 1) {
                    const resultados = servicios.filter(servicio =>
                        servicio.nombre_servicio.toLowerCase().includes(busqueda) &&
                        !serviciosSeleccionados.find(s => s.id === servicio.id)
                    ).slice(0, 8);
                    mostrarResultadosServicios(resultados);
                } else {
                    resultadosServicios.style.display = 'none';
                }
            }, 150);
        });

        // BÚSQUEDA DE PRODUCTOS
        buscarProductoInput.addEventListener('input', function() {
            const busqueda = this.value.trim().toLowerCase();
            clearTimeout(timeoutProducto);
            timeoutProducto = setTimeout(() => {
                if (busqueda.length >= 1) {
                    const resultados = productos.filter(producto =>
                        producto.nombre.toLowerCase().includes(busqueda) &&
                        !productosSeleccionados.find(p => p.id === producto.id)
                    ).slice(0, 8);
                    mostrarResultadosProductos(resultados);
                } else {
                    resultadosProductos.style.display = 'none';
                }
            }, 150);
        });

        // MOSTRAR RESULTADOS DE SERVICIOS
        function mostrarResultadosServicios(resultados) {
            if (resultados.length === 0) {
                resultadosServicios.innerHTML = '<div class="no-results">No se encontraron servicios disponibles</div>';
            } else {
                resultadosServicios.innerHTML = resultados.map(servicio => {
                    const duracion = servicio.duracion_estimada;
                    let duracionTexto;
                    if (duracion >= 60) {
                        const horas = Math.floor(duracion / 60);
                        const minutos = duracion % 60;
                        duracionTexto = minutos === 0 ? `${horas} h` : `${horas} h ${minutos} min`;
                    } else {
                        duracionTexto = `${duracion} min`;
                    }

                    return `<div class="search-result-item" data-id="${servicio.id}" data-tipo="servicio">
                    <strong>${servicio.nombre_servicio}</strong><br>
                    <small class="text-muted">L. ${servicio.precio_base} - ${duracionTexto}</small>
                </div>`;
                }).join('');
            }
            resultadosServicios.style.display = 'block';
        }

        // MOSTRAR RESULTADOS DE PRODUCTOS
        function mostrarResultadosProductos(resultados) {
            if (resultados.length === 0) {
                resultadosProductos.innerHTML = '<div class="no-results">No se encontraron productos disponibles</div>';
            } else {
                resultadosProductos.innerHTML = resultados.map(producto =>
                    `<div class="search-result-item" data-id="${producto.id}" data-tipo="producto">
                    <strong>${producto.nombre}</strong><br>
                    <small class="text-muted">L. ${producto.precio}</small>
                </div>`
                ).join('');
            }
            resultadosProductos.style.display = 'block';
        }

        // MANEJO DE CLICS EN RESULTADOS
        document.addEventListener('click', function(e) {
            if (e.target.closest('.search-result-item')) {
                const item = e.target.closest('.search-result-item');
                const id = parseInt(item.dataset.id);
                const tipo = item.dataset.tipo;

                if (tipo === 'servicio') {
                    const servicio = servicios.find(s => s.id === id);
                    if (servicio) {
                        agregarServicio(servicio);
                    }
                } else if (tipo === 'producto') {
                    const producto = productos.find(p => p.id === id);
                    if (producto) {
                        agregarProducto(producto);
                    }
                }
            }
        });

        // AGREGAR SERVICIO
        function agregarServicio(servicio) {
            serviciosSeleccionados.push(servicio);
            buscarServicioInput.value = '';
            resultadosServicios.style.display = 'none';
            actualizarServiciosSeleccionados();
            actualizarInputsSegunTipo();

            console.log('✅ Servicio agregado:', servicio.nombre_servicio);
            console.log('📋 Total servicios:', serviciosSeleccionados.length);
        }

        // AGREGAR PRODUCTO
        function agregarProducto(producto) {
            productosSeleccionados.push(producto);
            buscarProductoInput.value = '';
            resultadosProductos.style.display = 'none';
            actualizarProductosSeleccionados();
            actualizarInputsSegunTipo();

            console.log('✅ Producto agregado:', producto.nombre);
            console.log('📦 Total productos:', productosSeleccionados.length);
        }

        // ACTUALIZAR VISTA DE SERVICIOS SELECCIONADOS
        function actualizarServiciosSeleccionados() {
            if (serviciosSeleccionados.length === 0) {
                serviciosSeleccionadosDiv.innerHTML = `
                <div class="text-muted mb-2">
                    <i class="fas fa-info-circle"></i> Servicios seleccionados aparecerán aquí
                </div>`;
            } else {
                serviciosSeleccionadosDiv.innerHTML = serviciosSeleccionados.map(servicio =>
                    `<div class="selected-item-card servicio" data-id="${servicio.id}">
                    <p class="selected-item-text">
                        <strong>${servicio.nombre_servicio}</strong><br>
                        <small class="text-muted">L. ${servicio.precio_base} - ${servicio.duracion_estimada} min</small>
                    </p>
                    <button type="button" class="remove-btn" onclick="eliminarServicio(${servicio.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`
                ).join('');
            }
        }

        // ACTUALIZAR VISTA DE PRODUCTOS SELECCIONADOS
        function actualizarProductosSeleccionados() {
            if (productosSeleccionados.length === 0) {
                productosSeleccionadosDiv.innerHTML = `
                <div class="text-muted mb-2">
                    <i class="fas fa-info-circle"></i> Productos seleccionados aparecerán aquí
                </div>`;
            } else {
                productosSeleccionadosDiv.innerHTML = productosSeleccionados.map(producto =>
                    `<div class="selected-item-card producto" data-id="${producto.id}">
                    <p class="selected-item-text">
                        <strong>${producto.nombre}</strong><br>
                        <small class="text-muted">L. ${producto.precio}</small>
                    </p>
                    <button type="button" class="remove-btn" onclick="eliminarProducto(${producto.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`
                ).join('');
            }
        }

        // FUNCIONES GLOBALES
        window.eliminarServicio = function(id) {
            serviciosSeleccionados = serviciosSeleccionados.filter(s => s.id !== id);
            actualizarServiciosSeleccionados();
            actualizarInputsSegunTipo();
            console.log('❌ Servicio eliminado, ID:', id);
        };

        window.eliminarProducto = function(id) {
            productosSeleccionados = productosSeleccionados.filter(p => p.id !== id);
            actualizarProductosSeleccionados();
            actualizarInputsSegunTipo();
            console.log('❌ Producto eliminado, ID:', id);
        };

        // ✅ FUNCIÓN MEJORADA: ACTUALIZAR INPUTS HIDDEN PARA SERVICIOS (promociones normales)
        function actualizarInputsServicios() {
            // Eliminar inputs existentes
            eliminarInputsServicios();

            // Crear nuevos inputs
            serviciosSeleccionados.forEach(servicio => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'servicios[]';
                input.value = servicio.id;
                document.getElementById('promocionForm').appendChild(input);
            });

            console.log('📋 Inputs servicios[] actualizados:', serviciosSeleccionados.length);
        }

        // ✅ FUNCIÓN MEJORADA: ACTUALIZAR INPUTS HIDDEN PARA PRODUCTOS (promociones normales)
        function actualizarInputsProductos() {
            // Eliminar inputs existentes
            eliminarInputsProductos();

            // Crear nuevos inputs
            productosSeleccionados.forEach(producto => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'productos[]';
                input.value = producto.id;
                document.getElementById('promocionForm').appendChild(input);
            });

            console.log('📦 Inputs productos[] actualizados:', productosSeleccionados.length);
        }

        // OCULTAR RESULTADOS AL HACER CLIC FUERA
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-container')) {
                resultadosServicios.style.display = 'none';
                resultadosProductos.style.display = 'none';
            }
        });

        // VALIDACIÓN DE CAMPOS NUMÉRICOS
        const camposNumericos = ['valor', 'uso_maximo', 'uso_por_cliente'];

        camposNumericos.forEach(function(campoId) {
            const input = document.getElementById(campoId);

            if (input) {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    this.value = this.value.replace(/^0+/, '');
                });
            }
        });
        // ✅ VALIDACIÓN INTELIGENTE DE NOMBRE
        const nombreInput = document.getElementById('nombre');
        if (nombreInput) {
            nombreInput.addEventListener('input', function(e) {
                let valor = this.value;

                // Permitir solo: letras, números, espacios, guiones y %
                valor = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\-\%]/g, '');

                // No permitir solo números
                if (/^\d+$/.test(valor.trim())) {
                    // Si solo hay números, vaciar el campo
                    this.value = '';
                    return;
                }

                // No permitir más de 3 espacios consecutivos
                valor = valor.replace(/\s{4,}/g, '   ');

                // No permitir iniciar con números
                if (/^\d/.test(valor)) {
                    valor = valor.replace(/^\d+/, '');
                }

                // No permitir solo caracteres especiales (-, %)
                if (/^[\-\%\s]+$/.test(valor.trim())) {
                    this.value = '';
                    return;
                }

                this.value = valor;
            });

            // Validación al perder el foco (blur)
            nombreInput.addEventListener('blur', function() {
                let valor = this.value.trim();

                // Eliminar espacios múltiples
                valor = valor.replace(/\s+/g, ' ');

                // Validar que tenga al menos una letra
                if (!/[a-zA-ZáéíóúÁÉÍÓÚñÑ]/.test(valor)) {
                    this.value = '';
                    alert('El nombre debe contener al menos una letra.');
                    return;
                }

                // Validar longitud mínima con contenido real
                if (valor.length < 5) {
                    if (valor.length > 0) {
                        alert('El nombre debe tener al menos 5 caracteres.');
                    }
                }

                this.value = valor;
            });
        }

        // ✅ VALIDACIÓN ESPECIAL PARA monto_minimo (se permite el "0")
        const montoMinimoInput = document.getElementById('monto_minimo');
        if (montoMinimoInput) {
            montoMinimoInput.addEventListener('input', function () {
                // Solo números (pero NO quitamos el 0 si está solo)
                this.value = this.value.replace(/[^0-9]/g, '');

                // Si el usuario escribe varios ceros, dejar solo uno
                if (/^0+/.test(this.value)) {
                    this.value = '0';
                }
            });
        }

// ✅ VALIDACIÓN INTELIGENTE DE DESCRIPCIÓN
        const descripcionInput = document.getElementById('descripcion');
        if (descripcionInput) {
            descripcionInput.addEventListener('input', function(e) {
                let valor = this.value;

                // Permitir: letras, números, espacios, puntos, comas, guiones, paréntesis y %
                valor = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\.\,\-\%\(\)]/g, '');

                // No permitir solo números
                if (/^\d+$/.test(valor.trim())) {
                    this.value = '';
                    return;
                }

                // No permitir más de 3 espacios consecutivos
                valor = valor.replace(/\s{4,}/g, '   ');

                // No permitir iniciar con números
                if (/^\d/.test(valor)) {
                    valor = valor.replace(/^\d+/, '');
                }

                // No permitir solo signos de puntuación
                if (/^[\.\,\-\%\(\)\s]+$/.test(valor.trim())) {
                    this.value = '';
                    return;
                }

                this.value = valor;
            });

            // Validación al perder el foco
            descripcionInput.addEventListener('blur', function() {
                let valor = this.value.trim();

                // Eliminar espacios múltiples
                valor = valor.replace(/\s+/g, ' ');

                // Validar que tenga al menos una letra
                if (!/[a-zA-ZáéíóúÁÉÍÓÚñÑ]/.test(valor)) {
                    this.value = '';
                    alert('La descripción debe contener al menos una letra.');
                    return;
                }

                // Validar longitud mínima
                if (valor.length > 0 && valor.length < 10) {
                    alert('La descripción debe tener al menos 10 caracteres.');
                }

                this.value = valor;
            });
        }

        // VALIDACIÓN DE FECHAS
        const fechaInicio = document.getElementById('fecha_inicio');
        const fechaExpiracion = document.getElementById('fecha_expiracion');

        if (fechaInicio && fechaExpiracion) {
            fechaInicio.addEventListener('change', function() {
                fechaExpiracion.setAttribute('min', this.value);
            });
        }

        // BOTÓN LIMPIAR
        document.getElementById('btnLimpiar').addEventListener('click', function (e) {
            e.preventDefault();

            // Limpiar campos de texto
            const campos = ['nombre', 'valor', 'monto_minimo', 'fecha_inicio', 'fecha_expiracion', 'descripcion', 'uso_maximo', 'uso_por_cliente'];
            campos.forEach(campoId => {
                const campo = document.getElementById(campoId);
                if (campo) {
                    campo.value = '';
                }
            });

            // Limpiar selects
            const selects = ['tipo', 'aplica_a', 'combinable'];
            selects.forEach(selectId => {
                const select = document.getElementById(selectId);
                if (select) {
                    select.selectedIndex = 0;
                }
            });

            // Limpiar búsquedas
            buscarServicioInput.value = '';
            buscarProductoInput.value = '';
            resultadosServicios.style.display = 'none';
            resultadosProductos.style.display = 'none';

            // Limpiar selecciones
            serviciosSeleccionados = [];
            productosSeleccionados = [];
            actualizarServiciosSeleccionados();
            actualizarProductosSeleccionados();

            // Limpiar todos los inputs hidden
            document.querySelectorAll('input[name="servicios[]"]').forEach(input => input.remove());
            document.querySelectorAll('input[name="productos[]"]').forEach(input => input.remove());
            document.querySelectorAll('input[name="items_incluidos"]').forEach(input => input.remove());

            // Ocultar secciones
            serviciosSection.classList.add('section-hidden');
            productosSection.classList.add('section-hidden');

            // Remover clases de error
            document.querySelectorAll('.is-invalid').forEach(elemento => {
                elemento.classList.remove('is-invalid');
            });

            document.querySelectorAll('.invalid-feedback').forEach(feedback => {
                feedback.style.display = 'none';
            });

            console.log('🧹 Formulario completamente limpiado');
        });

        // ✅ VALIDACIÓN Y DEBUG: Mostrar estado antes de enviar (SIN ALERTAS)
        document.getElementById('promocionForm').addEventListener('submit', function(e) {
            console.log('🚀 ENVIANDO FORMULARIO:');
            console.log('- Tipo:', tipoSelect.value);
            console.log('- Aplica a:', aplicaASelect.value);
            console.log('- Servicios seleccionados:', serviciosSeleccionados.length);
            console.log('- Productos seleccionados:', productosSeleccionados.length);

            // Debug para combos
            const itemsInput = document.querySelector('input[name="items_incluidos"]');
            if (itemsInput) {
                console.log('✅ Items incluidos (COMBO):', itemsInput.value);
            } else {
                console.log('❌ No hay input items_incluidos');
            }

            // Debug para promociones normales
            const serviciosInputs = document.querySelectorAll('input[name="servicios[]"]');
            const productosInputs = document.querySelectorAll('input[name="productos[]"]');
            console.log('- Inputs servicios[]:', serviciosInputs.length);
            console.log('- Inputs productos[]:', productosInputs.length);

            // Mostrar valores específicos
            if (serviciosInputs.length > 0) {
                const valoresServicios = Array.from(serviciosInputs).map(input => input.value);
                console.log('  Valores servicios:', valoresServicios);
            }

            if (productosInputs.length > 0) {
                const valoresProductos = Array.from(productosInputs).map(input => input.value);
                console.log('  Valores productos:', valoresProductos);
            }


            console.log('✅ Validación frontend pasada, enviando...');
        });

        // ✅ EJECUTAR AL CARGAR LA PÁGINA - ORDEN IMPORTANTE
        restaurarSeleccionesAlCargar();
        toggleSections();
    });
</script>
</body>
</html>