<?php


// database/migrations/YYYY_MM_DD_HHMMSS_create_presentaciones_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presentaciones', function (Blueprint $table) {
            $table->id();
            // Clave foránea al producto (Importante para relacionar)
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            // Columnas que definen la presentación
            $table->string('nombre'); // Ej: 'Cartón', 'Unidad'
            $table->decimal('precio_venta', 10, 2); // Precio para esta presentación
            $table->integer('cantidad_base'); // Cantidad de unidades de inventario que contiene
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presentaciones');
    }
};