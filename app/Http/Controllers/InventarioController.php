<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    // Listar inventario
    public function index()
    {
        $inventarios = Inventario::with('producto')->get();
        return view('inventario.index', compact('inventarios'));
    }

    // Mostrar formulario para crear registro
    public function create()
    {
        $productos = Producto::all();
        return view('inventario.create', compact('productos'));
    }

    // Guardar nuevo registro
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'descripcion' => 'nullable|string',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Obtener stock anterior
        $stock_anterior = $producto->stock ?? 0;

        // Calcular stock actual
        $stock_actual = $stock_anterior;
        if ($request->tipo == 'compra') {
            $stock_actual += $request->cantidad;
        } elseif ($request->tipo == 'venta') {
            $stock_actual -= $request->cantidad;
        }

        // Crear registro de inventario
        Inventario::create([
            'producto_id' => $request->producto_id,
            'user_id' => Auth::id(),
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'stock_anterior' => $stock_anterior,
            'stock_actual' => $stock_actual,
            'descripcion' => $request->descripcion,
        ]);

        // Actualizar stock del producto
        $producto->update(['stock' => $stock_actual]);

        return redirect()->route('inventario.index')->with('success', 'Registro de inventario creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        $productos = Producto::all();
        return view('inventario.edit', compact('inventario', 'productos'));
    }

    // Actualizar registro
    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'descripcion' => 'nullable|string',
        ]);

        $inventario = Inventario::findOrFail($id);
        $producto = Producto::findOrFail($request->producto_id);

        // Ajustar stock
        $stock_anterior = $inventario->stock_anterior;
        $stock_actual = $stock_anterior;
        if ($request->tipo == 'compra') {
            $stock_actual += $request->cantidad;
        } elseif ($request->tipo == 'venta') {
            $stock_actual -= $request->cantidad;
        }

        $inventario->update([
            'producto_id' => $request->producto_id,
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'stock_anterior' => $stock_anterior,
            'stock_actual' => $stock_actual,
            'descripcion' => $request->descripcion,
        ]);

        // Actualizar stock del producto
        $producto->update(['stock' => $stock_actual]);

        return redirect()->route('inventario.index')->with('success', 'Registro de inventario actualizado correctamente.');
    }

    // Eliminar registro
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();

        return redirect()->route('inventario.index')->with('success', 'Registro eliminado correctamente.');
    }
}
