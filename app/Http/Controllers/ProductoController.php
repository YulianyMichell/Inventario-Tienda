<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra una lista del recurso.
     * Carga las relaciones (incluyendo 'presentaciones') y maneja la búsqueda.
     */
    public function index(Request $request)
    {
        // 1. Eager Loading: Carga 'presentaciones' para calcular el rango de precios en la vista
        // y carga 'categoria' y 'proveedor' para evitar consultas N+1.
        $query = Producto::with('categoria', 'proveedor', 'presentaciones');

        // 2. Manejo de la búsqueda
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                // Búsqueda por nombre o ID
                $q->where('nombre', 'like', '%' . $search . '%')
                  ->orWhere('id', $search);
            });
        }

        // Obtener los resultados
        $productos = $query->get();
        
        return view('productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('productos.create', compact('categorias', 'proveedores'));
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            
            // Campos que deberían eliminarse del producto principal
            // y gestionarse en Presentacion si usas la lógica de rangos:
            'precio_compra' => 'required|numeric|min:0', 
            'precio_venta' => 'required|numeric|min:0', 
            
            'descripcion' => 'nullable|string|max:1000', 
            'stock' => 'required|integer|min:0',
        ]);
        
        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',

            'precio_compra' => 'required|numeric|min:0', 
            'precio_venta' => 'required|numeric|min:0', 
            'descripcion' => 'nullable|string|max:1000',

            'stock' => 'required|integer|min:0',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}