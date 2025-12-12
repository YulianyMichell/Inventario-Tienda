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
        // Traemos cliente y detalles con producto
        $ventas = Venta::with(['cliente', 'detalles.producto'])->orderBy('fecha', 'desc')->get();
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
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Validar stock disponible
        foreach ($request->productos as $prod) {
            $producto = Producto::find($prod['id']);
            if ($producto->stock < $prod['cantidad']) {
                return back()->with('error', 'No hay stock suficiente de: ' . $producto->nombre);
            }
        }

        // Crear venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'user_id' => auth()->id(),
            'total' => 0,
            'fecha' => now(),
        ]);

        $total = 0;

        // Crear detalles y actualizar stock
        foreach ($request->productos as $prod) {
            $producto = Producto::find($prod['id']);
            $precio = $producto->precio_venta; // Asegúrate de que tu tabla tiene esta columna
            $cantidad = $prod['cantidad'];
            $subtotal = $precio * $cantidad;

            VentaDetalle::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precio' => $precio,
                'subtotal' => $subtotal,
            ]);

            $stockAnterior = $producto->stock;
            $producto->stock -= $cantidad;
            $producto->save();
            $stockActual = $producto->stock;

            Inventario::create([
                'producto_id' => $producto->id,
                'user_id' => auth()->id(),
                'tipo' => 'salida',
                'cantidad' => $cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_actual' => $stockActual,
                'fecha' => now(),
                'descripcion' => 'Salida por venta #' . $venta->id,
            ]);

            $total += $subtotal;
        }

        // Actualizar total
        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente.');
    }

    // Eliminar venta y restaurar stock
    public function destroy(Venta $venta)
    {
        foreach ($venta->detalles as $detalle) {
            $producto = $detalle->producto;

            // Restaurar stock
            $stockAnterior = $producto->stock;
            $producto->stock += $detalle->cantidad;
            $producto->save();
            $stockActual = $producto->stock;

            // Registrar entrada en inventario
            Inventario::create([
                'producto_id' => $producto->id,
                'user_id' => auth()->id(),
                'tipo' => 'entrada',
                'cantidad' => $detalle->cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_actual' => $stockActual,
                'fecha' => now(),
                'descripcion' => 'Restauración por eliminación de venta #' . $venta->id,
            ]);
        }

        // Eliminar detalles y venta
        $venta->detalles()->delete();
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}
