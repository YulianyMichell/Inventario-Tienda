<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VentaDetalle extends Model
{
    use HasFactory;

    protected $table = 'venta_detalles'; // Opcional, pero buena práctica si el nombre no sigue la convención plural

    protected $fillable = [
        'venta_id',
        'producto_id',
        'presentacion_id', // <--- ¡CAMBIO CLAVE! Agregado al fillable
        'cantidad',
        'precio',
        'subtotal',
    ];

    // RELACIONES DE PERTENENCIA (belongsTo)
    
    /**
     * Relación con la venta a la que pertenece este detalle.
     */
    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class);
    }
    
    /**
     * Relación con el producto asociado a este detalle.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
    
    /**
     * Relación con la presentación específica que se vendió.
     * Esta es la relación que resolvimos con la migración.
     */
    public function presentacion(): BelongsTo
    {
        return $this->belongsTo(Presentacion::class);
    }
}