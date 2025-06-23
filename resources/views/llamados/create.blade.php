<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar llamado de atención</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            padding: 1.8rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .beauty-header {
            text-align: center;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .beauty-header h3 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.6rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
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

        .employee-card {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            text-align: center;
            box-shadow: 0 8px 25px rgba(123, 42, 141, 0.3);
        }

        .employee-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .employee-info i {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .employee-info span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        label {
            font-weight: 600;
            color: #4a4a4a;
            margin-bottom: 6px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        label i {
            color: #7B2A8D;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus, .form-select:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 0.2rem rgba(228, 0, 124, 0.15);
            background: white;
        }

        .compact-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .triple-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .checkbox-container {
            background: rgba(123, 42, 141, 0.05);
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1rem;
            max-height: 140px;
            overflow-y: auto;
        }

        .checkbox-container::-webkit-scrollbar {
            width: 6px;
        }

        .checkbox-container::-webkit-scrollbar-track {
            background: rgba(228, 0, 124, 0.1);
            border-radius: 3px;
        }

        .checkbox-container::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #E4007C, #7B2A8D);
            border-radius: 3px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            padding: 4px 8px;
            margin-bottom: 4px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.85rem;
        }

        .checkbox-item:hover {
            background: rgba(228, 0, 124, 0.1);
        }

        .checkbox-item input {
            margin-right: 8px;
            accent-color: #E4007C;
            transform: scale(1.1);
        }

        .textarea-compact {
            resize: vertical;
            min-height: 60px !important;
            max-height: 100px;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 2px solid rgba(228, 0, 124, 0.1);
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
            text-decoration: none;
        }

        .btn-primary-beauty {
            background: linear-gradient(135deg, #E4007C 0%, #7B2A8D 100%);
            color: white;
        }

        .btn-primary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228, 0, 124, 0.4);
            color: white;
        }

        .btn-secondary-beauty {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            color: white;
        }

        .form-floating {
            position: relative;
        }

        .form-floating > .form-control {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
            padding: 1rem 0.75rem 0.25rem 0.75rem;
        }

        .form-floating > label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            padding: 1rem 0.75rem;
            pointer-events: none;
            border: 1px solid transparent;
            transform-origin: 0 0;
            transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                margin: 0 0.5rem;
                padding: 1.2rem;
            }

            .compact-row, .triple-row {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }

            .employee-card {
                grid-template-columns: 1fr;
                gap: 0.5rem;
                text-align: left;
            }

            .action-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-beauty {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .beauty-header h3 {
                font-size: 1.3rem;
            }

            .checkbox-container {
                max-height: 120px;
            }
        }

        /* Animaciones */
        .form-container {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .employee-card {
            animation: slideInDown 0.8s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="beauty-header">
        <h3><i class="fas fa-exclamation-triangle"></i> Registro de llamado de atención</h3>
    </div>

    <form id="llamadoForm" action="{{ route('llamados.store') }}" method="POST">
        @csrf
        <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">

        <!-- Info empleado -->
        <div class="employee-card">
            <div class="employee-info">
                <i class="fas fa-user"></i>
                <span>{{ $empleado->nombre_empleado }}</span>
            </div>
            <div class="employee-info">
                <i class="fas fa-id-card"></i>
                <span>{{ $empleado->numero_identidad }}</span>
            </div>
            <div class="employee-info">
                <i class="fas fa-phone"></i>
                <span>{{ $empleado->telefono }}</span>
            </div>
        </div>

        <!-- Primera fila: Sanción, Motivo, Fecha -->
        <div class="triple-row">
            <div>
                <label for="sancion"><i class="fas fa-gavel"></i> Sanción</label>
                <select name="sancion" id="sancion" class="form-select @error('sancion') is-invalid @enderror">
                    <option value="">Seleccione una sanción</option>
                    <option value="advertencia verbal" {{ old('sancion') == 'advertencia verbal' ? 'selected' : '' }}>Advertencia verbal</option>
                    <option value="advertencia escrita" {{ old('sancion') == 'advertencia escrita' ? 'selected' : '' }}>Advertencia escrita</option>
                    <option value="suspensión 1 día" {{ old('sancion') == 'suspensión 1 día' ? 'selected' : '' }}>Suspensión 1 día</option>
                    <option value="suspensión 3 días" {{ old('sancion') == 'suspensión 3 días' ? 'selected' : '' }}>Suspensión 3 días</option>
                    <option value="descuento salario" {{ old('sancion') == 'descuento salario' ? 'selected' : '' }}>Descuento salario</option>
                    <option value="despido" {{ old('sancion') == 'despido' ? 'selected' : '' }}>Despido</option>
                </select>
                @error('sancion') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="motivo"><i class="fas fa-clipboard-list"></i> Motivo</label>
                <input type="text" name="motivo" id="motivo" class="form-control @error('motivo') is-invalid @enderror" maxlength="70" value="{{ old('motivo') }}" placeholder="Motivo principal">
                @error('motivo') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="fecha"><i class="fas fa-calendar-alt"></i> Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', date('Y-m-d')) }}">
                @error('fecha') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Segunda fila: Lugar y Testigos -->
        <div class="compact-row">
            <div>
                <label for="lugar"><i class="fas fa-map-marker-alt"></i> Lugar</label>
                <textarea name="lugar" id="lugar" class="form-control textarea-compact @error('lugar') is-invalid @enderror" maxlength="100" rows="2" placeholder="Área del salón o ubicación">{{ old('lugar') }}</textarea>
                @error('lugar') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="testigos"><i class="fas fa-users"></i> Testigos</label>
                <textarea name="testigos" id="testigos" class="form-control textarea-compact @error('testigos') is-invalid @enderror" maxlength="150" rows="2" placeholder="Nombres de testigos">{{ old('testigos') }}</textarea>
                @error('testigos') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Tercera fila: Empleados involucrados y Descripción -->
        <div class="compact-row">
            <div>
                <label><i class="fas fa-user-friends"></i> Otros empleados involucrados</label>
                <div class="checkbox-container">
                    @foreach($empleados as $emp)
                        @if($empleado->id !== $emp->id)
                            <div class="checkbox-item">
                                <input type="checkbox" name="otros_empleados_involucrados[]" value="{{ $emp->id }}" id="emp_{{ $emp->id }}"
                                        {{ (is_array(old('otros_empleados_involucrados')) && in_array($emp->id, old('otros_empleados_involucrados'))) ? 'checked' : '' }}>
                                <label for="emp_{{ $emp->id }}" style="margin: 0; font-weight: normal;">{{ $emp->nombre_empleado }}</label>
                            </div>
                        @endif
                    @endforeach

                </div>
                @error('otros_empleados_involucrados') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="descripcion"><i class="fas fa-edit"></i> Descripción detallada</label>
                <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4" maxlength="200" placeholder="Detalles del incidente...">{{ old('descripcion') }}</textarea>
                @error('descripcion') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="action-buttons">
            <a href="{{ route('empleados.show', $empleado->id) }}" class="btn-beauty btn-secondary-beauty">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="submit" class="btn-beauty btn-primary-beauty">
                <i class="fas fa-save"></i> Registrar llamado
            </button>
            <button id="btnLimpiar" class="btn-beauty btn-secondary-beauty" type="button">
                <i class="fas fa-eraser"></i> Limpiar
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('btnLimpiar').addEventListener('click', function () {
        const form = document.getElementById('llamadoForm');

        form.reset();

        // También limpiar todos los campos manualmente para evitar conflictos con "old()"
        const fields = ['sancion', 'motivo', 'fecha', 'lugar', 'testigos', 'descripcion'];
        fields.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = '';
        });

        // Desmarcar todos los checkboxes
        const checkboxes = form.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => checkbox.checked = false);

        // Quitar clases de error
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        // Eliminar mensajes de error
        form.querySelectorAll('.text-danger.small').forEach(el => el.remove());
    });
</script>


</body>
</html>
