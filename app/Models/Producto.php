<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria_id',
        'proveedor_id',
        'stock',
        
        // 💡 CAMPOS AGREGADOS/CORREGIDOS:
        'precio_compra', // Campo de costo del producto
        'precio_venta',  // Campo de venta al público
        'descripcion',   // Campo de detalles
    ];

    // RELACIONES DE PERTENENCIA (belongsTo)
    
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
    
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    // RELACIONES DE UNO A MUCHOS (hasMany)

    public function presentaciones(): HasMany
    {
        return $this->hasMany(Presentacion::class);
    }

    public function inventarios(): HasMany
    {
        return $this->hasMany(Inventario::class);
    }

    public function ventaDetalles(): HasMany
    {
        return $this->hasMany(VentaDetalle::class);
    }
}