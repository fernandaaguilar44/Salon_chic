<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalle de la Factura de Compra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ffeef8 0%, #f3e6f9 50%, #e8d5f2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px;
        }

        .invoice-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            color: black;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 15px 35px rgba(228, 0, 124, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            background: rgba(123, 42, 141, 0.05);
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
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

        .company-info, .invoice-meta {
            flex-basis: 48%;
        }

        .invoice-title {
            text-align: right;
            font-size: 2em;
            font-weight: bold;
            color: #7B2A8D;
            text-shadow: 0 2px 4px rgba(123, 42, 141, 0.1);
        }

        .section-title {
            font-weight: 700;
            font-size: 1.1em;
            color: #7B2A8D;
            margin-bottom: 10px;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 2px;
            background: linear-gradient(90deg, #E4007C, #7B2A8D);
            margin: 8px 0;
            border-radius: 2px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .details-grid div {
            color: #333;
            font-size: 0.95rem;
        }

        .details-grid strong {
            color: #7B2A8D;
        }

        .client-info {
            background: rgba(123, 42, 141, 0.05);
            border: 2px solid rgba(228, 0, 124, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 25px;
        }

        .table-responsive {
            margin-top: 25px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(123, 42, 141, 0.1);
        }

        .invoice-table {
            margin-bottom: 0;
        }

        .invoice-table th {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
            border: none;
            padding: 1rem 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            text-align: center;
        }

        .invoice-table th:first-child {
            text-align: left;
        }

        .invoice-table td {
            padding: 0.875rem 0.75rem;
            vertical-align: middle;
            border-color: rgba(228, 0, 124, 0.1);
            font-size: 0.9rem;
            text-align: center;
        }

        .invoice-table td:first-child {
            text-align: left;
        }

        .invoice-table tbody tr {
            transition: all 0.3s ease;
        }

        .invoice-table tbody tr:hover {
            background-color: rgba(228, 0, 124, 0.05);
            transform: scale(1.005);
        }

        .invoice-table tbody tr:nth-child(odd) {
            background-color: rgba(248, 249, 250, 0.8);
        }

        .invoice-table tfoot th {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
            border: none;
            padding: 1rem 0.75rem;
            font-weight: 600;
        }

        .totals-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .totals-table {
            width: 350px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(123, 42, 141, 0.1);
        }

        .totals-table th, .totals-table td {
            padding: 12px;
            border-color: rgba(228, 0, 124, 0.1);
        }

        .totals-table th {
            background: rgba(123, 42, 141, 0.1);
            color: #7B2A8D;
            font-weight: 600;
        }

        .totals-table td {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            font-weight: 500;
        }

        .totals-table tr:last-child th,
        .totals-table tr:last-child td {
            font-size: 1.2em;
            font-weight: bold;
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
            border-top: 2px solid rgba(228, 0, 124, 0.3);
        }

        .button-group {
            margin-top: 30px;
            text-align: center;
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

        /* Responsive */
        @media (max-width: 768px) {
            .invoice-container {
                margin: 0 0.5rem;
                padding: 1.5rem;
            }

            .invoice-header {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .company-info, .invoice-meta {
                flex-basis: 100%;
            }

            .invoice-title {
                text-align: left;
                font-size: 1.5rem;
            }

            .totals-container {
                justify-content: center;
            }

            .totals-table {
                width: 100%;
                max-width: 350px;
            }
        }

        @media (max-width: 576px) {
            .invoice-title {
                font-size: 1.3rem;
            }

            .invoice-table th, .invoice-table td {
                font-size: 0.75rem;
                padding: 0.5rem 0.3rem;
            }

            .totals-table th, .totals-table td {
                padding: 8px;
                font-size: 0.85rem;
            }

            .client-info,
            .invoice-header {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <!-- Encabezado -->
    <div class="invoice-header">
        <div class="company-info">
            <h5 class="section-title"><i class="fas fa-truck"></i> Proveedor</h5>
            <div class="details-grid">
                <div><strong>Nombre:</strong> {{ $factura->proveedor->nombre_empresa }}</div>
            </div>
        </div>

        <div class="invoice-meta">
            <h2 class="invoice-title"><i class="fas fa-file-invoice"></i> FACTURA DE COMPRA</h2>
            <div class="details-grid" style="text-align: right;">
                <div><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y') }}</div>
                <div><strong>Número:</strong> {{ $factura->numero_factura }}</div>
            </div>
        </div>
    </div>

    <div class="client-info">
        <h5 class="section-title"><i class="fas fa-building"></i> Comprador</h5>
        <div class="details-grid">
            <div><strong>Nombre:</strong> Salon Chic</div>
        </div>
    </div>

    <!-- Tabla de productos -->
    <div class="table-responsive">
        <table class="table invoice-table">
            <thead>
            <tr>
                <th>CONCEPTO</th>
                <th>CANTIDAD</th>
                <th>PRECIO COMPRA</th>
                <th>PRECIO VENTA</th>
                <th>TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @forelse($factura->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>L {{ number_format($detalle->precio_compra, 2) }}</td>
                    <td>L {{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>L {{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No hay productos en esta factura.</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th colspan="4" class="text-end">SUBTOTAL</th>
                <th>L {{ number_format($factura->detalles->sum('subtotal'), 2) }}</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <!-- Totales con impuestos exonerados/exentos -->
    <div class="totals-container">
        <table class="table totals-table">
            <tbody>
            <tr>
                <th>SUBTOTAL</th>
                <td>L {{ number_format($factura->detalles->sum('subtotal'), 2) }}</td>
            </tr>
            <tr>
                <th>IVA (21%)</th>
                <td>L {{ number_format($factura->detalles->sum('subtotal') * 0.21, 2) }}</td>
            </tr>
            <tr>
                <th>EXONERADO</th>
                <td>L {{ number_format($factura->exonerado ?? 0, 2) }}</td>
            </tr>
            <tr>
                <th>EXENTO</th>
                <td>L {{ number_format($factura->exento ?? 0, 2) }}</td>
            </tr>
            <tr>
                <th>TOTAL COMPRA</th>
                <td>L {{ number_format($factura->total, 2) }}</td>
            </tr>
            </tbody>
        </table>
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
