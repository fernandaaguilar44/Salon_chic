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
        'salario',
        'contacto_emergencia_nombre',
        'contacto_emergencia',
        'correo',
        'cargo',
        'fecha_ingreso',
        'estado',
        'direccion'
    ];




    public function llamados(){
        return $this->hasMany(LlamadoAtencion::class, 'empleado_id');
    }

    public function estadoDisciplinario()
    {
        $total = $this->llamados()->count();

        if ($total >= 4) return 'despedido';
        if ($total == 3) return 'suspendido';
        return 'activo';
    }






}