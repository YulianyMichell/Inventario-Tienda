<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use App\Models\Producto;
use Illuminate\Http\Request;

class PresentacionController extends Controller
{
    /**
     * Muestra una lista de todas las presentaciones.
     */
    public function index()
    {
        // Carga todas las presentaciones y precarga la relación con el producto.
        $presentaciones = Presentacion::with('producto')->get();
        return view('presentaciones.index', compact('presentaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva presentación.
     */
    public function create()
    {
        // Necesitas todos los productos para el selector.
        $productos = Producto::all(); 
        return view('presentaciones.create', compact('productos'));
    }

    /**
     * Almacena una nueva presentación en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'nombre' => 'required|string|max:255',
            'precio_venta' => 'required|numeric|min:0',
            'cantidad_base' => 'required|integer|min:1',
        ]);

        Presentacion::create($request->all());

        return redirect()->route('presentaciones.index')->with('success', 'Presentación creada correctamente.');
    }

    /**
     * Muestra el formulario para editar una presentación existente.
     */
    public function edit(Presentacion $presentacion)
    {
        $productos = Producto::all();
        return view('presentaciones.edit', compact('presentacion', 'productos'));
    }

    /**
     * Actualiza una presentación existente en la base de datos.
     */
    public function update(Request $request, Presentacion $presentacion)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'nombre' => 'required|string|max:255',
            'precio_venta' => 'required|numeric|min:0',
            'cantidad_base' => 'required|integer|min:1',
        ]);

        $presentacion->update($request->all());

        return redirect()->route('presentaciones.index')->with('success', 'Presentación actualizada correctamente.');
    }

    /**
     * Elimina una presentación de la base de datos.
     */
    public function destroy(Presentacion $presentacion)
    {
        $presentacion->delete();

        return redirect()->route('presentaciones.index')->with('success', 'Presentación eliminada correctamente.');
    }
}