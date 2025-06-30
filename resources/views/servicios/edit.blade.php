<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar servicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
            color: #333;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        h2 {
            text-align: center;
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
        }

        .form-label {
            color: #7B2A8D;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            background-color: white;
            color: black;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.25);
        }

        .btn-primary,
        .btn-secondary {
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6a267f 0%, #c3006a 100%);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
            color: white;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border: 2px solid #dc3545;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
        }

        .btn-group-left {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 1.5rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
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

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-8">
            <div class="form-container">
                <h2>Editar servicio</h2>
                <form id="servicioForm" method="POST" action="{{ route('servicios.update', $servicio->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Código del servicio -->
                        <div class="col-md-6">
                            <label for="codigo_servicio" class="form-label">Código del servicio</label>
                            <input type="text" id="codigo_servicio" name="codigo_servicio" maxlength="8"
                                   class="form-control @error('codigo_servicio') is-invalid @enderror"
                                   value="{{ old('codigo_servicio', $servicio->codigo_servicio) }}"
                                   placeholder="Ejemplo: MANI-001" />
                            @error('codigo_servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nombre del servicio -->
                        <div class="col-md-6">
                            <label for="nombre_servicio" class="form-label">Nombre del servicio</label>
                            <input type="text" id="nombre_servicio" name="nombre_servicio" maxlength="40"
                                   class="form-control @error('nombre_servicio') is-invalid @enderror"
                                   value="{{ old('nombre_servicio', $servicio->nombre_servicio) }}"
                                   placeholder="Ingrese el nombre del servicio" />
                            @error('nombre_servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tipo de servicio -->
                        <div class="col-md-6">
                            <label for="tipo_servicio" class="form-label">Tipo de servicio</label>
                            <select id="tipo_servicio" name="tipo_servicio" class="form-select @error('tipo_servicio') is-invalid @enderror">
                                <option value="">Seleccione tipo de servicio</option>
                                <option value="manicure" {{ old('tipo_servicio', $servicio->tipo_servicio) == 'manicure' ? 'selected' : '' }}>Manicure</option>
                                <option value="pedicure" {{ old('tipo_servicio', $servicio->tipo_servicio) == 'pedicure' ? 'selected' : '' }}>Pedicure</option>
                                <option value="cabello" {{ old('tipo_servicio', $servicio->tipo_servicio) == 'cabello' ? 'selected' : '' }}>Cabello</option>
                            </select>
                            @error('tipo_servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Categoría del servicio -->
                        <div class="col-md-6">
                            <label for="categoria_servicio" class="form-label">Categoría del servicio</label>
                            <select id="categoria_servicio" name="categoria_servicio" class="form-select @error('categoria_servicio') is-invalid @enderror">
                                <option value="">Seleccione categoría</option>
                                <option value="basico" {{ old('categoria_servicio', $servicio->categoria_servicio) == 'basico' ? 'selected' : '' }}>Básico</option>
                                <option value="intermedio" {{ old('categoria_servicio', $servicio->categoria_servicio) == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                <option value="avanzado" {{ old('categoria_servicio', $servicio->categoria_servicio) == 'avanzado' ? 'selected' : '' }}>Avanzado</option>
                            </select>
                            @error('categoria_servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Precio base -->
                        <div class="col-md-3">
                            <label for="precio_base" class="form-label">Precio (Lps)</label>
                            <input type="text" id="precio_base" name="precio_base" maxlength="4" inputmode="numeric"
                                   class="form-control @error('precio_base') is-invalid @enderror"
                                   value="{{ old('precio_base', $servicio->precio_base) }}"
                                   placeholder="Precio en Lempiras" />
                            @error('precio_base')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duración estimada -->
                        <div class="col-md-3">
                            <label for="duracion_estimada" class="form-label">Duración (min)</label>
                            <input type="text" id="duracion_estimada" name="duracion_estimada" maxlength="3" inputmode="numeric"
                                   class="form-control @error('duracion_estimada') is-invalid @enderror"
                                   value="{{ old('duracion_estimada', $servicio->duracion_estimada) }}"
                                   placeholder="Duración en minutos" />
                            @error('duracion_estimada')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="col-md-6">
                            <label for="estado" class="form-label">Estado del servicio</label>
                            <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                                <option value="">Seleccione estado</option>
                                <option value="activo" {{ old('estado', $servicio->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado', $servicio->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                <option value="temporalmente_suspendido" {{ old('estado', $servicio->estado) == 'temporalmente_suspendido' ? 'selected' : '' }}>Suspendido temporalmente</option>
                            </select>
                            @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="col-12">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="4" maxlength="200"
                                      class="form-control @error('descripcion') is-invalid @enderror"
                                      placeholder="Describe el servicio">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="btn-group-left mt-4">
                        <a href="{{ route('servicios.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
