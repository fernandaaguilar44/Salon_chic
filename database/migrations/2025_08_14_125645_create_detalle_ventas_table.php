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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            // ¡ESTA ES LA LÍNEA CLAVE CORREGIDA!
            // Ahora referencia la tabla 'factura_ventas' explícitamente.
            $table->foreignId('venta_id')->constrained('factura_ventas')->onDelete('cascade');
            $table->foreignId('producto_id')->nullable()->constrained('productos')->onDelete('set null');
            $table->string('nombre_producto_manual')->nullable();

            $table->string('tipo_impuesto')->default('gravado15'); // O ->enum si lo prefieres

            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
