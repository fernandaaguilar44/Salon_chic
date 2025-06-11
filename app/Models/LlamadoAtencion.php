<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class LlamadoAtencion extends Model
{
    protected $table = 'llamado_atencions'; // o el nombre correcto de tu tabla

    protected $fillable = [
        'empleado_id',
        'motivo',
        'fecha', // ✅ Agrega esto
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

}
