<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model {

    use hasFactory;
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre_proveedor',
        'telefono',
        'direccion',
        'ciudad',
        'nombre_empresa',
        'empleado_encargado',
        'telefono_empleado_encargado',
        'fecha_registro',
        'imagen',
    ];



}
