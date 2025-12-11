<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Inventario;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Mostrar listado de ventas
    public function index()
    {
        $ventas = Venta::with('cliente')->orderBy('fecha', 'desc')->get();
        return view('ventas.index', compact('ventas'));
    }

    // Mostrar formulario para crear venta
    public function create()
    {
        $productos = Producto::all();
        $clientes = Cliente::all();

        return view('ventas.create', compact('productos', 'clientes'));
    }

    // Guardar la venta
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'cliente_id' => 'required',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);

        // Validación de stock suficiente
        foreach ($request->productos as $prod) {
            $producto = Producto::find($prod['id']);

            if ($producto->stock < $prod['cantidad']) {
                return back()->with('error', 'No hay stock suficiente del producto: ' . $producto->nombre);
            }
        }

        // Crear venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'user_id'    => auth()->id(),
            'total'      => 0,
            'fecha'      => now(),
        ]);

        $total = 0;

        // Recorrer productos y crear detalles
        foreach ($request->productos as $prod) {
            $producto = Producto::find($prod['id']);

            $subtotal = $producto->precio * $prod['cantidad'];
            $total += $subtotal;

            // Guardar detalle
            VentaDetalle::create([
                'venta_id'    => $venta->id,
                'producto_id' => $producto->id,
                'cantidad'    => $prod['cantidad'],
                'precio'      => $producto->precio,
                'subtotal'    => $subtotal,
            ]);

            // Stock antes
            $stockAnterior = $producto->stock;

            // Restar stock
            $producto->stock -= $prod['cantidad'];
            $producto->save();

            // Stock actual
            $stockActual = $producto->stock;

            // Registrar movimiento en inventario (salida por venta)
            Inventario::create([
                'producto_id'    => $producto->id,
                'user_id'        => auth()->id(),
                'tipo'           => 'salida',
                'cantidad'       => $prod['cantidad'],
                'stock_anterior' => $stockAnterior,
                'stock_actual'   => $stockActual,
                'fecha'          => now(),
                'descripcion'    => 'Salida por venta #' . $venta->id,
            ]);
        }

        // Actualizar total final de la venta
        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente.');
    }
}
