<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('user_id');

            // Tipo de movimiento
            $table->enum('tipo', ['entrada', 'salida']);

            $table->integer('cantidad');
            $table->integer('stock_anterior');
            $table->integer('stock_actual');

            $table->text('descripcion')->nullable();

            $table->timestamps();

            // Llaves foráneas
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
