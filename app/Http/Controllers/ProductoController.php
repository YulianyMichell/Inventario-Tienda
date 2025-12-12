<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra la lista de productos con sus relaciones,
     * incluyendo presentaciones para calcular rangos de precios.
     */
    public function index(Request $request)
    {
        $query = Producto::with('categoria', 'proveedor', 'presentaciones');

        // Búsqueda por nombre o ID
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', '%' . $search . '%')
                  ->orWhere('id', $search);
            });
        }

        $productos = $query->get();
        
        return view('productos.index', compact('productos'));
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('productos.create', compact('categorias', 'proveedores'));
    }

    /**
     * Guarda un nuevo producto.
     * Los precios NO se guardan aquí (se manejan en Presentaciones).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'descripcion' => 'nullable|string|max:1000',
            'stock' => 'required|integer|min:0',
        ]);
        
        Producto::create($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    /**
     * Formulario de edición.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    /**
     * Actualiza el producto.
     * Los precios NO se manejan aquí.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'descripcion' => 'nullable|string|max:1000',
            'stock' => 'required|integer|min:0',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Elimina el producto.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
