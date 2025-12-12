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
        // 🛑 CORRECCIÓN CLAVE: Se usa paginate() en lugar de get()
        // para que la vista pueda usar $inventarios->links()
        $inventarios = Inventario::with('producto', 'user')
                                 ->orderBy('created_at', 'desc')
                                 ->paginate(15); // Muestra 15 registros por página

        return view('inventario.index', compact('inventarios'));
    }

    // -------------------------------------------
    // Formulario para registrar una ENTRADA
    // -------------------------------------------
    public function createEntrada()
    {
        $productos = Producto::all();
        return view('inventario.createEntrada', compact('productos'));
    }

    // -------------------------------------------
    // Guardar ENTRADA de inventario
    // -------------------------------------------
    public function storeEntrada(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
            'descripcion' => 'nullable|string|max:255',
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
            // 'fecha' ya no es necesario si usas created_at, pero si existe en la BD:
            // 'fecha'         => now(), 
            'descripcion'   => $request->descripcion
        ]);

        // Actualizar stock del producto
        $producto->update(['stock' => $stock_actual]);

        return redirect()->route('inventario.index')->with('success', 'Entrada registrada correctamente.');
    }

    // -------------------------------------------
    // Formulario para registrar una SALIDA
    // -------------------------------------------
    public function createSalida()
    {
        $productos = Producto::all();
        return view('inventario.createSalida', compact('productos'));
    }

    // -------------------------------------------
    // Guardar SALIDA de inventario
    // -------------------------------------------
    public function storeSalida(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validación para evitar stock negativo
        if ($request->cantidad > $producto->stock) {
            return back()->withInput()->with('error', 'La cantidad supera el stock disponible.');
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
            // 'fecha' ya no es necesario si usas created_at, pero si existe en la BD:
            // 'fecha'         => now(),
            'descripcion'   => $request->descripcion
        ]);

        // Actualizar stock
        $producto->update(['stock' => $stock_actual]);

        return redirect()->route('inventario.index')->with('success', 'Salida registrada correctamente.');
    }
    
    // -------------------------------------------
    // Función para el Kardex
    // -------------------------------------------
    public function kardex(Request $request)
    {
        $producto_id = $request->producto_id;
        $movimientos = []; // Inicializamos como vacío

        if ($producto_id) {
            // Se usa with('user') para cargar el usuario
            $movimientos = Inventario::where('producto_id', $producto_id)
                ->with('user') 
                ->orderBy('created_at', 'asc') // Ordenar por fecha de creación ascendente
                ->get();
        }

        $productos = Producto::all();

        return view('inventario.kardex', compact('movimientos', 'productos', 'producto_id')); // También pasamos producto_id para preseleccionar
    }

}