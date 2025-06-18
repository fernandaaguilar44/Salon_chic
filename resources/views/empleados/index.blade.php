<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Empleados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            color: black;
            max-width: 1200px; /* más ancho */
        }

        .table thead th {
            background-color: #4B0082; /* morado oscuro */
            color: white;
        }

        .table tbody tr.inactivo td:nth-child(4) {
            color: gray;
            background-color: #f8f9fa;
        }

        .btn-custom {
            background-color: #E4007C;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #c3006a;
        }


        .acciones-btns a {
            margin-right: 0.3rem;
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

<div class="container mt-5">
    <h2 class="mb-4 text-center" style="color: #4B0082;">Listado de empleados</h2>

    @if (session('mensaje'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Felicidades</strong> {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="buscar" class="form-control" placeholder="Buscar por nombre o cargo">
        </div>
        <div class="col-md-4">
            <select id="estado" class="form-select">
                <option value="">Todos</option>
                <option value="activo">Activos</option>
                <option value="inactivo">Inactivos</option>
            </select>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('empleados.create') }}" class="btn btn-custom">+Registrar nuevo empleado</a>
        </div>
    </div>

    <div id="tabla-empleados">
        @include('empleados.partials.tabla')
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function buscarEmpleados() {
        let buscar = $('#buscar').val();
        let estado = $('#estado').val();

        $.ajax({
            url: '{{ route('empleados.buscar') }}',
            type: 'GET',
            data: { buscar: buscar, estado: estado },
            success: function(data) {
                $('#tabla-empleados').html(data);
            }
        });
    }

    $('#buscar').on('keyup', buscarEmpleados);
    $('#estado').on('change', buscarEmpleados);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

