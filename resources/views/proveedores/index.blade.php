<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Proveedores</title>
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

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
        }

        /* Tabla mejorada */
        .table-container {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(123, 42, 141, 0.1);
            margin-bottom: 1rem;
        }

        .table {
            margin-bottom: 0;
            background: white;
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
    </style>
</head>
<body>

<div class="container py-5">
    <div class="beauty-header">
        <h2><i class="fas fa-truck"></i> Lista de Proveedores</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> Felicidades:</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="header-actions">
        <div class="row align-items-end">
            <div class="col-md-8 mb-3 mb-md-0">
                <label class="form-label fw-semibold text-muted">
                    <i class="fas fa-search"></i> Buscar proveedor
                </label>
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre o empresa...">
                <div id="resultadosTexto" class="mt-2 text-muted small" style="display: none;">
                    <i class="fas fa-info-circle"></i> <span id="contadorResultados"></span>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('proveedores.create') }}" class="btn btn-beauty btn-primary-beauty">
                    <i class="fas fa-plus"></i> Crear nuevo proveedor
                </a>
            </div>
        </div>
    </div>

    <div class="table-container">
        <div>
            <table class="table table-bordered align-middle mb-0" id="proveedoresTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <a href="{{ route('proveedores.index', ['sort' => 'nombre_empresa', 'direction' => request('direction') === 'asc' && request('sort') === 'nombre_empresa' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                            Empresa
                            @if(request('sort') === 'nombre_empresa')
                                @if(request('direction') === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>Ciudad</th>
                    <th>Teléfono</th>
                    <th>
                        <a href="{{ route('proveedores.index', ['sort' => 'nombre_proveedor', 'direction' => request('direction') === 'asc' && request('sort') === 'nombre_proveedor' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                            Nombre del vendedor
                            @if(request('sort') === 'nombre_proveedor')
                                @if(request('direction') === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($proveedores as $index => $proveedor)
                    <tr>
                        <td>{{ $loop->iteration + ($proveedores->currentPage() - 1) * $proveedores->perPage() }}</td>
                        <td>{{ $proveedor->nombre_empresa }}</td>
                        <td>{{ $proveedor->ciudad }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->nombre_proveedor }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-beauty btn-secondary-beauty btn-sm">
                                Ver
                            </a>
                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-beauty btn-warning-beauty btn-sm">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay proveedores registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        @if ($proveedores->hasPages())
            <div class="d-flex flex-column align-items-center mt-4">
                <div class="text-muted small mb-2">
                    Mostrando {{ $proveedores->firstItem() }} a {{ $proveedores->lastItem() }} de {{ $proveedores->total() }} resultados
                </div>
                <nav>
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item {{ $proveedores->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $proveedores->previousPageUrl() }}" aria-label="Anterior">Anterior</a>
                        </li>
                        @foreach ($proveedores->getUrlRange(1, $proveedores->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $proveedores->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="page-item {{ !$proveedores->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $proveedores->nextPageUrl() }}" aria-label="Siguiente">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

    // Filtro en tiempo real con mensaje y ocultar paginación
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#proveedoresTable tbody tr');
        const resultadosTexto = document.getElementById('resultadosTexto');
        const contadorResultados = document.getElementById('contadorResultados');
        const pagination = document.getElementById('paginationContainer');

        let contador = 0;
        let numeroVisible = 1;

        rows.forEach(row => {
            const esFilaVacia = row.cells.length === 1 && row.cells[0].colSpan;

            if (!esFilaVacia) {
                const empresa = row.cells[1].textContent.toLowerCase();
                const vendedor = row.cells[4].textContent.toLowerCase();
                const coincide = empresa.includes(filter) || vendedor.includes(filter);

                if (coincide) {
                    row.style.display = '';
                    row.cells[0].textContent = numeroVisible++;
                    contador++;
                } else {
                    row.style.display = 'none';
                }
            } else {
                row.style.display = (filter && contador === 0) ? '' : 'none';
            }
        });

        if (filter === '') {
            resultadosTexto.style.display = 'none';
            if (pagination) pagination.style.display = '';
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
</script>
</body>
</html>
