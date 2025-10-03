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
        Schema::create('promocion_cliente', function (Blueprint $table) {
            $table->id();

            $table->foreignId('promocion_id')->constrained('promocions')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');

            $table->integer('usos')->default(0);


            $table->timestamps();



            $table->unique(['promocion_id', 'cliente_id']);


            $table->index('cliente_id');
            $table->index('promocion_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocion_cliente');
    }
};
