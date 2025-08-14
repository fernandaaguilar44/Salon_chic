<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'telefono',
        'identidad',
        'fecha_nacimiento',
        'sexo',
        'correo',
        'direccion',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

}
