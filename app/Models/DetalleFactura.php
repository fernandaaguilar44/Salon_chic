<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;
    protected $fillable = [
        'factura_id',
        'producto_id',
        'nombre_producto_manual', // Mantener si hay un caso de uso para productos no registrados
        'tipo_impuesto',         // ¡CAMBIO CLAVE! Añadir este campo
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Un detalle de factura pertenece a una factura
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    // Un detalle de factura se refiere a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
