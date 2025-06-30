<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor</title>
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

        .form-container {
            max-width: 900px;
            background: rgba(255, 255, 255, 0.95);
            margin: 0 auto;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInUp 0.6s ease-out;
        }

        .beauty-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .beauty-header h3 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.6rem;
            margin: 0;
        }

        .beauty-header::after {
            content: '';
            display: block;
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 10px auto;
            border-radius: 2px;
        }

        label {
            font-weight: 600;
            color: #4a4a4a;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            background: rgba(255, 255, 255, 0.85);
        }

        .form-control:focus, .form-select:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 1.5rem;
            color: #7B2A8D;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 1rem;
            margin-top: 2rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            padding-top: 1rem;
        }

        .btn-beauty {
            padding: 0.7rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-beauty {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
        }

        .btn-primary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228, 0, 124, 0.4);
        }

        .btn-secondary-beauty {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        }

        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
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

<div class="form-container">
    <div class="beauty-header">
        <h3><i class="fas fa-edit"></i> Editar Proveedor</h3>
    </div>

    <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}" enctype="multipart/form-data" id="formProveedor" novalidate>
        @csrf
        @method('PUT')

        <div class="section-title"><i class="fas fa-building"></i> Datos de la Empresa</div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre_empresa"><i class="fas fa-industry"></i> Nombre de la empresa</label>
                <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control @error('nombre_empresa') is-invalid @enderror" value="{{ old('nombre_empresa', $proveedor->nombre_empresa) }}" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                @error('nombre_empresa')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="telefono_empleado_encargado"><i class="fas fa-phone"></i> Teléfono de la empresa</label>
                <input type="text" name="telefono_empleado_encargado" id="telefono_empleado_encargado" class="form-control @error('telefono_empleado_encargado') is-invalid @enderror" value="{{ old('telefono_empleado_encargado', $proveedor->telefono_empleado_encargado) }}" maxlength="8" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                @error('telefono_empleado_encargado')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="direccion"><i class="fas fa-address-book"></i>Dirección</label>
                <textarea name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" maxlength="200" required style="min-height: 100px;">{{ old('direccion', $proveedor->direccion) }}</textarea>
                @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="ciudad"><i class="fas fa-city"></i> Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="form-control @error('ciudad') is-invalid @enderror" value="{{ old('ciudad', $proveedor->ciudad) }}" maxlength="35" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                @error('ciudad')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="imagen"><i class="fas fa-image"></i> Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror" accept="image/*" />
            @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror
            @if($proveedor->imagen)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $proveedor->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="max-width: 150px;">
                </div>
            @endif
        </div>

        <div class="section-title"><i class="fas fa-user"></i> Datos del Vendedor</div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre_proveedor"><i class="fas fa-user"></i> Nombre del vendedor</label>
                <input type="text" name="nombre_proveedor" id="nombre_proveedor" class="form-control @error('nombre_proveedor') is-invalid @enderror" value="{{ old('nombre_proveedor', $proveedor->nombre_proveedor) }}" maxlength="50" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" required />
                @error('nombre_proveedor')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="telefono"><i class="fas fa-phone"></i> Teléfono del vendedor</label>
                <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $proveedor->telefono) }}" maxlength="8" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('proveedores.index') }}" class="btn-beauty btn-secondary-beauty">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn-beauty btn-primary-beauty">
                <i class="fas fa-save"></i> Actualizar Proveedor
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

</body>
</html>

