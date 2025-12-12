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
        Schema::table('venta_detalles', function (Blueprint $table) {
            // 1. Agregar la columna foreignId para 'presentacion_id'
            $table->foreignId('presentacion_id')
                  // Permitir nulos para no romper datos antiguos si los hay.
                  ->nullable() 
                  // Colocarla después de 'producto_id' por orden lógico.
                  ->after('producto_id') 
                  // Restricción de clave foránea a la tabla 'presentaciones'.
                  ->constrained('presentaciones')
                  // Si una presentación se borra, se establece en NULL.
                  ->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venta_detalles', function (Blueprint $table) {
            // 1. Eliminar la restricción de clave foránea
            $table->dropForeign(['presentacion_id']); 
            
            // 2. Eliminar la columna
            $table->dropColumn('presentacion_id'); 
        });
    }
};
