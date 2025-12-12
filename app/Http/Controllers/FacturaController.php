<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
{
    /**
     * Mostrar listado de facturas (basado en Ventas).
     */
    public function index()
    {
        // Eager Loading: Solo necesitamos el cliente para el índice
        $ventas = Venta::with('cliente')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
        
        // NOTA: Revisa si tu carpeta de vistas es 'factura' o 'facturas'
        return view('factura.index', compact('ventas'));
    }

    /**
     * Ver detalle de una factura.
     */
    public function show(Venta $venta)
    {
        // Eager Loading completo para el detalle: Cliente, Producto, y Presentación.
        $venta->load([
            'cliente', 
            'detalles.producto',
            'detalles.presentacion' // <-- AÑADIDO: Cargar la relación Presentacion
        ]); 
        
        // NOTA: Revisa si tu carpeta de vistas es 'factura' o 'facturas'
        return view('factura.show', compact('venta'));
    }

    /**
     * Descargar factura en PDF.
     */
    public function descargar(Venta $venta)
    {
        // Eager Loading completo para el PDF
        $venta->load([
            'cliente', 
            'detalles.producto',
            'detalles.presentacion' // <-- AÑADIDO: Cargar la relación Presentacion
        ]);

        $pdf = Pdf::loadView('factura.pdf', compact('venta'));
        return $pdf->download('Factura_'.$venta->id.'.pdf');
    }
}