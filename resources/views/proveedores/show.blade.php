<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Proveedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E6E6FA;
            color: #000;
        }
        h2 {
            color: #3a006b;
        }
        .label {
            font-weight: 600;
            color: #e4007c;
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
@include('layouts.slider')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
        </div>
    </div>

<div class="container mt-5">
    <h2 class="mb-4">Detalles del Proveedor</h2>

    <div class="row" style="min-height: 400px;">
        <div class="col-md-8">
            <div class="card p-4 shadow-sm mb-3">
                <h5 class="text-rosado fw-bold mb-3">Datos de la Empresa</h5>
                <p><span class="label">Nombre Empresa:</span> {{ $proveedor->nombre_empresa }}</p>
                <p><span class="label">Nombre del Empleado Encargado:</span> {{ $proveedor->empleado_encargado }}</p>
                <p><span class="label">Teléfono Encargado:</span> {{ $proveedor->telefono_empleado_encargado }}</p>
                <p><span class="label">Dirección:</span> {{ $proveedor->direccion }}</p>
                <p><span class="label">Ciudad:</span> {{ $proveedor->ciudad }}</p>
                <p><span class="label">Fecha de Registro:</span> {{ $proveedor->fecha_registro }}</p>

                <h5 class="text-rosado fw-bold mt-4 mb-3">Datos del Proveedor</h5>
                <p><span class="label">Nombre:</span> {{ $proveedor->nombre_proveedor }}</p>
                <p><span class="label">Teléfono:</span> {{ $proveedor->telefono }}</p>
            </div>

            <a href="{{ route('proveedores.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
