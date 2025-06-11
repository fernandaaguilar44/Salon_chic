<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Proveedores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #E6E6FA; /* Lavanda */
            color: #000;
        }

        .table-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            overflow-x: auto;
        }

        .table th {
            background-color: #3a006b; /* Morado oscuro */
            color: white;
            text-align: center;
            white-space: nowrap;
        }

        .table td {
            background-color: white;
            color: black;
            vertical-align: middle;
            text-align: center;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: #3a006b;
            border-color: #3a006b;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a006b;
            border-color: #3a006b;
        }

        .btn-secondary {
            background-color: #FF69B4;
            border-color: #FF69B4;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #e055a2;
            border-color: #e055a2;
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
        }

        h2 {
            color: #3a006b;
        }

        .action-buttons .btn {
            margin-right: 0.25rem;
            white-space: nowrap;
        }

        @media (max-width: 991px) {
            .table-container {
                padding: 1rem;
            }

            .table th, .table td {
                font-size: 0.85rem;
                padding: 0.5rem 0.3rem;
            }

            .btn {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }

        @media (max-width: 575px) {
            .table-container {
                padding: 0.5rem;
            }

            .table-responsive {
                overflow-x: auto;
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
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="mb-3 mb-md-0">Lista de Proveedores</h2>
            <a href="{{ route('proveedores.create') }}" class="btn btn-primary mt-2 mt-md-0">+ Nuevo Proveedor</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-success fw-bold">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('proveedores.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por nombre o empresa...">
                <button class="btn btn-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                <tr>
                    <th>
                        <a href="{{ route('proveedores.index', array_merge(request()->all(), ['sort' => 'nombre_proveedor', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="text-white text-decoration-none">
                            Nombre
                            @if(request('sort') === 'nombre_proveedor')
                                {{ request('direction') === 'asc' ? '↑' : '↓' }}
                            @endif
                        </a>
                    </th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>
                        <a href="{{ route('proveedores.index', array_merge(request()->all(), ['sort' => 'nombre_empresa', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="text-white text-decoration-none">
                            Empresa
                            @if(request('sort') === 'nombre_empresa')
                                {{ request('direction') === 'asc' ? '↑' : '↓' }}
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('proveedores.index', array_merge(request()->all(), ['sort' => 'created_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="text-white text-decoration-none">
                            Fecha Registro
                            @if(request('sort') === 'created_at')
                                {{ request('direction') === 'asc' ? '↑' : '↓' }}
                            @endif
                        </a>
                    </th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->nombre_proveedor }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->direccion }}</td>
                        <td>{{ $proveedor->ciudad }}</td>
                        <td>{{ $proveedor->nombre_empresa }}</td>
                        <td>{{ $proveedor->created_at->format('d/m/Y') }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-secondary btn-sm">Ver</a>
                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay proveedores registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $proveedores->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
