<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'presentaciones';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'producto_id',
        'nombre',
        'precio_compra',   // 👈 AGREGA ESTE CAMPO
        'precio_venta',
        'cantidad_base'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
