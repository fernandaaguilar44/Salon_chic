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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            // Campos básicos OBLIGATORIOS
            $table->string('nombre', 50);
            $table->string('telefono', 8)->unique();
            $table->string('identidad', 13)->unique(); // Número de identidad/cédula
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['masculino', 'femenino']);

            // Campos básicos OPCIONALES
            $table->string('correo')->unique();
            $table->text('direccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
