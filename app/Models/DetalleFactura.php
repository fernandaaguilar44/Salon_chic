<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $fillable = ['factura_id', 'producto', 'cantidad', 'precio_unitario', 'subtotal'];

    public function factura() {
        return $this->belongsTo(Factura::class);
    }
}
