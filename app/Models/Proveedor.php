<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory; // ✅ Correcto

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre_proveedor',
        'telefono',
        'direccion',
        'ciudad',
        'nombre_empresa',
        'telefono_empleado_encargado',
        'fecha_registro',
        'empleado_id',
        'imagen',
    ];
    public function proveedor(){
    return $this->hasMany(Proveedor::class);
    }
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'proveedor_id');
    }
}

