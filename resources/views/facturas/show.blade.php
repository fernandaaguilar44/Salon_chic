<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalle de la Factura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            color: black;
            max-width: 1000px;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 2rem;
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

        .beauty-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .beauty-header h2 {
            color: #7B2A8D;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
        }

        .beauty-header::after {
            content: '';
            display: block;
            width: 120px;
            height: 3px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 15px auto;
            border-radius: 2px;
        }

        .unified-details {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(123, 42, 141, 0.1);
            border: 1px solid rgba(228, 0, 124, 0.1);
        }

        .section-divider {
            border-top: 2px solid rgba(228, 0, 124, 0.1);
            margin: 2rem 0;
            position: relative;
        }

        .section-divider::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
        }

        .subsection-title {
            color: #E4007C;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
        }

        .subsection-title i {
            margin-right: 10px;
            color: #7B2A8D;
        }

        dl.row dt {
            font-weight: 600;
            color: #7B2A8D;
            margin-bottom: 0.7rem;
            padding-left: 1rem;
        }

        dl.row dd {
            margin-bottom: 0.7rem;
            color: #333;
        }

        dl.row dd i {
            margin-right: 8px;
            color: #E4007C;
        }

        .product-list-item {
            padding: 1rem;
            border: 1px solid rgba(228, 0, 124, 0.1);
            border-radius: 10px;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .product-list-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(123, 42, 141, 0.1);
        }

        .product-list-item p {
            margin-bottom: 0.5rem;
        }

        .product-list-item p strong {
            color: #7B2A8D;
            font-weight: 600;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .summary-card {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(228, 0, 124, 0.1);
        }

        .summary-card h5 {
            color: #7B2A8D;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .summary-card p {
            color: #E4007C;
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }

        .button-group {
            text-align: center;
            margin-top: 2rem;
        }

        .btn-beauty {
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-secondary-beauty {
            background: linear-gradient(135deg, #7b2a8d 0%, #ff69b4 100%);
            color: white;
        }

        .btn-secondary-beauty:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(123, 42, 141, 0.4);
            color: white;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .unified-details {
                padding: 1.5rem;
            }

            dl.row dt,
            dl.row dd {
                padding-left: 0.5rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-receipt"></i> Detalle de la Factura</h2>
    </div>

    <div class="unified-details">
        <!-- Información General -->
        <div class="subsection-title">
            <i class="fas fa-info-circle"></i> Información General
        </div>
        <dl class="row">
            <dt class="col-sm-4"><i class="fas fa-file-invoice"></i> Número de Factura:</dt>
            <dd class="col-sm-8">{{ $factura->numero_factura }}</dd>

            <dt class="col-sm-4"><i class="fas fa-user-tie"></i> Proveedor:</dt>
            <dd class="col-sm-8">{{ $factura->proveedor->nombre_empresa }}</dd>

            <dt class="col-sm-4"><i class="fas fa-calendar-alt"></i> Fecha de Emisión:</dt>
            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y') }}</dd>

            <dt class="col-sm-4"><i class="fas fa-clipboard-list"></i> Cantidad de Ítems:</dt>
            <dd class="col-sm-8">{{ $factura->detalles->count() }}</dd>

            @if($factura->notas)
                <dt class="col-sm-4"><i class="fas fa-sticky-note"></i> Notas:</dt>
                <dd class="col-sm-8">{{ $factura->notas }}</dd>
            @endif
        </dl>

        <div class="section-divider"></div>

        <!-- Productos -->
        <div class="subsection-title">
            <i class="fas fa-boxes"></i> Productos Comprados
        </div>
        @forelse($factura->detalles as $detalle)
            <div class="product-list-item">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Producto:</strong> {{ $detalle->producto->nombre }}</p>
                        <p><strong>Cantidad:</strong> {{ $detalle->cantidad }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Precio Unitario:</strong> L {{ number_format($detalle->precio_unitario, 2) }}</p>
                        <p><strong>Subtotal:</strong> L {{ number_format($detalle->subtotal, 2) }}</p>
                    </div>
                </div>
                <p>
                    <strong>Tipo de Impuesto:</strong>
                    <span class="badge {{ $detalle->tipo_impuesto === 'exonerado' ? 'bg-info' : ($detalle->tipo_impuesto === 'exento' ? 'bg-secondary' : 'bg-success') }}">
                        {{ ucfirst($detalle->tipo_impuesto) }}
                    </span>
                </p>
            </div>
        @empty
            <div class="text-center text-muted p-4">
                <i class="fas fa-box-open fa-2x mb-2"></i>
                <p>No hay productos en esta factura.</p>
            </div>
        @endforelse

        <div class="section-divider"></div>

        <!-- Totales -->
        <div class="subsection-title">
            <i class="fas fa-calculator"></i> Resumen de Totales
        </div>

        <div class="summary-grid">
            <div class="summary-card">
                <h5>Importe Exonerado</h5>
                <p>L {{ number_format($factura->importe_exonerado, 2) }}</p>
            </div>
            <div class="summary-card">
                <h5>Importe Exento</h5>
                <p>L {{ number_format($factura->importe_exento, 2) }}</p>
            </div>
            <div class="summary-card">
                <h5>Importe Gravado (15%)</h5>
                <p>L {{ number_format($factura->importeGravado15, 2) }}</p>
            </div>
            <div class="summary-card">
                <h5>ISV (15%)</h5>
                <p>L {{ number_format($factura->isv15, 2) }}</p>
            </div>
        </div>

        <div class="section-divider"></div>

        <dl class="row">
            <dt class="col-sm-6"><i class="fas fa-dollar-sign"></i> <strong>GRAN TOTAL:</strong></dt>
            <dd class="col-sm-6"><strong style="color: #E4007C; font-size: 1.3rem;">L {{ number_format($factura->total, 2) }}</strong></dd>
        </dl>
    </div>

    <div class="button-group">
        <a href="{{ route('facturas.index') }}" class="btn btn-beauty btn-secondary-beauty">
            <i class="fas fa-arrow-left"></i>
            Volver a la lista
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
