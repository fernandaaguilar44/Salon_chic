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
        Schema::create('promocions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->enum('tipo', ['porcentaje', 'monto_fijo', 'combo']);
            $table->enum('aplica_a', ['productos', 'servicios']);
            $table->integer('valor');
            $table->date('fecha_inicio');
            $table->date('fecha_expiracion');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->integer('monto_minimo');
            $table->text('descripcion');
            $table->text('items_incluidos')->nullable();
            $table->integer('uso_maximo');
            $table->integer('uso_por_cliente');
            $table->enum('combinable', ['si', 'no']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocions');
    }
};
