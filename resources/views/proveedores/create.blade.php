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
            background-color: #e6e6fa;
            color: white;
        }
        .text-morado {
            color: #c97bff;
        }
        .text-rosado {
            color: #db2777;
        }
        .bg-rosado {
            background-color: #c97bff;
        }
        .bg-rosado:hover {
            background-color: #c97bff;
        }
        .bg-morado {
            background-color: #c97bff;
        }
        .bg-morado:hover {
            background-color: #c97bff;
        }
        .shadow-lg {
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="bg-white text-dark rounded shadow-lg p-5">
        <h2 class="text-center fw-bold mb-4 text-morado">Crear Nuevo Proveedor</h2>

        <form method="POST" action="{{ route('proveedores.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Fila 1 -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <label for="nombre_proveedor" class="form-label text-rosado fw-semibold">Nombre del Proveedor</label>
                    <input type="text" id="nombre_proveedor" name="nombre_proveedor"
                           value="{{ old('nombre_proveedor') }}"
                           required maxlength="35"
                           class="form-control @error('nombre_proveedor') is-invalid @enderror">
                    @error('nombre_proveedor')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="telefono" class="form-label text-rosado fw-semibold">Teléfono</label>
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

                <div class="col-md-4 mb-3">
                    <label for="direccion" class="form-label text-rosado fw-semibold">Dirección</label>
                    <input type="text" id="direccion" name="direccion"
                           value="{{ old('direccion') }}"
                           required maxlength="100"
                           class="form-control @error('direccion') is-invalid @enderror">
                    @error('direccion')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Fila 2 -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <label for="ciudad" class="form-label text-rosado fw-semibold">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad"
                           value="{{ old('ciudad') }}"
                           required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" maxlength="25"
                           title="Solo letras y espacios"
                           class="form-control @error('ciudad') is-invalid @enderror">
                    @error('ciudad')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="nombre_empresa" class="form-label text-rosado fw-semibold">Nombre de la Empresa</label>
                    <input type="text" id="nombre_empresa" name="nombre_empresa"
                           value="{{ old('nombre_empresa') }}"
                           required maxlength="25"
                           class="form-control @error('nombre_empresa') is-invalid @enderror">
                    @error('nombre_empresa')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="empleado_encargado" class="form-label text-rosado fw-semibold">Empleado Encargado</label>
                    <input type="text" id="empleado_encargado" name="empleado_encargado"
                           value="{{ old('empleado_encargado') }}"
                           required maxlength="35"
                           class="form-control @error('empleado_encargado') is-invalid @enderror">
                    @error('empleado_encargado')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Fila 3 -->
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label for="telefono_empleado_encargado" class="form-label text-rosado fw-semibold">Teléfono del Encargado</label>
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

                <div class="col-md-6 mb-3">
                    <label for="fecha_registro" class="form-label text-rosado fw-semibold">Fecha de Registro</label>
                    <input type="date" id="fecha_registro" name="fecha_registro"
                           value="{{ old('fecha_registro') }}"
                           max="{{ now()->toDateString() }}"
                           required
                           class="form-control @error('fecha_registro') is-invalid @enderror">
                    @error('fecha_registro')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Fila 4: Imagen -->
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label for="imagen" class="form-label text-rosado fw-semibold">Imagen del Proveedor (opcional)</label>
                    <input type="file" id="imagen" name="imagen"
                           accept="image/*"
                           class="form-control @error('imagen') is-invalid @enderror">
                    @error('imagen')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('proveedores.index') }}" class="btn bg-rosado text-white fw-semibold px-4">
                    Cancelar
                </a>
                <button type="submit" class="btn bg-morado text-white fw-semibold px-4">
                    Crear Proveedor
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
