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

            $table->string('nombre_empleado', 30);
            $table->string('numero_identidad', 13)->unique();
            $table->string('telefono', 8);
            $table->string('direccion', 60);
            $table->decimal('salario', 10, 2);
            $table->string('contacto_emergencia', 8);
            $table->string('correo')->unique();
            $table->enum('cargo', ['manicurista', 'estilista']);
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
