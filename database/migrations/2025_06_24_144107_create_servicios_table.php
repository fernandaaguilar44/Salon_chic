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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();


            $table->string('nombre_servicio', 50);
            $table->text('descripcion');
            $table->string('codigo_servicio', 7)->unique();
            $table->enum('tipo_servicio', [
                'cabello', 'manicura', 'pedicura']);
            $table->enum('categoria_servicio', ['basico', 'intermedio', 'avanzado']);
            $table->integer('precio_base');
            $table->integer('duracion_estimada');
            $table->enum('estado', ['activo', 'inactivo', 'temporalmente_suspendido']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
