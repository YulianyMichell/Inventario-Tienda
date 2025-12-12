<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presentacion extends Model
{
    use HasFactory;
    
    // 💡 SOLUCIÓN: Definir explícitamente el nombre de la tabla
    protected $table = 'presentaciones'; 

    /**
     * Los atributos que son asignables en masa.
     * ...
     * @var array<int, string>
     */
    protected $fillable = [
        'producto_id',   // Clave foránea al producto asociado
        // ...
    ];

    /**
     * Define la relación inversa: Una Presentación pertenece a un único Producto.
     * ...
     * @return BelongsTo
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
    // ...
}
