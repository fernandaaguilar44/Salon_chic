<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear nuevo servicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding-top: 0.5rem; /* <-- Menos espacio arriba */
            padding-bottom: 2rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
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
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .form-label i {
            font-size: 0.95rem;
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
        .btn {
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #6a267f 0%, #c3006a 100%);
            color: white;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            border: none;
            color: white;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
        }
        .btn-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.44) 0%, #a71e2a 100%);
            border: none;
            color: white;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, rgba(189, 33, 48, 0.41) 0%, #861c26 100%);
        }
        .invalid-feedback {
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
            display: block;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="form-container">
                <h2><i class="fas fa-cogs"></i> Crear un nuevo servicio</h2>

                <form method="POST" action="{{ route('servicios.store') }}" enctype="multipart/form-data" id="servicioForm">
                    @csrf

                    <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="codigo_servicio" class="form-label">
                            <i class="fas fa-barcode"></i> Código del servicio
                        </label>
                        <input type="text" id="codigo_servicio" name="codigo_servicio" oninput="this.value = this.value.toUpperCase()" maxlength="7"  class="form-control @error('codigo_servicio') is-invalid @enderror" value="{{ old('codigo_servicio') }}" placeholder="Código único" />
                        @error('codigo_servicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>


                        <div class="col-12 col-md-6">
                            <label for="nombre_servicio" class="form-label">
                                <i class="fas fa-tag"></i> Nombre del servicio
                            </label>
                            <input type="text" id="nombre_servicio" name="nombre_servicio" maxlength="50"  class="form-control @error('nombre_servicio') is-invalid @enderror" value="{{ old('nombre_servicio') }}" placeholder="Nombre del servicio" />
                            @error('nombre_servicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>





                        <div class="col-12 col-md-4">
                            <label for="tipo_servicio" class="form-label">
                                <i class="fas fa-list"></i> Tipo de servicio
                            </label>
                            <select id="tipo_servicio" name="tipo_servicio" class="form-select @error('tipo_servicio') is-invalid @enderror">
                                <option value="">Seleccione un tipo</option>
                                <option value="cabello" {{ old('tipo_servicio') == 'cabello' ? 'selected' : '' }}>Cabello</option>
                                <option value="manicura" {{ old('tipo_servicio') == 'manicura' ? 'selected' : '' }}>Manicura</option>
                                <option value="pedicura" {{ old('tipo_servicio') == 'pedicura' ? 'selected' : '' }}>Pedicura</option>
                            </select>
                            @error('tipo_servicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="categoria_servicio" class="form-label">
                                <i class="fas fa-tags"></i> Categoría del servicio
                            </label>
                            <select name="categoria_servicio" id="categoria_servicio" class="form-control @error('categoria_servicio') is-invalid @enderror">
                                <option value="">-- Seleccione una categoría --</option>
                                <option value="basico" {{ old('categoria_servicio') == 'basico' ? 'selected' : '' }}>Básico</option>
                                <option value="intermedio" {{ old('categoria_servicio') == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                <option value="avanzado" {{ old('categoria_servicio') == 'avanzado' ? 'selected' : '' }}>Avanzado</option>
                            </select>
                            @error('categoria_servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-12 col-md-4">
                            <label for="precio_base" class="form-label">
                                <i class="fas fa-dollar-sign"></i> Precio base
                            </label>
                            <input type="text"  id="precio_base" name="precio_base" class="form-control @error('precio_base') is-invalid @enderror" value="{{ old('precio_base') }}"
                                   placeholder="Precio en Lempiras"  maxlength="4" inputmode="numeric" />
                            @error('precio_base') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="duracion_estimada" class="form-label">
                                <i class="fas fa-clock"></i> Duración estimada (minutos)
                            </label>
                            <input type="text" min="0" id="duracion_estimada" name="duracion_estimada" class="form-control @error('duracion_estimada') is-invalid @enderror" value="{{ old('duracion_estimada') }}"
                                   placeholder="Duración en minutos"  maxlength="3" inputmode="numeric"  />
                            @error('duracion_estimada') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>



                        <!-- DESCRIPCIÓN al final -->
                        <div class="col-12">
                            <label for="descripcion" class="form-label">
                                <i class="fas fa-align-left"></i> Descripción
                            </label>
                            <textarea id="descripcion" name="descripcion" maxlength="200" rows="4" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripción detallada">{{ old('descripcion') }}</textarea>
                            @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>



                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="{{ route('servicios.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="reset" class="btn btn-danger" id="btnLimpiar">
                            <i class="fas fa-eraser"></i> Limpiar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        // Campos a validar
        const campos = ['precio_base', 'duracion_estimada'];

        campos.forEach(function(campoId) {
            const input = document.getElementById(campoId);

            input.addEventListener('input', function () {
                // Elimina ceros al inicio
                this.value = this.value.replace(/^0+/, '');
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('codigo_servicio');
        let previousValue = '';

        input.addEventListener('input', function (e) {
            let val = e.target.value.toUpperCase();

            // Permitir sólo letras, números y guion
            val = val.replace(/[^A-Z0-9-]/g, '');

            // Contar letras (sin contar guion)
            const letras = val.replace(/[^A-Z]/g, '');

            // Detectar si el usuario está borrando
            const isDeleting = val.length < previousValue.length;

            // Si está borrando o menos de 3 letras, no ponemos guion automático
            if (isDeleting || letras.length < 3) {
                previousValue = val;
                e.target.value = val;
                return;
            }

            // Si ya hay 3 letras y no hay guion en la posición correcta, lo insertamos
            if (val[3] !== '-') {
                val = val.slice(0,3) + '-' + val.slice(3);
            }

            // Limitar a máximo 7 caracteres (3 letras + guion + 3 números)
            val = val.slice(0,7);

            previousValue = val;
            e.target.value = val;
        });
    });



    document.getElementById('btnLimpiar').addEventListener('click', function (e) {
        e.preventDefault(); // Prevenir comportamiento por defecto

        // Limpiar cada campo individualmente
        document.getElementById('nombre_servicio').value = '';
        document.getElementById('codigo_servicio').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('tipo_servicio').selectedIndex = 0;       // resetear select
        document.getElementById('categoria_servicio').selectedIndex = 0;  // resetear select
        document.getElementById('precio_base').value = '';
        document.getElementById('duracion_estimada').value = '';


        // Si tienes un campo 'estado' oculto o visible, lo limpias así (opcional)
        const estado = document.getElementById('estado');
        if (estado) {
            if (estado.tagName === 'SELECT') {
                estado.selectedIndex = 0;
            } else {
                estado.value = '';
            }
        }

        // Remover todas las clases de error
        const campos = [
            'nombre_servicio', 'codigo_servicio', 'descripcion', 'tipo_servicio', 'categoria_servicio',
            'precio_base', 'duracion_estimada',  'estado'
        ];

        campos.forEach(campoId => {
            const elemento = document.getElementById(campoId);
            if (elemento) {
                elemento.classList.remove('is-invalid');
            }
        });

        // Ocultar y limpiar mensajes de error
        document.querySelectorAll('.invalid-feedback').forEach(feedback => {
            feedback.style.display = 'none';
            feedback.textContent = ''; // Limpiar texto para que no aparezca al volver a mostrar
        });

        console.log('Formulario de servicios limpiado'); // Para debug
    });

</script>
</body>
</html>
