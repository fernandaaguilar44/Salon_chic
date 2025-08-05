<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'proveedor_id',
        'numero_factura',
        'fecha',
        'total',
        'notas',
        'importe_exonerado',
        'importe_exento',
        'importe_gravado_15',
        'isv_15',
    ];

    public function proveedor() {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleFactura::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_facturas')
            ->withPivot(['cantidad', 'precio_unitario', 'subtotal', 'tipo_impuesto']);
    }
}
