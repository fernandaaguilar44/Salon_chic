<?php

namespace App\Models;



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre_empleado',
        'numero_identidad',
        'telefono',
        'direccion',
        'salario',
        'contacto_emergencia',
        'correo',
        'cargo',
        'fecha_ingreso',
        'estado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
    public function llamados()
    {
        return $this->hasMany(LlamadoAtencion::class, 'id_empleado');
    }




}