<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use hasFactory;
    protected $table = 'proveedores';

    protected $fillable = [
            'nombre_proveedor',
            'nombre_empresa',
            'empleado_encargado',
            'telefono_empleado_encargado',
            'telefono',
            'direccion',
            'estado',
            'fecha_registro'
    ];
}
