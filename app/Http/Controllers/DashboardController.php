<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Tarjetas
        $totalProductos = Producto::count();
        $clientes = Cliente::count();
        $stockBajo = Producto::where('stock', '<', 5)->count();

        // Ventas de hoy
        $ventasHoy = Venta::whereDate('created_at', Carbon::today())->sum('total');

        // Ventas por día (últimos 7 días)
        $dias = [];
        $ventasDias = [];

        for ($i = 6; $i >= 0; $i--) {
            $dia = Carbon::today()->subDays($i);

            $dias[] = $dia->format('d M');
            $ventasDias[] = Venta::whereDate('created_at', $dia)->sum('total');
        }

        // Productos más vendidos (top 5)
        $productosMasVendidos = VentaDetalle::selectRaw('producto_id, SUM(cantidad) as total_vendido')
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

        $productosMasVendidosNombres = [];
        $productosMasVendidosCantidad = [];

        foreach ($productosMasVendidos as $item) {
            $producto = Producto::find($item->producto_id);

            if ($producto) {
                $productosMasVendidosNombres[] = $producto->nombre;
                $productosMasVendidosCantidad[] = $item->total_vendido;
            }
        }

        return view('dashboard.index', compact(
            'totalProductos',
            'clientes',
            'stockBajo',
            'ventasHoy',
            'dias',
            'ventasDias',
            'productosMasVendidosNombres',
            'productosMasVendidosCantidad'
        ));
    }
}
