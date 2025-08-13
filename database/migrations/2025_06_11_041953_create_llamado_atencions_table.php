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
            $table->text('motivo');
            $table->date('fecha');
            $table->string('lugar', 100);
            $table->string('testigos', 150);
            $table->string('otros_empleados_involucrados', 150)->nullable();
            $table->integer('numero_llamado')->default(1);
            $table->boolean('desactivo_empleado')->default(false);
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



