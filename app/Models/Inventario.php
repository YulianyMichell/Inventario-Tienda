<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventario extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     * Corresponden a las columnas de la tabla.
     * @var array<int, string>
     */
    protected $fillable = [
        'producto_id',
        'user_id',
        'tipo', // 'entrada' o 'salida'
        'cantidad',
        'stock_anterior',
        'stock_actual',
        'descripcion',
        // 'fecha' si la tienes en la BD y no confías solo en created_at
    ];

    /**
     * Define la relación: Un movimiento de inventario pertenece a un Producto.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    /**
     * Define la relación: Un movimiento de inventario fue registrado por un Usuario.
     * Asume que tu modelo de usuario es App\Models\User.
     */
    public function user(): BelongsTo
    {
        // El segundo parámetro ('user_id') es opcional si sigue la convención de Laravel
        return $this->belongsTo(User::class, 'user_id');
    }
}