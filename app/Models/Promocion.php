<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'tipo',
        'aplica_a',
        'valor',
        'fecha_inicio',
        'fecha_expiracion',
        'estado',
        'monto_minimo',
        'descripcion',
        'uso_maximo',
        'uso_por_cliente',
        'combinable',
        'items_incluidos'
    ];
    // ✅ CASTING DE FECHAS
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_expiracion' => 'date',
    ];

    /**
     * Relación muchos a muchos con servicios
     */
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'promocion_servicio', 'promocion_id', 'servicio_id')
            ->withTimestamps();
    }

    /**
     * Relación muchos a muchos con productos
     */


    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'promocion_producto', 'promocion_id', 'producto_id')
            ->withTimestamps();
    }




    /**
     * Relación muchos a muchos con clientes (para tracking de uso)
     */
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'promocion_cliente', 'promocion_id', 'cliente_id')
            ->withPivot(['usos'])
            ->withTimestamps();
    }

    // ✅ SCOPES ÚTILES
    public function scopeActivas($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopeVigentes($query)
    {
        return $query->where('fecha_inicio', '<=', now())
            ->where('fecha_expiracion', '>=', now())
            ->where('estado', 'activo');
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    public function scopeCombinables($query)
    {
        return $query->where('combinable', 'si');
    }

    // ✅ MÉTODOS HELPER PARA COMBOS
    public function getServiciosCombo()
    {
        if (!$this->items_incluidos) return [];

        preg_match_all('/s(\d+)/', $this->items_incluidos, $matches);
        return $matches[1]; // [1, 2, 3]
    }

    public function getProductosCombo()
    {
        if (!$this->items_incluidos) return [];

        preg_match_all('/p(\d+)/', $this->items_incluidos, $matches);
        return $matches[1]; // [5, 8, 12]
    }

    // ✅ MÉTODOS PARA CONTROL DE USO
    public function puedeUsarCliente($clienteId)
    {
        // Verificar si la promoción está vigente
        if (!$this->esVigente()) {
            return [
                'puede' => false,
                'motivo' => 'La promoción no está vigente.'
            ];
        }

        // Verificar uso máximo total
        $usoTotal = $this->clientes()->sum('promocion_cliente.usos');
        if ($usoTotal >= $this->uso_maximo) {
            return [
                'puede' => false,
                'motivo' => 'La promoción ha alcanzado su uso máximo total.'
            ];
        }

        // Verificar uso por cliente
        $usoCliente = $this->clientes()
            ->where('cliente_id', $clienteId)
            ->first();

        $usosActuales = $usoCliente ? $usoCliente->pivot->usos : 0;

        if ($usosActuales >= $this->uso_por_cliente) {
            return [
                'puede' => false,
                'motivo' => "Has alcanzado el límite de {$this->uso_por_cliente} usos para esta promoción."
            ];
        }

        return [
            'puede' => true,
            'usosRestantes' => $this->uso_por_cliente - $usosActuales,
            'usosTotalesRestantes' => $this->uso_maximo - $usoTotal
        ];
    }

    public function registrarUso($clienteId)
    {
        $cliente = $this->clientes()->where('cliente_id', $clienteId)->first();

        if ($cliente) {
            // Cliente ya usó la promoción, incrementar contador
            $this->clientes()->updateExistingPivot($clienteId, [
                'usos' => $cliente->pivot->usos + 1,
                'updated_at' => now()
            ]);
        } else {
            // Primera vez que usa la promoción
            $this->clientes()->attach($clienteId, [
                'usos' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    public function esVigente()
    {
        return $this->fecha_inicio <= now() &&
            $this->fecha_expiracion >= now() &&
            $this->estado === 'activo';
    }

    public function esCombinableCon($otraPromocion)
    {
        return $this->combinable === 'si' && $otraPromocion->combinable === 'si';
    }

    public function getDiasRestantesAttribute()
    {
        if (!$this->esVigente()) {
            return null;
        }

        return now()->diffInDays($this->fecha_expiracion, false);
    }

    public function getUsoActualAttribute()
    {
        return $this->clientes()->sum('promocion_cliente.usos');
    }

    public function getClientesQueUsaronAttribute()
    {
        return $this->clientes()->count();
    }

    public function getPorcentajeUsoAttribute()
    {
        return round(($this->uso_actual / $this->uso_maximo) * 100, 2);
    }

    // ✅ MÉTODOS PARA CÁLCULO DE DESCUENTOS
    public function calcularDescuento($montoBase, $clienteId = null)
    {
        // Verificar si el cliente puede usar la promoción
        if ($clienteId && !$this->puedeUsarCliente($clienteId)['puede']) {
            return [
                'descuento' => 0,
                'montoFinal' => $montoBase,
                'aplicada' => false,
                'motivo' => $this->puedeUsarCliente($clienteId)['motivo']
            ];
        }

        // Verificar monto mínimo
        if ($montoBase < $this->monto_minimo) {
            return [
                'descuento' => 0,
                'montoFinal' => $montoBase,
                'aplicada' => false,
                'motivo' => "El monto mínimo para esta promoción es L. {$this->monto_minimo}."
            ];
        }

        $descuento = 0;

        switch ($this->tipo) {
            case 'porcentaje':
                $descuento = ($montoBase * $this->valor) / 100;
                break;

            case 'monto_fijo':
                $descuento = $this->valor;
                break;

            case 'combo':
                // Para combos, el valor es el precio final
                $descuento = $montoBase - $this->valor;
                if ($descuento < 0) $descuento = 0;
                break;
        }

        return [
            'descuento' => $descuento,
            'montoFinal' => $montoBase - $descuento,
            'aplicada' => true,
            'motivo' => null
        ];
    }


}

