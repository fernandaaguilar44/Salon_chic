<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Programar nueva cita</title>
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

        .info-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 1rem;
            border-left: 4px solid #E4007C;
            margin-bottom: 1rem;
        }

        .info-card h6 {
            color: #7B2A8D;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .info-card p {
            margin: 0;
            font-size: 0.9rem;
            color: #495057;
        }

        .horario-ocupado {
            background: #ffe6e6;
            color: #c62828;
            padding: 0.25rem 0.5rem;
            border-radius: 5px;
            font-size: 0.8rem;
            margin: 0.2rem;
            display: inline-block;
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #E4007C;
            border-radius: 50%;
            animation: spin 1s linear infinite;
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
            display: none;
        }

        .selected-item-card.cliente {
            border-left-color: #2196F3;
        }

        .selected-item-card.servicio {
            border-left-color: #4CAF50;
        }

        .selected-item-card.empleado {
            border-left-color: #FF9800;
        }

        .selected-item-text {
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .change-btn {
            font-size: 0.8rem;
            padding: 4px 8px;
            margin-top: 5px;
        }

        .no-results {
            padding: 10px 15px;
            color: #666;
            font-style: italic;
            text-align: center;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="form-container">
                <h2><i class="fas fa-calendar-plus"></i> Programar nueva cita</h2>

                <form method="POST" action="{{ route('citas.store') }}" id="citaForm" novalidate>
                    @csrf

                    <div class="row g-3">
                        <!-- Cliente con Búsqueda -->
                        <div class="col-12 col-md-6">
                            <label for="buscarCliente" class="form-label">
                                <i class="fas fa-user"></i> Cliente
                            </label>

                            <!-- Campo de búsqueda -->
                            <div class="search-container">
                                <input type="text" id="buscarCliente"
                                       class="form-control search-input @error('cliente_id') is-invalid @enderror"
                                       placeholder="Buscar cliente por nombre o teléfono..." />
                                <i class="fas fa-search search-icon"></i>

                                <!-- Resultados de búsqueda -->
                                <div id="resultadosCliente" class="search-results"></div>
                            </div>

                            <!-- Card del cliente seleccionado -->
                            <div id="clienteSeleccionado" class="selected-item-card cliente">
                                <p class="selected-item-text" id="nombreClienteSeleccionado"></p>
                                <button type="button" class="btn btn-outline-primary btn-sm change-btn" id="cambiarCliente">
                                    <i class="fas fa-edit"></i> Cambiar
                                </button>
                            </div>

                            <!-- Input hidden para el valor real -->
                            <input type="hidden" id="cliente_id" name="cliente_id" value="{{ old('cliente_id') }}" />
                            @error('cliente_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Servicio con Búsqueda -->
                        <div class="col-12 col-md-6">
                            <label for="buscarServicio" class="form-label">
                                <i class="fas fa-scissors"></i> Servicio
                            </label>

                            <!-- Campo de búsqueda -->
                            <div class="search-container">
                                <input type="text" id="buscarServicio"
                                       class="form-control search-input @error('servicio_id') is-invalid @enderror"
                                       placeholder="Buscar servicio por nombre..." />
                                <i class="fas fa-search search-icon"></i>

                                <!-- Resultados de búsqueda -->
                                <div id="resultadosServicio" class="search-results"></div>
                            </div>

                            <!-- Card del servicio seleccionado -->
                            <div id="servicioSeleccionado" class="selected-item-card servicio">
                                <p class="selected-item-text" id="nombreServicioSeleccionado"></p>
                                <button type="button" class="btn btn-outline-success btn-sm change-btn" id="cambiarServicio">
                                    <i class="fas fa-edit"></i> Cambiar
                                </button>
                            </div>

                            <!-- Input hidden para el valor real -->
                            <input type="hidden" id="servicio_id" name="servicio_id" value="{{ old('servicio_id') }}" />
                            @error('servicio_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Empleado con Búsqueda -->
                        <div class="col-12 col-md-6">
                            <label for="buscarEmpleado" class="form-label">
                                <i class="fas fa-user-tie"></i> Empleado
                            </label>

                            <!-- Campo de búsqueda -->
                            <div class="search-container">
                                <input type="text" id="buscarEmpleado"
                                       class="form-control search-input @error('empleado_id') is-invalid @enderror"
                                       placeholder="Buscar empleado por nombre o cargo..." />
                                <i class="fas fa-search search-icon"></i>

                                <!-- Resultados de búsqueda -->
                                <div id="resultadosEmpleado" class="search-results"></div>
                            </div>

                            <!-- Card del empleado seleccionado -->
                            <div id="empleadoSeleccionado" class="selected-item-card empleado">
                                <p class="selected-item-text" id="nombreEmpleadoSeleccionado"></p>
                                <button type="button" class="btn btn-outline-warning btn-sm change-btn" id="cambiarEmpleado">
                                    <i class="fas fa-edit"></i> Cambiar
                                </button>
                            </div>

                            <!-- Input hidden para el valor real -->
                            <input type="hidden" id="empleado_id" name="empleado_id" value="{{ old('empleado_id') }}" />
                            @error('empleado_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Fecha -->
                        <div class="col-12 col-md-6">
                            <label for="fecha" class="form-label">
                                <i class="fas fa-calendar"></i> Fecha de la cita
                            </label>
                            <input type="date" id="fecha" name="fecha"
                                   class="form-control @error('fecha') is-invalid @enderror"
                                   value="{{ old('fecha') }}" />
                            @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Hora -->
                        <div class="col-12 col-md-6">
                            <label for="hora_inicio" class="form-label">
                                <i class="fas fa-clock"></i> Hora de inicio
                                <div class="loading-spinner" id="loadingSpinner"></div>
                            </label>
                            <select id="hora_inicio" name="hora_inicio"
                                    class="form-select @error('hora_inicio') is-invalid @enderror">
                                <option value="">Seleccione una hora</option>
                                @foreach ([
                                    '08:00', '09:00', '10:00', '11:00',
                                    '13:00', '14:00', '15:00', '16:00', '17:00'
                                ] as $hora)
                                    <option value="{{ $hora }}" {{ old('hora_inicio') == $hora ? 'selected' : '' }}>
                                        {{ $hora }}
                                    </option>
                                @endforeach
                            </select>

                            @error('hora_inicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Información del servicio seleccionado -->
                        <div class="col-12" id="infoServicio" style="display: none;">
                            <div class="info-card">
                                <h6><i class="fas fa-info-circle"></i> Información del servicio</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Duración:</strong> <span id="duracionTexto">-</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Precio:</strong> <span id="precioTexto">-</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Hora fin estimada:</strong> <span id="horaFinTexto">-</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Disponibilidad del empleado -->
                        <div class="col-12" id="disponibilidadEmpleado" style="display: none;">
                            <div class="info-card">
                                <h6><i class="fas fa-calendar-times"></i> Horarios ocupados</h6>
                                <div id="horariosOcupados">
                                    <p class="text-muted">Seleccione empleado y fecha para ver disponibilidad</p>
                                </div>
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="col-12">
                            <label for="observaciones" class="form-label">
                                <i class="fas fa-sticky-note"></i> Observaciones (opcional)
                            </label>
                            <textarea id="observaciones" name="observaciones" maxlength="200" rows="3"
                                      class="form-control @error('observaciones') is-invalid @enderror"
                                      placeholder="Ej: Cliente prefiere corte en capas, trae su propio tinte...">{{ old('observaciones') }}</textarea>
                            <div class="form-text">
                                <span id="contadorCaracteres">0</span>/200 caracteres
                            </div>
                            @error('observaciones') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Botones -->
                        <div class="mt-4 d-flex gap-3 flex-wrap">
                            <a href="{{ route('citas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="reset" class="btn btn-danger" id="btnLimpiar">
                                <i class="fas fa-eraser"></i> Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnGuardar">
                                <i class="fas fa-save"></i> Programar cita
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
        // Variables globales
        const buscarClienteInput = document.getElementById('buscarCliente');
        const resultadosCliente = document.getElementById('resultadosCliente');
        const clienteSeleccionado = document.getElementById('clienteSeleccionado');
        const clienteIdInput = document.getElementById('cliente_id');

        const buscarServicioInput = document.getElementById('buscarServicio');
        const resultadosServicio = document.getElementById('resultadosServicio');
        const servicioSeleccionado = document.getElementById('servicioSeleccionado');
        const servicioIdInput = document.getElementById('servicio_id');

        const buscarEmpleadoInput = document.getElementById('buscarEmpleado');
        const resultadosEmpleado = document.getElementById('resultadosEmpleado');
        const empleadoSeleccionado = document.getElementById('empleadoSeleccionado');
        const empleadoIdInput = document.getElementById('empleado_id');

        const fechaInput = document.getElementById('fecha');
        const horaSelect = document.getElementById('hora_inicio');
        const observacionesTextarea = document.getElementById('observaciones');
        const contadorCaracteres = document.getElementById('contadorCaracteres');
        const infoServicio = document.getElementById('infoServicio');
        const disponibilidadEmpleado = document.getElementById('disponibilidadEmpleado');
        const loadingSpinner = document.getElementById('loadingSpinner');

        // Datos filtrados del servidor (solo activos)
        const clientes = @json($clientes);
        const servicios = @json($servicios);
        const empleados = @json($empleados);

        // SISTEMA DE BÚSQUEDA LOCAL MEJORADO (MÁS RÁPIDO)
        let timeoutCliente, timeoutServicio, timeoutEmpleado;

        // Búsqueda de clientes - Local y rápida
        buscarClienteInput.addEventListener('input', function() {
            const busqueda = this.value.trim().toLowerCase();

            clearTimeout(timeoutCliente);
            timeoutCliente = setTimeout(() => {
                if (busqueda.length >= 1) {
                    const resultados = clientes.filter(cliente =>
                        cliente.nombre.toLowerCase().includes(busqueda) ||
                        cliente.telefono.includes(busqueda)
                    ).slice(0, 8); // Máximo 8 resultados para rapidez

                    mostrarResultadosCliente(resultados);
                } else {
                    ocultarResultados(resultadosCliente);
                }
            }, 150); // Reducido de 300ms a 150ms
        });

        // Búsqueda de servicios - Local y rápida
        buscarServicioInput.addEventListener('input', function() {
            const busqueda = this.value.trim().toLowerCase();

            clearTimeout(timeoutServicio);
            timeoutServicio = setTimeout(() => {
                if (busqueda.length >= 1) {
                    const resultados = servicios.filter(servicio =>
                        servicio.nombre_servicio.toLowerCase().includes(busqueda)
                    ).slice(0, 8);

                    mostrarResultadosServicio(resultados);
                } else {
                    ocultarResultados(resultadosServicio);
                }
            }, 150);
        });

        // Búsqueda de empleados - Local y rápida
        buscarEmpleadoInput.addEventListener('input', function() {
            const busqueda = this.value.trim().toLowerCase();

            clearTimeout(timeoutEmpleado);
            timeoutEmpleado = setTimeout(() => {
                if (busqueda.length >= 1) {
                    const resultados = empleados.filter(empleado =>
                        empleado.nombre_empleado.toLowerCase().includes(busqueda) ||
                        (empleado.cargo && empleado.cargo.toLowerCase().includes(busqueda))
                    ).slice(0, 8);

                    mostrarResultadosEmpleado(resultados);
                } else {
                    ocultarResultados(resultadosEmpleado);
                }
            }, 150);
        });

        function mostrarResultadosCliente(resultados) {
            if (resultados.length === 0) {
                resultadosCliente.innerHTML = '<div class="no-results">No se encontraron clientes</div>';
            } else {
                resultadosCliente.innerHTML = resultados.map(cliente =>
                    `<div class="search-result-item" data-id="${cliente.id}" data-tipo="cliente">
                        <strong>${cliente.nombre}</strong><br>
                        <small class="text-muted">Tel: ${cliente.telefono}</small>
                    </div>`
                ).join('');
            }
            resultadosCliente.style.display = 'block';
        }

        function mostrarResultadosServicio(resultados) {
            if (resultados.length === 0) {
                resultadosServicio.innerHTML = '<div class="no-results">No se encontraron servicios</div>';
            } else {
                resultadosServicio.innerHTML = resultados.map(servicio => {
                    const duracion = servicio.duracion_estimada;
                    let duracionTexto;
                    if (duracion >= 60) {
                        const horas = Math.floor(duracion / 60);
                        const minutos = duracion % 60;
                        if (minutos === 0) {
                            duracionTexto = `${horas} h`;
                        } else {
                            duracionTexto = `${horas} h ${minutos} min`;
                        }
                    } else {
                        duracionTexto = `${duracion} min`;
                    }

                    return `<div class="search-result-item" data-id="${servicio.id}" data-tipo="servicio"
                          data-duracion="${servicio.duracion_estimada}" data-precio="${servicio.precio_base}">
                        <strong>${servicio.nombre_servicio}</strong><br>
                        <small class="text-muted">L. ${servicio.precio_base} - ${duracionTexto}</small>
                    </div>`;
                }).join('');
            }
            resultadosServicio.style.display = 'block';
        }

        function mostrarResultadosEmpleado(resultados) {
            if (resultados.length === 0) {
                resultadosEmpleado.innerHTML = '<div class="no-results">No se encontraron empleados</div>';
            } else {
                resultadosEmpleado.innerHTML = resultados.map(empleado =>
                    `<div class="search-result-item" data-id="${empleado.id}" data-tipo="empleado">
                        <strong>${empleado.nombre_empleado}</strong><br>
                        <small class="text-muted">${empleado.cargo || 'Sin cargo específico'}</small>
                    </div>`
                ).join('');
            }
            resultadosEmpleado.style.display = 'block';
        }

        // MANEJO DE CLICS EN RESULTADOS
        document.addEventListener('click', function(e) {
            if (e.target.closest('.search-result-item')) {
                const item = e.target.closest('.search-result-item');
                const tipo = item.dataset.tipo;
                const id = item.dataset.id;

                if (tipo === 'cliente') {
                    seleccionarCliente(id, item.querySelector('strong').textContent, item.querySelector('small').textContent);
                } else if (tipo === 'servicio') {
                    const duracion = item.dataset.duracion;
                    const precio = item.dataset.precio;
                    seleccionarServicio(id, item.querySelector('strong').textContent, duracion, precio);
                } else if (tipo === 'empleado') {
                    seleccionarEmpleado(id, item.querySelector('strong').textContent, item.querySelector('small').textContent);
                }
            }

            // Cerrar resultados cuando se hace clic fuera
            if (!e.target.closest('.search-container')) {
                ocultarTodosLosResultados();
            }
        });

        // FUNCIONES DE SELECCIÓN
        function seleccionarCliente(id, nombre, telefono) {
            clienteIdInput.value = id;
            document.getElementById('nombreClienteSeleccionado').textContent = `${nombre} - ${telefono}`;
            clienteSeleccionado.style.display = 'block';
            buscarClienteInput.style.display = 'none';
            ocultarResultados(resultadosCliente);
        }

        function seleccionarServicio(id, nombre, duracion, precio) {
            servicioIdInput.value = id;

            // Formatear duración
            let duracionTexto;
            if (duracion >= 60) {
                const horas = Math.floor(duracion / 60);
                const minutos = duracion % 60;
                if (minutos === 0) {
                    duracionTexto = `${horas} h`;
                } else {
                    duracionTexto = `${horas} h ${minutos} min`;
                }
            } else {
                duracionTexto = `${duracion} min`;
            }

            document.getElementById('nombreServicioSeleccionado').textContent = `${nombre} - L. ${precio} (${duracionTexto})`;
            servicioSeleccionado.style.display = 'block';
            buscarServicioInput.style.display = 'none';
            ocultarResultados(resultadosServicio);

            // Mostrar información del servicio
            document.getElementById('duracionTexto').textContent = duracionTexto;
            document.getElementById('precioTexto').textContent = 'L. ' + precio;
            infoServicio.style.display = 'block';

            actualizarHoraFin();
            generarHorariosDisponibles();
        }

        function seleccionarEmpleado(id, nombre, cargo) {
            empleadoIdInput.value = id;
            document.getElementById('nombreEmpleadoSeleccionado').textContent = nombre + (cargo !== 'Sin cargo específico' ? ` - ${cargo}` : '');
            empleadoSeleccionado.style.display = 'block';
            buscarEmpleadoInput.style.display = 'none';
            ocultarResultados(resultadosEmpleado);

            verificarDisponibilidad();
        }

        // BOTONES CAMBIAR
        document.getElementById('cambiarCliente').addEventListener('click', function() {
            clienteIdInput.value = '';
            clienteSeleccionado.style.display = 'none';
            buscarClienteInput.style.display = 'block';
            buscarClienteInput.value = '';
            buscarClienteInput.focus();
        });

        document.getElementById('cambiarServicio').addEventListener('click', function() {
            servicioIdInput.value = '';
            servicioSeleccionado.style.display = 'none';
            buscarServicioInput.style.display = 'block';
            buscarServicioInput.value = '';
            buscarServicioInput.focus();
            infoServicio.style.display = 'none';
        });

        document.getElementById('cambiarEmpleado').addEventListener('click', function() {
            empleadoIdInput.value = '';
            empleadoSeleccionado.style.display = 'none';
            buscarEmpleadoInput.style.display = 'block';
            buscarEmpleadoInput.value = '';
            buscarEmpleadoInput.focus();
            disponibilidadEmpleado.style.display = 'none';
        });

        // FUNCIONES AUXILIARES
        function ocultarResultados(elemento) {
            elemento.style.display = 'none';
        }

        function ocultarTodosLosResultados() {
            ocultarResultados(resultadosCliente);
            ocultarResultados(resultadosServicio);
            ocultarResultados(resultadosEmpleado);
        }

        // CONFIGURACIÓN DE FECHA (sin validaciones JavaScript)
        const hoy = new Date();
        const fecha3Meses = new Date();
        fecha3Meses.setMonth(hoy.getMonth() + 3);

        fechaInput.setAttribute('min', hoy.toISOString().split('T')[0]);
        fechaInput.setAttribute('max', fecha3Meses.toISOString().split('T')[0]);

        // Solo verificar disponibilidad cuando cambia la fecha (sin validaciones)
        fechaInput.addEventListener('change', function() {
            verificarDisponibilidad();
        });

        // GENERAR HORARIOS COMPLETOS (sin almuerzo ni 6PM)
        function generarHorariosDisponibles() {
            horaSelect.innerHTML = '<option value="">Seleccione una hora</option>';

            // Horarios: 8:00 AM - 11:00 AM, 1:00 PM - 5:00 PM (horas completas)
            const horarios = [
                '08:00', '09:00', '10:00', '11:00', // Mañana
                '13:00', '14:00', '15:00', '16:00', '17:00' // Tarde (sin 12:00 almuerzo ni 18:00 cierre)
            ];

            horarios.forEach(hora => {
                const option = document.createElement('option');
                option.value = hora;
                option.textContent = hora;
                horaSelect.appendChild(option);
            });
        }

        // Actualizar hora fin cuando cambia la hora de inicio
        horaSelect.addEventListener('change', function() {
            actualizarHoraFin();
        });

        // Contador de caracteres para observaciones
        observacionesTextarea.addEventListener('input', function() {
            const count = this.value.length;
            contadorCaracteres.textContent = count;

            if (count > 180) {
                contadorCaracteres.style.color = '#dc3545';
            } else {
                contadorCaracteres.style.color = '#6c757d';
            }
        });

        // Verificar disponibilidad del empleado - VERSIÓN CORREGIDA
        function verificarDisponibilidad() {
            const empleadoId = empleadoIdInput.value;
            const fecha = fechaInput.value;

            if (!empleadoId || !fecha) {
                disponibilidadEmpleado.style.display = 'none';
                return;
            }

            loadingSpinner.style.display = 'inline-block';

            // ✅ CORRECCIÓN: Usar GET con parámetros en la URL
            const url = `{{ route('citas.disponibilidad') }}?empleado_id=${empleadoId}&fecha=${fecha}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuesta del servidor:', data); // ✅ Para debugging

                    // ✅ VERIFICAR: Asegurar que la respuesta tiene la estructura correcta
                    if (data.success !== false) {
                        const horariosOcupados = data.horarios_ocupados || [];
                        mostrarHorariosOcupados(horariosOcupados);
                        marcarHorariosOcupados(horariosOcupados);
                    } else {
                        console.error('Error del servidor:', data.error || data.message);
                        mostrarHorariosOcupados([]);
                        marcarHorariosOcupados([]);
                    }

                    loadingSpinner.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error en la petición:', error);
                    loadingSpinner.style.display = 'none';

                    const contenedor = document.getElementById('horariosOcupados');
                    contenedor.innerHTML = '<p class="text-danger">⚠️ No se puede registrar la cita: el empleado ya tiene otra cita en ese horario o el cliente está ocupado con otro servicio.</p>';
                    disponibilidadEmpleado.style.display = 'block';


                    // ✅ LIMPIAR SELECT DE HORAS
                    marcarHorariosOcupados([]);
                });
        }

// Mostrar horarios ocupados - VERSIÓN MEJORADA
        function mostrarHorariosOcupados(horarios) {
            const contenedor = document.getElementById('horariosOcupados');

            if (!horarios || horarios.length === 0) {
                contenedor.innerHTML = '<p class="text-success">✓ Empleado disponible todo el día</p>';
            } else {
                let html = '<p class="mb-2">Horarios ocupados:</p>';
                horarios.forEach(horario => {
                    // ✅ VALIDAR: Asegurar que horario tiene las propiedades necesarias
                    const inicio = horario.inicio || horario.hora_inicio || 'N/A';
                    const fin = horario.fin || horario.hora_fin || 'N/A';

                    html += `<span class="horario-ocupado">${inicio} - ${fin}</span>`;
                });
                contenedor.innerHTML = html;
            }

            disponibilidadEmpleado.style.display = 'block';
        }

// Marcar horarios ocupados en el select - VERSIÓN MEJORADA
        function marcarHorariosOcupados(horariosOcupados) {
            const opciones = horaSelect.querySelectorAll('option');

            // ✅ LIMPIAR: Resetear todas las opciones primero
            opciones.forEach(option => {
                if (!option.value) return;

                option.disabled = false;
                option.style.color = '';
                option.textContent = option.value; // Remover el texto "(Ocupado)"
            });

            // ✅ VALIDAR: Solo procesar si hay horarios ocupados válidos
            if (!horariosOcupados || horariosOcupados.length === 0) {
                return;
            }

            opciones.forEach(option => {
                if (!option.value) return;

                const horaOpcion = option.value;
                const esOcupado = horarioEstaOcupado(horaOpcion, horariosOcupados);

                if (esOcupado) {
                    option.disabled = true;
                    option.style.color = '#dc3545';
                    option.textContent = option.value + ' (Ocupado)';
                }
            });
        }
// Verificar disponibilidad del empleado - VERSIÓN CORREGIDA
        function verificarDisponibilidad() {
            const empleadoId = empleadoIdInput.value;
            const fecha = fechaInput.value;

            // ✅ LIMPIAR ESTADO ANTERIOR SIEMPRE
            limpiarEstadoDisponibilidad();

            if (!empleadoId || !fecha) {
                disponibilidadEmpleado.style.display = 'none';
                return;
            }

            loadingSpinner.style.display = 'inline-block';

            // Usar GET con parámetros en la URL
            const url = `{{ route('citas.disponibilidad') }}?empleado_id=${empleadoId}&fecha=${fecha}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuesta del servidor:', data);

                    if (data.success !== false) {
                        const horariosOcupados = data.horarios_ocupados || [];
                        mostrarHorariosOcupados(horariosOcupados);
                        marcarHorariosOcupados(horariosOcupados);
                    } else {
                        console.error('Error del servidor:', data.error || data.message);
                        mostrarHorariosOcupados([]);
                        marcarHorariosOcupados([]);
                    }

                    loadingSpinner.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error en la petición:', error);
                    loadingSpinner.style.display = 'none';

                    // ✅ CAMBIO IMPORTANTE: No mostrar mensaje de error fijo
                    // En su lugar, mostrar que no se pudo verificar disponibilidad
                    const contenedor = document.getElementById('horariosOcupados');
                    contenedor.innerHTML = '<p class="text-warning">⚠️ No se pudo verificar la disponibilidad. Verifique la conexión.</p>';
                    disponibilidadEmpleado.style.display = 'block';

                    // ✅ LIMPIAR SELECT DE HORAS (permitir selección)
                    marcarHorariosOcupados([]);
                });
        }

// ✅ NUEVA FUNCIÓN: Limpiar estado de disponibilidad
        function limpiarEstadoDisponibilidad() {
            // Limpiar contenedor de horarios ocupados
            const contenedor = document.getElementById('horariosOcupados');
            if (contenedor) {
                contenedor.innerHTML = '';
            }

            // Ocultar sección de disponibilidad
            if (disponibilidadEmpleado) {
                disponibilidadEmpleado.style.display = 'none';
            }

            // Resetear todas las opciones del select de horas
            marcarHorariosOcupados([]);

            // Ocultar spinner
            if (loadingSpinner) {
                loadingSpinner.style.display = 'none';
            }
        }

// Mostrar horarios ocupados - VERSIÓN MEJORADA
        function mostrarHorariosOcupados(horarios) {
            const contenedor = document.getElementById('horariosOcupados');

            if (!horarios || horarios.length === 0) {
                contenedor.innerHTML = '<p class="text-success">✓ Empleado disponible todo el día</p>';
            } else {
                let html = '<p class="mb-2">Horarios ocupados:</p>';
                horarios.forEach(horario => {
                    const inicio = horario.inicio || horario.hora_inicio || 'N/A';
                    const fin = horario.fin || horario.hora_fin || 'N/A';
                    html += `<span class="horario-ocupado">${inicio} - ${fin}</span>`;
                });
                contenedor.innerHTML = html;
            }

            disponibilidadEmpleado.style.display = 'block';
        }

// Cita.js (VERSIÓN CORREGIDA)
        function horarioEstaOcupado(hora, horariosOcupados) {
            const servicioId = servicioIdInput.value;
            if (!servicioId) return false;

            const servicio = servicios.find(s => s.id == servicioId);
            if (!servicio) return false;

            const duracionServicio = parseInt(servicio.duracion_estimada);

            // Convertir la hora seleccionada y su fin en minutos para la comparación
            const inicioSeleccionadoEnMinutos = convertirHoraAMinutos(hora);
            const finSeleccionadoEnMinutos = inicioSeleccionadoEnMinutos + duracionServicio;

            return horariosOcupados.some(ocupado => {
                const inicioOcupadoStr = ocupado.inicio || ocupado.hora_inicio;
                const finOcupadoStr = ocupado.fin || ocupado.hora_fin;

                if (!inicioOcupadoStr || !finOcupadoStr) return false;

                const inicioOcupadoEnMinutos = convertirHoraAMinutos(inicioOcupadoStr);
                const finOcupadoEnMinutos = convertirHoraAMinutos(finOcupadoStr);

                // ✅ LÓGICA DE SOLAPAMIENTO CORREGIDA
                // Hay solapamiento si el inicio de una cita es antes del final de la otra Y viceversa.
                const seSolapan = (inicioSeleccionadoEnMinutos < finOcupadoEnMinutos && finSeleccionadoEnMinutos > inicioOcupadoEnMinutos);

                // Si la hora de inicio seleccionada es la misma que la hora de inicio de una cita ocupada
                const esMismaHoraInicio = (inicioSeleccionadoEnMinutos === inicioOcupadoEnMinutos);

                return seSolapan || esMismaHoraInicio;
            });
        }
// Verificar disponibilidad del empleado Y cliente - VERSIÓN CORREGIDA
        function verificarDisponibilidad() {
            const empleadoId = empleadoIdInput.value;
            const clienteId = clienteIdInput.value; // ✅ AGREGADO
            const fecha = fechaInput.value;

            // ✅ LIMPIAR ESTADO ANTERIOR SIEMPRE
            limpiarEstadoDisponibilidad();

            if (!empleadoId || !fecha) {
                disponibilidadEmpleado.style.display = 'none';
                return;
            }

            loadingSpinner.style.display = 'inline-block';

            // ✅ CORREGIDO: Incluir cliente_id en la consulta
            let url = `{{ route('citas.disponibilidad') }}?empleado_id=${empleadoId}&fecha=${fecha}`;
            if (clienteId) {
                url += `&cliente_id=${clienteId}`;
            }

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuesta del servidor:', data);

                    if (data.success !== false) {
                        const horariosOcupados = data.horarios_ocupados || [];
                        mostrarHorariosOcupados(horariosOcupados);
                        marcarHorariosOcupados(horariosOcupados);
                    } else {
                        console.error('Error del servidor:', data.error || data.message);
                        mostrarHorariosOcupados([]);
                        marcarHorariosOcupados([]);
                    }

                    loadingSpinner.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error en la petición:', error);
                    loadingSpinner.style.display = 'none';

                    // ✅ CAMBIO IMPORTANTE: No mostrar mensaje de error fijo
                    // En su lugar, mostrar que no se pudo verificar disponibilidad
                    const contenedor = document.getElementById('horariosOcupados');
                    contenedor.innerHTML = '<p class="text-warning">⚠️ No se pudo verificar la disponibilidad. Verifique la conexión.</p>';
                    disponibilidadEmpleado.style.display = 'block';

                    // ✅ LIMPIAR SELECT DE HORAS (permitir selección)
                    marcarHorariosOcupados([]);
                });
        }

// ✅ NUEVA FUNCIÓN: Limpiar estado de disponibilidad
        function limpiarEstadoDisponibilidad() {
            // Limpiar contenedor de horarios ocupados
            const contenedor = document.getElementById('horariosOcupados');
            if (contenedor) {
                contenedor.innerHTML = '';
            }

            // Ocultar sección de disponibilidad
            if (disponibilidadEmpleado) {
                disponibilidadEmpleado.style.display = 'none';
            }

            // Resetear todas las opciones del select de horas
            marcarHorariosOcupados([]);

            // Ocultar spinner
            if (loadingSpinner) {
                loadingSpinner.style.display = 'none';
            }
        }

// Mostrar horarios ocupados - VERSIÓN MEJORADA
        function mostrarHorariosOcupados(horarios) {
            const contenedor = document.getElementById('horariosOcupados');

            if (!horarios || horarios.length === 0) {
                contenedor.innerHTML = '<p class="text-success">✓ Empleado disponible todo el día</p>';
            } else {
                let html = '<p class="mb-2">Horarios ocupados:</p>';
                horarios.forEach(horario => {
                    const inicio = horario.inicio || horario.hora_inicio || 'N/A';
                    const fin = horario.fin || horario.hora_fin || 'N/A';
                    html += `<span class="horario-ocupado">${inicio} - ${fin}</span>`;
                });
                contenedor.innerHTML = html;
            }

            disponibilidadEmpleado.style.display = 'block';
        }

// Marcar horarios ocupados en el select - VERSIÓN MEJORADA
        function marcarHorariosOcupados(horariosOcupados) {
            const opciones = horaSelect.querySelectorAll('option');

            // ✅ LIMPIAR: Resetear todas las opciones primero
            opciones.forEach(option => {
                if (!option.value) return;

                option.disabled = false;
                option.style.color = '';
                option.style.backgroundColor = '';
                // ✅ MEJORADO: Remover texto "(Ocupado)" de manera más robusta
                const textoOriginal = option.value;
                option.textContent = textoOriginal;
            });

            // ✅ VALIDAR: Solo procesar si hay horarios ocupados válidos
            if (!horariosOcupados || horariosOcupados.length === 0) {
                return;
            }

            opciones.forEach(option => {
                if (!option.value) return;

                const horaOpcion = option.value;
                const esOcupado = horarioEstaOcupado(horaOpcion, horariosOcupados);

                if (esOcupado) {
                    option.disabled = true;
                    option.style.color = '#dc3545';
                    option.style.backgroundColor = '#f8d7da';
                    option.textContent = option.value + ' (Ocupado)';
                }
            });
        }

// Verificar si un horario está ocupado - VERSIÓN MEJORADA
        function horarioEstaOcupado(hora, horariosOcupados) {
            const servicioId = servicioIdInput.value;
            if (!servicioId) return false;

            const servicio = servicios.find(s => s.id == servicioId);
            if (!servicio) return false;

            const duracion = parseInt(servicio.duracion_estimada);
            const inicioMinutos = convertirHoraAMinutos(hora);
            const finMinutos = inicioMinutos + duracion;

            return horariosOcupados.some(ocupado => {
                const inicioOcupado = ocupado.inicio || ocupado.hora_inicio;
                const finOcupado = ocupado.fin || ocupado.hora_fin;

                if (!inicioOcupado) return false;

                try {
                    const ocupadoInicio = convertirHoraAMinutos(inicioOcupado);
                    const ocupadoFin = finOcupado ? convertirHoraAMinutos(finOcupado) : ocupadoInicio + 60;

                    // Verificar solapamiento
                    return (inicioMinutos < ocupadoFin && finMinutos > ocupadoInicio);
                } catch (error) {
                    console.warn('Error procesando horario ocupado:', ocupado, error);
                    return false;
                }
            });
        }

// Convertir hora a minutos
        function convertirHoraAMinutos(hora) {
            const [h, m] = hora.split(':').map(Number);
            return h * 60 + m;
        }

// Convertir minutos a hora
        function convertirMinutosAHora(minutos) {
            const h = Math.floor(minutos / 60);
            const m = minutos % 60;
            return `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`;
        }

// Actualizar hora fin estimada
        function actualizarHoraFin() {
            const servicioId = servicioIdInput.value;
            const horaInicio = horaSelect.value;

            if (servicioId && horaInicio) {
                const servicio = servicios.find(s => s.id == servicioId);
                if (servicio) {
                    const duracion = parseInt(servicio.duracion_estimada);
                    const inicioMinutos = convertirHoraAMinutos(horaInicio);
                    const finMinutos = inicioMinutos + duracion;
                    const horaFin = convertirMinutosAHora(finMinutos);

                    document.getElementById('horaFinTexto').textContent = horaFin;
                }
            } else {
                document.getElementById('horaFinTexto').textContent = '-';
            }
        }

// ✅ MEJORAR EVENT LISTENERS - Agregar limpieza automática
// Event listener para cuando cambie el empleado
        if (empleadoIdInput) {
            empleadoIdInput.addEventListener('change', function() {
                limpiarEstadoDisponibilidad();
                setTimeout(() => {
                    verificarDisponibilidad();
                }, 100);
            });
        }

// Event listener para cuando cambie la fecha
        if (fechaInput) {
            fechaInput.addEventListener('change', function() {
                limpiarEstadoDisponibilidad();
                setTimeout(() => {
                    verificarDisponibilidad();
                }, 100);
            });
        }

// Event listener para cuando cambie el cliente (puede afectar disponibilidad)
        if (clienteIdInput) {
            clienteIdInput.addEventListener('change', function() {
                limpiarEstadoDisponibilidad();
                setTimeout(() => {
                    verificarDisponibilidad();
                }, 100);
            });
        }

// Botón limpiar - VERSIÓN MEJORADA
        document.getElementById('btnLimpiar').addEventListener('click', function(e) {
            e.preventDefault();

            // Limpiar todos los campos de búsqueda
            clienteIdInput.value = '';
            servicioIdInput.value = '';
            empleadoIdInput.value = '';

            buscarClienteInput.value = '';
            buscarServicioInput.value = '';
            buscarEmpleadoInput.value = '';

            // Mostrar campos de búsqueda y ocultar cards seleccionados
            buscarClienteInput.style.display = 'block';
            buscarServicioInput.style.display = 'block';
            buscarEmpleadoInput.style.display = 'block';

            clienteSeleccionado.style.display = 'none';
            servicioSeleccionado.style.display = 'none';
            empleadoSeleccionado.style.display = 'none';

            // Limpiar otros campos
            fechaInput.value = '';
            horaSelect.innerHTML = '<option value="">Seleccione una hora</option>';
            observacionesTextarea.value = '';

            // ✅ IMPORTANTE: Limpiar estado de disponibilidad
            limpiarEstadoDisponibilidad();

            // Ocultar información adicional
            infoServicio.style.display = 'none';
            ocultarTodosLosResultados();

            // Resetear contador
            contadorCaracteres.textContent = '0';
            contadorCaracteres.style.color = '#6c757d';

            // Remover clases de error
            const campos = ['buscarCliente', 'buscarServicio', 'buscarEmpleado', 'fecha', 'hora_inicio', 'observaciones'];
            campos.forEach(campoId => {
                const elemento = document.getElementById(campoId);
                if (elemento) {
                    elemento.classList.remove('is-invalid');
                }
            });

            // Ocultar mensajes de error
            document.querySelectorAll('.invalid-feedback').forEach(feedback => {
                feedback.style.display = 'none';
            });

            // Regenerar horarios
            generarHorariosDisponibles();
        });

// ✅ NUEVA FUNCIÓN: Función auxiliar para las funciones de selección
        function limpiarYReverificar() {
            limpiarEstadoDisponibilidad();
            setTimeout(() => {
                verificarDisponibilidad();
            }, 100);
        }

// ✅ MODIFICAR las funciones de selección existentes para incluir limpieza
// Agregar esto al final de las funciones seleccionarCliente, seleccionarEmpleado, etc.
        /*
        Al final de seleccionarCliente(), seleccionarEmpleado(), seleccionarServicio():
        limpiarYReverificar();
        */

// Inicializar horarios
        generarHorariosDisponibles();

// Restaurar valores old() si existen
        const oldClienteId = '{{ old("cliente_id") }}';
        const oldServicioId = '{{ old("servicio_id") }}';
        const oldEmpleadoId = '{{ old("empleado_id") }}';

        if (oldClienteId) {
            const cliente = clientes.find(c => c.id == oldClienteId);
            if (cliente) {
                seleccionarCliente(cliente.id, cliente.nombre, cliente.telefono);
            }
        }

        if (oldServicioId) {
            const servicio = servicios.find(s => s.id == oldServicioId);
            if (servicio) {
                seleccionarServicio(servicio.id, servicio.nombre_servicio, servicio.duracion_estimada, servicio.precio_base);
            }
        }

        if (oldEmpleadoId) {
            const empleado = empleados.find(e => e.id == oldEmpleadoId);
            if (empleado) {
                seleccionarEmpleado(empleado.id, empleado.nombre_empleado, empleado.cargo || '');
            }
        }
    });
</script>
</body>
</html>