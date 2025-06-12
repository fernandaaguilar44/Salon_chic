<?php

namespace App\Models;




use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
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


    public function llamados()
    {

        return $this->hasMany(LlamadoAtencion::class);
    }



}