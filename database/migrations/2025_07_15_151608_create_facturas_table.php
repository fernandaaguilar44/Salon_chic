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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->integer('proveedor_id')->nullable();
            $table->string('numero_factura', 7)->unique(); // Ajustado a 7 caracteres para LLL-NNN
            $table->date('fecha')->useCurrent();
            $table->decimal('total', 10, 2); // Este es el 'gran_total'
            $table->decimal('importe_exonerado', 10, 2)->default(0); // NUEVO
            $table->decimal('importe_exento', 10, 2)->default(0);    // NUEVO
            $table->decimal('importe_gravado_15', 10, 2)->default(0); // NUEVO
            $table->decimal('isv_15', 10, 2)->default(0);            // NUEVO
            $table->text('notas')->nullable(); // Comentarios opcionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
