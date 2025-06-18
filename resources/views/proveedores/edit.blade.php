<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E6E6FA;
        }
        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            color: black;
        }
        .form-label {
            color: #e4007c;
        }
        .btn-primary,
        .btn-secondary,
        .btn-danger {
            background-color: #3a006b;
            border-color: #3a006b;
            color: white;
        }
        .btn-secondary:hover,
        .btn-danger:hover {
            background-color: #e4007c;
            border-color: #e4007c;
            color: white;
        }
        .btn-group-left {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-start;
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

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="form-container">
                <h2 class="mb-4 text-center" style="color: #c97bff;">Editar Proveedor</h2>

                <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Datos empresa -->
                    <h5 class="text-rosado fw-bold">Datos de la empresa</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_empresa" class="form-label">Nombre de la empresa</label>
                            <input type="text" name="nombre_empresa" id="nombre_empresa"
                                   class="form-control @error('nombre_empresa') is-invalid @enderror"
                                   value="{{ old('nombre_empresa', $proveedor->nombre_empresa) }}"
                                   required maxlength="50"
                                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                                   title="Solo letras y espacios.">
                            @error('nombre_empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefono_empleado_encargado" class="form-label">Teléfono de la empresa</label>
                            <input type="text" name="telefono_empleado_encargado" id="telefono_empleado_encargado"
                                   class="form-control @error('telefono_empleado_encargado') is-invalid @enderror"
                                   value="{{ old('telefono_empleado_encargado', $proveedor->telefono_empleado_encargado) }}"
                                   required maxlength="8" pattern="^\d{8}$"
                                   inputmode="numeric" title="Debe contener 8 dígitos, iniciar con 3, 8 o 9 y no repetir todos iguales."
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            @error('telefono_empleado_encargado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" name="direccion" id="direccion"
                                   class="form-control @error('direccion') is-invalid @enderror"
                                   value="{{ old('direccion', $proveedor->direccion) }}"
                                   required maxlength="100">
                            @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" name="ciudad" id="ciudad"
                                   class="form-control @error('ciudad') is-invalid @enderror"
                                   value="{{ old('ciudad', $proveedor->ciudad) }}"
                                   required maxlength="25"
                                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                                   title="Solo letras y espacios.">
                            @error('ciudad')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen (opcional)</label>
                        <input type="file" name="imagen" id="imagen"
                               class="form-control @error('imagen') is-invalid @enderror"
                               accept="image/*">
                        @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if($proveedor->imagen)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $proveedor->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        @endif
                    </div>

                    <!-- Datos vendedor -->
                    <h5 class="text-rosado fw-bold mt-4">Datos del vendedor</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_proveedor" class="form-label">Nombre del vendedor</label>
                            <input type="text" name="nombre_proveedor" id="nombre_proveedor"
                                   class="form-control @error('nombre_proveedor') is-invalid @enderror"
                                   value="{{ old('nombre_proveedor', $proveedor->nombre_proveedor) }}"
                                   required maxlength="35"
                                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                                   title="Solo letras y espacios.">
                            @error('nombre_proveedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono"
                                   class="form-control @error('telefono') is-invalid @enderror"
                                   value="{{ old('telefono', $proveedor->telefono) }}"
                                   required maxlength="8" pattern="^\d{8}$"
                                   inputmode="numeric" title="Debe contener 8 dígitos, iniciar con 3, 8 o 9 y no repetir todos iguales."
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Botones alineados a la izquierda -->
                    <div class="btn-group-left mt-4">
                        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
