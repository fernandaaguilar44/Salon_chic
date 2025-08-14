<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleFacturaVenta extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada al modelo
    protected $table = 'detalle_ventas';

    protected $fillable = [
        'venta_id',
        'producto_id',
        'nombre_producto_manual',
        'tipo_impuesto',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function venta(): BelongsTo
    {
        // Relacionado con el modelo Venta
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
