<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalle de la Factura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        /* (TODO: copiar estilos de productos.show para mantener la estética) */
        /* Puedes pegar tus estilos CSS aquí, o incluirlos desde un archivo externo */
        /* Por ejemplo, los estilos del index.blade.php que ya tienes son bastante buenos */

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
            max-width: 900px; /* Ajustado para el detalle */
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

        .main-content {
            display: flex;
            flex-wrap: wrap; /* Permite que los elementos se envuelvan en pantallas pequeñas */
            gap: 2rem; /* Espacio entre las secciones */
            margin-bottom: 2rem;
        }

        .product-info {
            flex: 2; /* Ocupa más espacio, ideal para la información de la factura y la tabla */
            min-width: 500px; /* Mínimo ancho para evitar que se comprima demasiado */
        }

        .product-image {
            flex: 1; /* Ocupa el espacio restante para el resumen */
            min-width: 250px; /* Mínimo ancho para el resumen */
            display: flex; /* Para centrar contenido si es necesario */
            justify-content: center;
            align-items: flex-start; /* Alinea arriba */
        }

        .product-details, .description-section, .image-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem; /* Espacio entre secciones dentro de product-info */
            box-shadow: 0 8px 20px rgba(123, 42, 141, 0.1);
            border: 1px solid rgba(228, 0, 124, 0.1);
        }

        .section-title {
            color: #E4007C;
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(228, 0, 124, 0.1);
        }

        .section-title i {
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

        .table-responsive {
            border-radius: 10px;
            overflow: hidden; /* Asegura que los bordes redondeados se apliquen */
        }

        .table-bordered th, .table-bordered td {
            border-color: rgba(228, 0, 124, 0.15) !important;
            text-align: center;
        }

        .table thead th {
            background: linear-gradient(135deg, #7B2A8D 0%, #E4007C 100%);
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .table tbody tr:hover {
            background-color: rgba(228, 0, 124, 0.05);
        }

        .table tbody td {
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .image-container p {
            font-size: 1rem;
            line-height: 1.8;
            color: #555;
        }

        .image-container p strong {
            color: #7B2A8D;
            font-weight: 700;
            margin-right: 5px;
        }

        .button-group {
            text-align: center;
            margin-top: 2rem;
        }

        /* Botones generales (se repiten del index, si están centralizados mejor) */
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column; /* Apila las secciones en pantallas pequeñas */
            }
            .product-info, .product-image {
                min-width: unset; /* Elimina el mínimo ancho para permitir flexibilidad */
                width: 100%; /* Ocupa todo el ancho disponible */
            }
        }
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
                    {{-- CORRECCIÓN 1: Acceder a 'nombre_proveedor' del proveedor --}}
                    <dd class="col-sm-7">{{ $factura->proveedor->nombre_proveedor }}</dd>

                    <dt class="col-sm-5"><i class="fas fa-calendar-alt"></i> Fecha:</dt>
                    {{-- Formato de fecha para mejor visualización --}}
                    <dd class="col-sm-7">{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</dd>

                    <dt class="col-sm-5"><i class="fas fa-dollar-sign"></i> Total:</dt>
                    {{-- Usar el total guardado en la factura --}}
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
                            <th>Tipo Impuesto</th> {{-- Añadido para mostrar el tipo de impuesto --}}
                        </tr>
                        </thead>
                        <tbody>
                        {{-- Ya no necesitamos calcular el subtotal aquí si lo tomamos de la factura --}}
                        {{-- CORRECCIÓN 2: Usar 'detallesFactura' como nombre de la relación --}}
                        @forelse($factura->detallesFactura as $detalle)
                            <tr>
                                {{-- CORRECCIÓN 3: Acceder a 'nombre' del producto a través de la relación --}}
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                {{-- CORRECCIÓN 4: Usar 'precio_unitario' y 'subtotal' del detalle --}}
                                <td>L {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td>L {{ number_format($detalle->subtotal, 2) }}</td>
                                <td>{{ ucfirst($detalle->tipo_impuesto) }}</td> {{-- Mostrar el tipo de impuesto --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay productos en esta factura.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="product-details">
                <h3 class="section-title">
                    <i class="fas fa-calculator"></i> Totales de la Factura
                </h3>
                <dl class="row">
                    {{-- CORRECCIÓN 5: Usar los totales ya guardados en la factura o pasados por el controlador --}}
                    <dt class="col-sm-5">Importe Exonerado:</dt>
                    <dd class="col-sm-7">L {{ number_format($factura->importe_exonerado, 2) }}</dd>

                    <dt class="col-sm-5">Importe Exento:</dt>
                    <dd class="col-sm-7">L {{ number_format($factura->importe_exento, 2) }}</dd>

                    <dt class="col-sm-5">Importe Gravado (15%):</dt>
                    <dd class="col-sm-7">L {{ number_format($factura->importe_gravado_15, 2) }}</dd>

                    <dt class="col-sm-5">ISV (15%):</dt>
                    <dd class="col-sm-7">L {{ number_format($factura->isv_15, 2) }}</dd>

                    <dt class="col-sm-5">Gran Total:</dt>
                    <dd class="col-sm-7">L {{ number_format($factura->total, 2) }}</dd>
                    {{-- O si prefieres los valores calculados en el controlador y pasados a la vista --}}
                    {{-- <dt class="col-sm-5">Importe Exonerado (Calc):</dt>
                    <dd class="col-sm-7">L {{ number_format($importeExonerado ?? 0, 2) }}</dd>
                    <dt class="col-sm-5">Importe Exento (Calc):</dt>
                    <dd class="col-sm-7">L {{ number_format($importeExento ?? 0, 2) }}</dd>
                    <dt class="col-sm-5">Importe Gravado (Calc):</dt>
                    <dd class="col-sm-7">L {{ number_format($importeGravado ?? 0, 2) }}</dd>
                    <dt class="col-sm-5">ISV (Calc):</dt>
                    <dd class="col-sm-7">L {{ number_format($isv ?? 0, 2) }}</dd>
                    <dt class="col-sm-5">Total con ISV (Calc):</dt>
                    <dd class="col-sm-7">L {{ number_format($totalConISV ?? 0, 2) }}</dd> --}}
                </dl>
            </div>
        </div>

        <div class="product-image">
            <div class="image-container">
                <h3 class="section-title">
                    <i class="fas fa-clipboard-list"></i> Resumen Rápido
                </h3>
                {{-- CORRECCIÓN 2: Usar 'detallesFactura' --}}
                <p><strong>Cantidad de ítems:</strong> {{ $factura->detallesFactura->count() }}</p>
                <p><strong>Fecha de Factura:</strong> {{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</p>
                <p><strong>Gran Total Factura:</strong> L {{ number_format($factura->total, 2) }}</p>
                {{-- Si tienes notas en la factura, puedes mostrarlas aquí --}}
                @if($factura->notas)
                    <p><strong>Notas:</strong> {{ $factura->notas }}</p>
                @endif
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
