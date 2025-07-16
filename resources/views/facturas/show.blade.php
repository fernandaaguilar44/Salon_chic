<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalle de la Factura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        /* ... (TODO: copiar estilos de productos.show para mantener la estética) ... */
    </style>
</head>
<body>
<div class="container">
    <div class="beauty-header">
        <h2><i class="fas fa-receipt"></i> Detalle de la Factura</h2>
    </div>

    <div class="main-content">
        <div class="product-info">
            <div class="product-details">
                <h3 class="section-title">
                    <i class="fas fa-info-circle"></i> Información de la Factura
                </h3>
                <dl class="row">
                    <dt class="col-sm-5"><i class="fas fa-file-invoice"></i> Número de Factura:</dt>
                    <dd class="col-sm-7">{{ $factura->numero_factura }}</dd>

                    <dt class="col-sm-5"><i class="fas fa-user-tie"></i> Proveedor:</dt>
                    <dd class="col-sm-7">{{ $factura->proveedor->nombre }}</dd>

                    <dt class="col-sm-5"><i class="fas fa-calendar-alt"></i> Fecha:</dt>
                    <dd class="col-sm-7">{{ $factura->fecha }}</dd>

                    <dt class="col-sm-5"><i class="fas fa-dollar-sign"></i> Total:</dt>
                    <dd class="col-sm-7">L {{ number_format($factura->total, 2) }}</dd>
                </dl>
            </div>

            <div class="description-section">
                <h3 class="section-title">
                    <i class="fas fa-boxes"></i> Productos Comprados
                </h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach($factura->detalles as $detalle)
                            @php $linea = $detalle->cantidad * $detalle->precio; $subtotal += $linea; @endphp
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>L {{ number_format($detalle->precio, 2) }}</td>
                                <td>L {{ number_format($linea, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="product-details">
                <h3 class="section-title">
                    <i class="fas fa-calculator"></i> Totales
                </h3>
                <dl class="row">
                    <dt class="col-sm-5">Subtotal:</dt>
                    <dd class="col-sm-7">L {{ number_format($subtotal, 2) }}</dd>

                    <dt class="col-sm-5">Impuesto (15%):</dt>
                    <dd class="col-sm-7">L {{ number_format($subtotal * 0.15, 2) }}</dd>

                    <dt class="col-sm-5">Total con impuesto:</dt>
                    <dd class="col-sm-7">L {{ number_format($subtotal * 1.15, 2) }}</dd>
                </dl>
            </div>
        </div>

        <div class="product-image">
            <div class="image-container">
                <h3 class="section-title">
                    <i class="fas fa-clipboard-list"></i> Resumen
                </h3>
                <p><strong>Total Productos:</strong> {{ $factura->detalles->count() }}</p>
                <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
                <p><strong>Total:</strong> L {{ number_format($factura->total, 2) }}</p>
            </div>
        </div>
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
