<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = ['proveedor_id', 'numero_factura', 'fecha', 'total', 'notas'];

    public function proveedor() {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalles() {
        return $this->hasMany(DetalleFactura::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'factura_producto') // nombre tabla pivote
        ->withPivot('cantidad', 'precio_unitario', 'subtotal');
    }

}
