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
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->id();
            
            // Relación con ventas
            $table->unsignedBigInteger('venta_id');
            
            // Relación con productos
            $table->unsignedBigInteger('producto_id');

            // Datos del detalle
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();

            // Llaves foráneas
            $table->foreign('venta_id')
                  ->references('id')->on('ventas')
                  ->onDelete('cascade');

            $table->foreign('producto_id')
                  ->references('id')->on('productos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_detalles');
    }
};
