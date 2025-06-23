<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Historial de llamados de atención</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 1rem 0;
        }

        .container {
            max-width: 900px;
            background: rgba(255, 255, 255, 0.95);
            margin: 0 auto;
            padding: 1.5rem 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInUp 0.6s ease-out;
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
            width: 120px;
            height: 3px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .employee-card {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem 2rem;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 8px 25px rgba(123, 42, 141, 0.3);
            animation: slideInDown 0.8s ease-out;
            justify-content: space-between;
        }

        .employee-info {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 180px;
            flex: 1 1 auto;
        }

        .employee-info i {
            font-size: 1.1rem;
            opacity: 0.9;
            min-width: 20px;
        }

        .call-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 1rem 1.3rem;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(228, 0, 124, 0.15);
            border: 1px solid rgba(228, 0, 124, 0.1);
            transition: transform 0.2s ease;
        }

        .call-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(228, 0, 124, 0.3);
        }

        .call-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.6rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: #7B2A8D;
            margin-bottom: 0.8rem;
        }

        .call-grid .label {
            font-weight: 700;
            color: #E4007C;
            margin-right: 4px;
        }

        .badge-beauty {
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .badge-advertencia {
            background: linear-gradient(135deg, #ffc107 0%, #ff8f00 100%);
            color: #333;
        }

        .badge-suspension {
            background: linear-gradient(135deg, #17a2b8 0%, #0c7b8e 100%);
            color: white;
        }

        .badge-despido {
            background: linear-gradient(135deg, #dc3545 0%, #a71e2a 100%);
            color: white;
        }

        .badge-na {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }
        .call-text strong {
            color: #E4007C;
            font-weight: 700;
        }
        .call-text span {
            font-weight: 500;
            color: #333;
        }


        /* Botón regresar */
        .btn-beauty {
            padding: 0.7rem 1.8rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            margin-top: 1.2rem;
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            color: white;
        }

        /* Animaciones */
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

<div class="container">
    <div class="beauty-header">
        <h3><i class="fas fa-history"></i> Historial de llamados de atención</h3>
    </div>

    <!-- Info empleado -->
    <div class="employee-card">
        <div class="employee-info">
            <i class="fas fa-user"></i>
            <span>Empleado: {{ $empleado->nombre_empleado }}</span>
        </div>
        <div class="employee-info">
            <i class="fas fa-id-card"></i>
            <span>Identidad: {{ $empleado->numero_identidad }}</span>
        </div>
        <div class="employee-info">
            <i class="fas fa-phone"></i>
            <span>Teléfono: {{ $empleado->telefono }}</span>
        </div>
    </div>

    @if($empleado->llamados->isEmpty())
        <div style="text-align: center; font-weight: 600; color: #7B2A8D; margin-top: 2rem;">
            <i class="fas fa-info-circle"></i> Este empleado no tiene llamados de atención registrados.
        </div>
    @else
        @foreach($empleado->llamados as $index => $llamado)
            <div class="call-card" title="Llamado #{{ $index + 1 }}">
                <div class="call-grid">
                    <div><span class="label">Fecha</span> {{ \Carbon\Carbon::parse($llamado->fecha)->format('d/m/Y') }}</div>
                    <div>
                        <span class="label">Sanción</span>
                        @if($llamado->sancion === 'advertencia verbal')
                            <span class="badge-beauty badge-advertencia"><i class="fas fa-exclamation-triangle"></i> Advertencia verbal</span>
                        @elseif($llamado->sancion === 'advertencia escrita')
                            <span class="badge-beauty badge-advertencia"><i class="fas fa-exclamation-circle"></i> Advertencia escrita</span>
                        @elseif($llamado->sancion === 'suspensión 1 día')
                            <span class="badge-beauty badge-suspension"><i class="fas fa-pause-circle"></i> Suspensión 1 día</span>
                        @elseif($llamado->sancion === 'suspensión 3 días')
                            <span class="badge-beauty badge-suspension"><i class="fas fa-pause-circle"></i> Suspensión 3 días</span>
                        @elseif($llamado->sancion === 'descuento salario')
                            <span class="badge-beauty badge-suspension"><i class="fas fa-money-bill-wave"></i> Descuento salario</span>
                        @elseif($llamado->sancion === 'despido')
                            <span class="badge-beauty badge-despido"><i class="fas fa-times-circle"></i> Despido</span>
                        @else
                            <span class="badge-beauty badge-na"><i class="fas fa-question-circle"></i> N/A</span>
                        @endif
                    </div>
                    <div><span class="label">Número</span> {{ $llamado->numero_llamado }}</div>
                </div>

                <div class="call-text">
                    <strong>Motivo:</strong> <span>{{ $llamado->motivo }}</span>
                </div>
                <div class="call-text">
                    <strong>Descripción:</strong> <span>{{ $llamado->descripcion ?? '-' }}</span>
                </div>
                <div class="call-text">
                    <strong>Lugar:</strong> <span>{{ $llamado->lugar }}</span>
                </div>
                <div class="call-text">
                    <strong>Testigos:</strong> <span>{{ $llamado->testigos ?? '-' }}</span>
                </div>
                <div class="call-text">
                    <strong>Otros empleados involucrados:</strong> <span>{{ $llamado->otros_empleados_involucrados ?? '-' }}</span>
                </div>
            </div>
                @endforeach
    @endif

    <a href="{{ route('empleados.show', $empleado->id) }}" class="btn-beauty">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
</div>

</body>
</html>
