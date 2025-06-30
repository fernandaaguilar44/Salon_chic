<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'marca',
        'codigo',
        'fecha_ingreso',
        'imagen',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
