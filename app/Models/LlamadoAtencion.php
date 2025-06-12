<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class LlamadoAtencion extends Model
{
    use HasFactory;
    protected $table = 'llamado_atencions'; // o el nombre correcto de tu tabla

    protected $fillable = [
        'empleado_id',
        'motivo',
        'fecha',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

}
