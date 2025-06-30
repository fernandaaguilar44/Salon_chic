<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlamadoAtencion extends Model
{
    use HasFactory;

    protected $table = 'llamado_atencions';

    protected $fillable = [
        'empleado_id',
        'motivo',
        'fecha',
        'lugar',
        'sancion',
        'testigos',
        'otros_empleados_involucrados',
        'numero_llamado',
        'desactivo_empleado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
