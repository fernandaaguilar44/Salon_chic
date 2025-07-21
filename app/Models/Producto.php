<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function detalleFacturas()
    {
        return $this->hasMany(DetalleFactura::class, 'producto_id'); // Usaremos 'producto_id' aquí
    }

    // Si quieres una relación Muchos a Muchos directa con Facturas (sin el detalle de por medio), se haría así:
    public function facturas()
    {
        return $this->belongsToMany(Factura::class, 'detalle_facturas', 'producto_id', 'factura_id')
            ->withPivot('cantidad', 'precio_unitario', 'subtotal'); // Asegúrate de incluir los campos de la tabla pivote
    }

}
