<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de empleados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #E6E6FA; /* Lavanda */
            color: white;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            color: black;
            max-width: 900px; /* Igual tamaño al crear empleado */
        }

        .table thead {
            background-color: #4B0082; /* Morado oscuro */
            color: white;
        }



        .table tbody tr.inactivo td:nth-child(3) {
            color: gray;
            background-color: #f8f9fa;
        }




        .btn-custom {
            background-color: #E4007C; /* Rosa */
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #c3006a;
        }

        .btn-sm {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .form-label {
            color: #E4007C; /* Rosa */
        }

        .search-bar {
            max-width: 350px;
        }

        /* Espaciado para botones en acciones */
        .acciones-btns a {
            margin-right: 0.3rem;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('empleados.index') }}" class="d-flex search-bar">
            <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar por nombre o cargo"
                   value="{{ request('buscar') }}">
            <button class="btn btn-custom" type="submit">Buscar</button>
        </form>

        <a href="{{ route('empleados.create') }}" class="btn btn-custom">Registrar nuevo empleado</a>
    </div>



    <h2 class="mb-4 text-center" style="color: #4B0082;">Listado de Empleados</h2>
    {{-- para colocar el mensaje de notificacion que se ha creado exitosamente el estudiante explicar ahora --}}
    @if (session('mensaje'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Felicidades</strong> {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-hover align-middle text-center">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>Estado</th>
            <th>Fecha de Ingreso</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>



        @forelse($empleados as $empleado)
            <tr class="{{ strtolower(trim($empleado->estado)) === 'inactivo' ? 'inactivo' : '' }}">
                <td>{{ $empleado->nombre_empleado }}</td>
                <td>{{ $empleado->cargo }}</td>
                <td>{{ ucfirst($empleado->estado) }}</td>
                <td>{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</td>
                <td class="acciones-btns">
                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-sm btn-primary" title="Editar">Editar</a>

                    <form action="{{ route('empleados.desactivar', $empleado->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-warning" title="Deshabilitar" onclick="return confirm('¿Está seguro de desactivar este empleado?')">Deshabilitar</button>
                    </form>

                    <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-sm btn-info" title="Ver detalles">Ver detalles</a>
                    <a href="{{ route('llamados.historial', $empleado->id) }}" class="btn btn-sm btn-danger" title="Historial de Llamados">
                        Ver llamados
                    </a>

                </td>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No se encontraron empleados.</td>
            </tr>
        @endforelse

        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <div>
            {{ $empleados->appends(['buscar' => request('buscar')])->links() }}
        </div>


    </div>
</div>


<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
