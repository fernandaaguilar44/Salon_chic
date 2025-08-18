<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;use Illuminate\Database\Eloquent\Relations\HasMany;

class FacturaVenta extends Model
{
    use HasFactory;

    // ¡¡¡CORRECCIÓN AQUÍ!!!
    // Ahora indica a Laravel que la tabla para este modelo es 'factura_ventas'.
    protected $table = 'factura_ventas';

    protected $fillable = [
        'cliente_id',
        'numero_factura',
        'fecha',
        'total',
        'notas',
        'importe_exonerado',
        'importe_exento',
        'importe_gravado_15',
        'isv_15',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class); // Relacionado con el modelo Cliente
    }

    public function detalles()
    {
        return $this->hasMany(DetalleFacturaVenta::class, 'venta_id');
    }


    public function productos(): BelongsToMany
    {
        // La tabla pivote ahora es 'detalle_ventas'
        return $this->belongsToMany(Producto::class, 'detalle_ventas')
            ->withPivot(['cantidad', 'precio_unitario', 'subtotal', 'tipo_impuesto']);
    }
}
