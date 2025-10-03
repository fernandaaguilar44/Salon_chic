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

    public function promociones()
    {
        return $this->belongsToMany(Promocion::class, 'promocion_cliente', 'cliente_id', 'promocion_id')
            ->withPivot(['usos', 'primer_uso', 'ultimo_uso'])
            ->withTimestamps();
    }



}
