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
        Schema::create('llamado_atencions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');

            // Información básica
            $table->string('motivo', 70);
            $table->text('descripcion');
            $table->date('fecha');
            $table->string('lugar', 100);

            // Personas involucradas
            $table->string('testigos', 150);
            $table->string('otros_empleados_involucrados', 150)->nullable();

            // Control
            $table->integer('numero_llamado')->default(1); // 1ro, 2do, 3ro
            $table->boolean('desactivo_empleado')->default(false); // true si fue el 3er llamado

            // Sanción
            $table->enum('sancion', [
                'advertencia verbal',
                'advertencia escrita',
                'suspensión 1 día',
                'suspensión 3 días',
                'descuento salario',
                'despido'
            ])->default('advertencia verbal');


            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llamado_atencions');
    }
};



