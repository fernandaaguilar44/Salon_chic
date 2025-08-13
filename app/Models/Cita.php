<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'empleado_id',
        'servicio_id',
        'fecha',
        'hora_inicio',
        'duracion_minutos',
        'precio_estimado',
        'estado',
        'hora_inicio_real',
        'hora_fin_real',
        'observaciones'
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'datetime:H:i',
        'hora_inicio_real' => 'datetime',
        'hora_fin_real' => 'datetime',
    ];

    // Relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    // Accessors
    public function getFechaFormateadaAttribute()
    {
        return $this->fecha->format('d/m/Y');
    }

    public function getHoraInicioFormateadaAttribute()
    {
        return Carbon::parse($this->hora_inicio)->format('H:i');
    }

    public function getEstadoColorAttribute()
    {
        return match($this->estado) {
            'pendiente' => 'warning',
            'en_proceso' => 'primary',
            'finalizada' => 'success',
            'cancelada' => 'danger',
            default => 'secondary'
        };
    }

    public function getDuracionTextoAttribute()
    {
        $horas = intval($this->duracion_minutos / 60);
        $minutos = $this->duracion_minutos % 60;

        if ($horas > 0 && $minutos > 0) {
            return "{$horas}h {$minutos}min";
        } elseif ($horas > 0) {
            return "{$horas}h";
        } else {
            return "{$minutos}min";
        }
    }

    // Métodos para obtener nombres correctos
    public function getNombreEmpleadoAttribute()
    {
        return $this->empleado->nombre_empleado ?? '';
    }

    public function getNombreServicioAttribute()
    {
        return $this->servicio->nombre_servicio ?? '';
    }

    // Scopes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeHoy($query)
    {
        return $query->whereDate('fecha', today());
    }

    public function scopeEntreFechas($query, $fechaInicio, $fechaFin)
    {
        return $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
    }

    public function scopePorEmpleado($query, $empleadoId)
    {
        return $query->where('empleado_id', $empleadoId);
    }

    // Métodos
    public function puedeSerEditada()
    {
        return in_array($this->estado, ['pendiente', 'en_proceso']);
    }

    public function puedeSerCancelada()
    {
        return in_array($this->estado, ['pendiente', 'en_proceso']);
    }

    public function marcarComoIniciada()
    {
        $this->update([
            'estado' => 'en_proceso',
            'hora_inicio_real' => now()
        ]);
    }

    public function marcarComoFinalizada()
    {
        $this->update([
            'estado' => 'finalizada',
            'hora_fin_real' => now()
        ]);
    }

    public function marcarComoCancelada()
    {
        $this->update([
            'estado' => 'cancelada'
        ]);
    }
}