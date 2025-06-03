<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empleado');
            $table->string('numero_identidad')->unique();
            $table->string('telefono');
            $table->string('direccion');
            $table->decimal('salario', 10, 2);
            $table->string('contacto_emergencia');
            $table->string('nombre_contacto_emergencia');
            $table->string('cargo');
            $table->date('fecha_ingreso');
            $table->enum('estado', ['activo', 'inactivo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
