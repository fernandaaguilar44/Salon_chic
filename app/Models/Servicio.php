<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
// Los campos que pueden asignarse masivamente
    protected $fillable = [
        'nombre_servicio',
        'descripcion',
        'codigo_servicio',
        'tipo_servicio',
        'categoria_servicio',
        'precio_base',
        'duracion_estimada',
        'estado',

    ];
}
