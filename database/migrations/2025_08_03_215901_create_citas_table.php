<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('servicio_id');

            // Información de cita
            $table->date('fecha'); // Fecha para la cita
            $table->time('hora_inicio'); // Hora programada
            $table->integer('duracion_minutos'); // Copiado del servicio
            $table->integer('precio_estimado'); // Copiado del servicio

            // Estado de la cita
            $table->enum('estado', [
                'pendiente',
                'en_proceso',
                'finalizada',
                'cancelada'
            ])->default('pendiente');

            // Tiempos reales
            $table->timestamp('hora_inicio_real')->nullable(); // Cuando se comenzó a atender
            $table->timestamp('hora_fin_real')->nullable();    // Cuando terminó realmente

            // Observaciones internas
            $table->text('observaciones')->nullable();


            $table->timestamps();

            // Relaciones
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
