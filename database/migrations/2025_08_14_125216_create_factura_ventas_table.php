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
        Schema::create('factura_ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente_id')->nullable();
            $table->string('numero_factura', 25)->unique(); // Número de factura de venta
            $table->date('fecha')->useCurrent();
            $table->decimal('total', 10, 2); // Este es el 'gran_total' de la venta
            $table->decimal('importe_exonerado', 10, 2)->default(0);
            $table->decimal('importe_exento', 10, 2)->default(0);
            $table->decimal('importe_gravado_15', 10, 2)->default(0);
            $table->decimal('isv_15', 10, 2)->default(0);
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_ventas');
    }
};
