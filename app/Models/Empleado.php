<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public function proveedores()
    {
        return $this->hasMany(Proveedor::class);
    }
}
