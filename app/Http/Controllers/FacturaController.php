<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
{
    /**
     * Mostrar listado de facturas.
     */
    public function index()
    {
        $ventas = Venta::with('cliente')->orderBy('created_at', 'desc')->paginate(15);
        return view('factura.index', compact('ventas'));
    }

    /**
     * Ver detalle de una factura.
     */
    public function show(Venta $venta)
    {
        $venta->load('cliente', 'detalles.producto'); // Cargar detalles y productos relacionados
        return view('factura.show', compact('venta'));
    }

    /**
     * Descargar factura en PDF.
     */
    public function descargar(Venta $venta)
    {
        $venta->load('cliente', 'detalles.producto');

        $pdf = Pdf::loadView('factura.pdf', compact('venta'));
        return $pdf->download('Factura_'.$venta->id.'.pdf');
    }
}
