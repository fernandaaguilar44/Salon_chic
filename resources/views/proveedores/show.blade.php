<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Proveedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #E6E6FA; /* Lavanda */
            color: #000;
        }
        h2 {
            color: #c97bff;
        }
        .label {
            font-weight: 600;
            color: #e4007c;
        }
        .btn-primary {
            background-color: #c97bff;
            border-color: #c97bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #3a006b;
            border-color: #3a006b;
        }
        .img-proveedor {
            max-width: 300px;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .img-wrapper {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Detalles del Proveedor</h2>

    <div class="row" style="min-height: 400px;">
        <!-- Información del proveedor -->
        <div class="col-md-8">
            <div class="card p-4 shadow-sm mb-3">
                <p><span class="label">Nombre:</span> {{ $proveedor->nombre_proveedor }}</p>
                <p><span class="label">Teléfono:</span> {{ $proveedor->telefono }}</p>
                <p><span class="label">Dirección:</span> {{ $proveedor->direccion }}</p>
                <p><span class="label">Ciudad:</span> {{ $proveedor->ciudad }}</p>
                <p><span class="label">Nombre Empresa:</span> {{ $proveedor->nombre_empresa }}</p>
                <p><span class="label">Empleado encargado:</span> {{ $proveedor->empleado_encargado }}</p>
                <p><span class="label">Teléfono encargado:</span> {{ $proveedor->telefono_empleado_encargado }}</p>
                <p><span class="label">Fecha de registro:</span> {{ $proveedor->fecha_registro }}</p>
            </div>

            <a href="{{ route('proveedores.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>

        <!-- Imagen del proveedor (solo si existe) -->
        <div class="col-md-4">
            @if($proveedor->imagen)
                <div class="img-wrapper">
                    <img src="{{ asset('storage/' . $proveedor->imagen) }}"
                         alt="Imagen del proveedor"
                         class="img-fluid img-proveedor">
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
