<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'marca',
        'codigo',
        'fecha_ingreso',
        'imagen',
        'stock',
        // ¡Estos dos campos son CRUCIALES para que se guarden!
        'precio_compra',
        'precio_venta',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalleFacturas()
    {
        return $this->hasMany(DetalleFactura::class, 'producto_id');
    }

    public function facturas()
    {
        return $this->belongsToMany(Factura::class, 'detalle_facturas', 'producto_id', 'factura_id')
            ->withPivot('cantidad', 'precio_unitario', 'subtotal');
    }
}
