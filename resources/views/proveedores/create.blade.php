<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Proveedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
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
        .btn-secondary {
            background-color: #3a006b;
            border-color: #3a006b;
        }
        .btn-secondary:hover {
            background-color: #e4007c;
            border-color: #e4007c;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="form-container">
                <h2 class="mb-4 text-center" style="color: #c97bff;">Crear Nuevo Proveedor</h2>

                <form method="POST" action="{{ route('proveedores.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- SECCIÓN: DATOS DE LA EMPRESA -->
                    <h5 class="text-rosado fw-bold">Datos de la Empresa</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre de la Empresa</label>
                            <select id="nombre_empresa_select" class="form-select mb-2">
                                <option value="">-- Seleccionar o escribir nueva --</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa }}" {{ old('nombre_empresa') == $empresa ? 'selected' : '' }}>{{ $empresa }}</option>
                                @endforeach
                            </select>
                            <input type="text" id="nombre_empresa_input" name="nombre_empresa"
                                   value="{{ old('nombre_empresa') }}"
                                   maxlength="25"
                                   class="form-control @error('nombre_empresa') is-invalid @enderror"
                                   placeholder="Escribe el nombre de la empresa" required>
                            @error('nombre_empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="empleado_encargado" class="form-label">Nombre del Empleado Encargado</label>
                            <input type="text" id="empleado_encargado" name="empleado_encargado"
                                   value="{{ old('empleado_encargado') }}"
                                   required maxlength="35"
                                   class="form-control @error('empleado_encargado') is-invalid @enderror">
                            @error('empleado_encargado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="telefono_empleado_encargado" class="form-label">Teléfono del Encargado</label>
                            <input type="text" id="telefono_empleado_encargado" name="telefono_empleado_encargado"
                                   value="{{ old('telefono_empleado_encargado') }}"
                                   required pattern="\d{8}" maxlength="8" inputmode="numeric"
                                   title="Debe contener 8 dígitos distintos"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                   class="form-control @error('telefono_empleado_encargado') is-invalid @enderror">
                            @error('telefono_empleado_encargado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" id="direccion" name="direccion"
                                   value="{{ old('direccion') }}"
                                   required maxlength="100"
                                   class="form-control @error('direccion') is-invalid @enderror">
                            @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad"
                                   value="{{ old('ciudad') }}"
                                   required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" maxlength="25"
                                   title="Solo letras y espacios"
                                   class="form-control @error('ciudad') is-invalid @enderror">
                            @error('ciudad')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="imagen" class="form-label">Imagen del Proveedor (opcional)</label>
                            <input type="file" id="imagen" name="imagen"
                                   accept="image/*"
                                   class="form-control @error('imagen') is-invalid @enderror">
                            @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- SECCIÓN: DATOS DEL PROVEEDOR -->
                    <h5 class="text-rosado fw-bold mt-4">Datos del Proveedor</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_proveedor" class="form-label">Nombre del Proveedor</label>
                            <input type="text" id="nombre_proveedor" name="nombre_proveedor"
                                   value="{{ old('nombre_proveedor') }}"
                                   required maxlength="35"
                                   class="form-control @error('nombre_proveedor') is-invalid @enderror">
                            @error('nombre_proveedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" id="telefono" name="telefono"
                                   value="{{ old('telefono') }}"
                                   required pattern="\d{8}" maxlength="8" inputmode="numeric"
                                   title="Debe contener 8 dígitos distintos"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                   class="form-control @error('telefono') is-invalid @enderror">
                            @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Crear Proveedor</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const select = document.getElementById('nombre_empresa_select');
    const input = document.getElementById('nombre_empresa_input');

    select.addEventListener('change', function () {
        input.value = this.value || '';
    });
</script>
</body>
</html>
