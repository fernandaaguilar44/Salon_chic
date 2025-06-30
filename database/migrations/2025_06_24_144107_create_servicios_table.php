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

            // Datos básicos del servicio
            $table->string('nombre_servicio', 40);
            $table->text('descripcion');
            $table->string('codigo_servicio', 8)->unique();

            // Clasificación clara según cargo y tipo
            $table->enum('tipo_servicio', [
                'cabello', 'manicure', 'pedicure']);

            $table->enum('categoria_servicio', ['basico', 'intermedio', 'avanzado']);


            // Información comercial
            $table->integer('precio_base');

            // Duración y preparación
            $table->integer('duracion_estimada'); // minutos



            // Estado y visibilidad
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
