<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use App\Models\Producto;
use Illuminate\Http\Request;

class PresentacionController extends Controller
{
    public function index()
    {
        $presentaciones = Presentacion::with('producto')->get();
        return view('presentaciones.index', compact('presentaciones'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('presentaciones.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'nombre' => 'required|string|max:255',
            'precio_venta' => 'required|numeric|min:0',
            'cantidad_base' => 'required|integer|min:1',
        ]);

        Presentacion::create($request->all());
        return redirect()->route('presentaciones.index')->with('success', 'Presentación creada.');
    }

    public function edit(Presentacion $presentacion)
    {
        $productos = Producto::all();
        return view('presentaciones.edit', compact('presentacion', 'productos'));
    }

    public function update(Request $request, Presentacion $presentacion)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'nombre' => 'required|string|max:255',
            'precio_venta' => 'required|numeric|min:0',
            'cantidad_base' => 'required|integer|min:1',
        ]);

        $presentacion->update($request->all());
        return redirect()->route('presentaciones.index')->with('success', 'Presentación actualizada.');
    }

    public function destroy(Presentacion $presentacion)
    {
        $presentacion->delete();
        return redirect()->route('presentaciones.index')->with('success', 'Presentación eliminada.');
    }
}
