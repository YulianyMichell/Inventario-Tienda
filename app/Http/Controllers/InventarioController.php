<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    // -------------------------------------------
    // Mostrar todos los movimientos del inventario
    // -------------------------------------------
    public function index()
    {
        $movimientos = Inventario::with('producto', 'usuario')->orderBy('created_at', 'desc')->get();

        return view('inventario.index', compact('movimientos'));
    }
    // Formulario para registrar una ENTRADA
    
    public function createEntrada()
    {
        $productos = Producto::all();
        return view('inventario.createEntrada', compact('productos'));
    }
    // Guardar ENTRADA de inventario
    
    public function storeEntrada(Request $request)
    {
        $request->validate([
            'producto_id' => 'required',
            'cantidad'    => 'required|integer|min:1',
            'descripcion' => 'nullable|string',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        $stock_anterior = $producto->stock;
        $stock_actual   = $stock_anterior + $request->cantidad;

        // Registrar movimiento
        Inventario::create([
            'producto_id'   => $request->producto_id,
            'user_id'       => Auth::id(),
            'tipo'          => 'entrada',
            'cantidad'      => $request->cantidad,
            'stock_anterior'=> $stock_anterior,
            'stock_actual'  => $stock_actual,
            'fecha'         => now(),
            'descripcion'   => $request->descripcion
        ]);

        // Actualizar stock del producto
        $producto->update(['stock' => $stock_actual]);

        return redirect()->route('inventario.index')->with('success', 'Entrada registrada correctamente.');
    }
    // Formulario para registrar una SALIDA
    public function createSalida()
    {
        $productos = Producto::all();
        return view('inventario.createSalida', compact('productos'));
    }
    // Guardar SALIDA de inventario
        public function storeSalida(Request $request)
    {
        $request->validate([
            'producto_id' => 'required',
            'cantidad'    => 'required|integer|min:1',
            'descripcion' => 'nullable|string',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($request->cantidad > $producto->stock) {
            return back()->with('error', 'La cantidad supera el stock disponible.');
        }

        $stock_anterior = $producto->stock;
        $stock_actual   = $stock_anterior - $request->cantidad;

        // Registrar movimiento
        Inventario::create([
            'producto_id'   => $request->producto_id,
            'user_id'       => Auth::id(),
            'tipo'          => 'salida',
            'cantidad'      => $request->cantidad,
            'stock_anterior'=> $stock_anterior,
            'stock_actual'  => $stock_actual,
            'fecha'         => now(),
            'descripcion'   => $request->descripcion
        ]);

        // Actualizar stock
        $producto->update(['stock' => $stock_actual]);

        return redirect()->route('inventario.index')->with('success', 'Salida registrada correctamente.');
    }
}
