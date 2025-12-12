<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    use HasFactory;

    // Aquí se indica la tabla real en la base de datos
    protected $table = 'presentaciones';

    // Si quieres asignación masiva
    protected $fillable = [
        'producto_id',
        'nombre',
        'precio_venta',
        'cantidad_base'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
