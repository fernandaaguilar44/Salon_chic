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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');                        // Nombre del producto
            $table->string('categoria');
            $table->text('descripcion');// Categoría o tipo
            $table->string('marca')->nullable();             // Marca (opcional)
            $table->string('codigo')->unique();              // Código único
            $table->date('fecha_ingreso')->useCurrent();                   // Fecha de ingreso
            $table->string('imagen')->nullable();            // Ruta de imagen (opcional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
