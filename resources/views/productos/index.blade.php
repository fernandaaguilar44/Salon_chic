<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
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

        .table thead th a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .table thead th a:hover {
            color: rgba(255, 255, 255, 0.8);
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
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

        .btn-warning-beauty {
            background: linear-gradient(135deg, #7b2a8d 0%, #ff69b4 100%);
            color: #ffffff;
        }

        .btn-warning-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgb(123, 42, 141);
            color: #212529;
        }

        .btn-danger-beauty {
            background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
            color: white;
        }

        .btn-danger-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
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

        .pagination .page-link {
            color: #3a006b;
            padding: 0.4rem 0.75rem;
            font-weight: 500;
            border-radius: 10px;
        }
        .pagination .page-item.active .page-link {
            background-color: #3a006b;
            border-color: #3a006b;
            color: white;
        }
        .pagination .page-link:hover {
            background-color: #e6ccff;
            border-color: #3a006b;
            color: #3a006b;
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

        /* Imagen del producto */
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .no-image {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 1.2rem;
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
        }

        /* Fila de mensaje de resultados */
        #fila-mensaje {
            background: transparent;
        }

        #fila-mensaje td {
            padding: 1rem;
            border: none;
        }

    </style>
</head>
<body>

<div class="container py-5">
    <div class="beauty-header">
        <h2><i class="fas fa-box"></i> Lista de Productos</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> Felicidades:</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> Felicidades:</strong> {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="header-actions">
        <div class="row align-items-end">
            <div class="col-md-4 mb-3 mb-md-0">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-search"></i> Buscar por nombre
                </label>
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre o código...">
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-layer-group"></i> Filtrar por categoría
                </label>
                <select id="categoriaFilter" class="form-select">
                    <option value="">Todas las categorías</option>
                    <option value="cabello">Cabello</option>
                    <option value="manicura">Manicura</option>
                    <option value="pedicura">Pedicura</option>
                </select>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('productos.create') }}" class="btn btn-beauty btn-primary-beauty">
                    <i class="fas fa-plus"></i> Crear nuevo producto
                </a>
            </div>
        </div>
    </div>

    <div class="table-container">
        <div class="table-responsive" style="max-width: 100%;">
        <table class="table table-bordered align-middle mb-0" id="productosTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>
                        <a href="{{ route('productos.index', ['sort' => 'nombre', 'direction' => request('direction') === 'asc' && request('sort') === 'nombre' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                            Nombre
                            @if(request('sort') === 'nombre')
                                @if(request('direction') === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($productos as $index => $producto)
                    <tr>
                        <td>{{ $loop->iteration + ($productos->currentPage() - 1) * $productos->perPage() }}</td>
                        <td>
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="product-image">
                            @else
                                <div class="no-image">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->codigo }}</td>
                        <td>{{ ucfirst($producto->categoria) }}</td>

                        <td class="action-buttons">
                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-beauty btn-secondary-beauty btn-sm">
                                Ver
                            </a>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-beauty btn-warning-beauty btn-sm">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay productos registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- RESULTADOS -->
        <div id="resultadosTexto" class="mt-3 text-muted small text-center" style="display: none;">
            <i class="fas fa-info-circle"></i> <span id="contadorResultados"></span>
        </div>

        <!-- Paginación -->
        @if ($productos->hasPages())
            <div class="d-flex flex-column align-items-center mt-4" id="paginationContainer">
                <div class="text-muted small mb-2">
                    Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de {{ $productos->total() }} resultados
                </div>
                <nav>
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item {{ $productos->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $productos->previousPageUrl() }}" aria-label="Anterior">Anterior</a>
                        </li>
                        @foreach ($productos->getUrlRange(1, $productos->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $productos->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="page-item {{ !$productos->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $productos->nextPageUrl() }}" aria-label="Siguiente">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const todosLosProductos = @json($todos);
</script>
<script>
    // Filtro en tiempo real con mensaje y ocultar paginación
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const categoriaFilter = document.getElementById('categoriaFilter').value.toLowerCase();
        const resultadosTexto = document.getElementById('resultadosTexto');
        const contadorResultados = document.getElementById('contadorResultados');
        const tbody = document.querySelector('#productosTable tbody');
        const pagination = document.getElementById('paginationContainer');

        tbody.innerHTML = '';
        let contador = 0;

        const filtrados = todosLosProductos.filter(p => {
            const nombre = p.nombre.toLowerCase();
            const codigo = p.codigo.toLowerCase();
            const categoria = p.categoria.toLowerCase();

            const coincideNombre = nombre.includes(filter) || codigo.includes(filter);
            const coincideCategoria = categoriaFilter === '' || categoria.includes(categoriaFilter);

            return coincideNombre && coincideCategoria;
        });

        filtrados.forEach((producto, index) => {
            contador++;
            tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>
                    ${producto.imagen ? `<img src="/storage/${producto.imagen}" alt="${producto.nombre}" class="product-image">`
                : `<div class="no-image"><i class="fas fa-image"></i></div>`}
                </td>
                <td>${producto.nombre}</td>
                <td>${producto.codigo}</td>
                <td>${producto.categoria.charAt(0).toUpperCase() + producto.categoria.slice(1)}</td>
                <td class="action-buttons">
                    <a href="/productos/${producto.id}" class="btn btn-beauty btn-secondary-beauty btn-sm">Ver</a>
                    <a href="/productos/${producto.id}/edit" class="btn btn-beauty btn-warning-beauty btn-sm">Editar</a>
                </td>
            </tr>
        `;
        });

        if (filter === '' && categoriaFilter === '') {
            resultadosTexto.style.display = 'none';
            if (pagination) pagination.style.display = '';
             // recarga para volver a mostrar la paginación original
        } else {
            resultadosTexto.style.display = 'block';
            if (pagination) pagination.style.display = 'none';

            if (contador === 0) {
                contadorResultados.textContent = 'No se encontraron resultados';
                contadorResultados.style.color = '#dc3545';
            } else if (contador === 1) {
                contadorResultados.textContent = 'Se encontró 1 resultado';
                contadorResultados.style.color = '#28a745';
            } else {
                contadorResultados.textContent = `Se encontraron ${contador} resultados`;
                contadorResultados.style.color = '#28a745';
            }
        }
    });

    // Filtro por categoría
    document.getElementById('categoriaFilter').addEventListener('change', function () {
        // Trigger the search function when category changes
        document.getElementById('searchInput').dispatchEvent(new Event('keyup'));
    });
</script>
</body>
</html>
