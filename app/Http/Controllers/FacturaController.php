<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // Mostrar una factura específica.
    public function show($id)
    {
        // Cargar venta con cliente y detalles incluidos
        $venta = Venta::with(['cliente', 'detalles.producto'])->findOrFail($id);

        // Calcular total si no existe en BD
        $total = 0;
        foreach ($venta->detalles as $item) {
            $total += $item->cantidad * $item->precio;
        }

        return view('factura.show', [
            'venta' => $venta,
            'total' => $total
        ]);
    }

    // Generar una lista de facturas.
      
     
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
