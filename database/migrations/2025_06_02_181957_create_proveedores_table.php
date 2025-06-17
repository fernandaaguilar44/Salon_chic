<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proveedor');
            $table->string('nombre_empresa');
            $table->string('telefono_empleado_encargado')->unique()->nullable();
            $table->string('telefono')->unique();
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('imagen');
            $table->integer('empleado_id')->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('proveedores');
    }
};
