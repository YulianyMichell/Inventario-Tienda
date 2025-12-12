<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // Mostrar una factura específica.
    public function show(Venta $venta)
{
    // Cargar relaciones
    $venta->load(['cliente', 'detalles.producto']);

    // Calcular total (por si no está guardado en BD)
    $total = $venta->total ?? $venta->detalles->sum(function ($item) {
        return $item->cantidad * $item->precio;
    });

    return view('factura.show', compact('venta', 'total'));
}


    
      
     
    public function index()
    {
        $ventas = Venta::with('cliente')->orderBy('id', 'desc')->get();
        return view('factura.index', compact('ventas'));
    }

    // Descargar factura en PDF.
     
    public function descargar($id)
    {
        
    }
}
