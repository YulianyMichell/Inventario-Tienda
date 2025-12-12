<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Se mantiene la carga con las relaciones para el listado
        $productos = Producto::with('categoria', 'proveedor')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('productos.create', compact('categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            
            // 💡 CAMPOS NUEVOS AGREGADOS: precio_compra, precio_venta, descripcion
            'precio_compra' => 'required|numeric|min:0', // Precio que te cuesta a ti
            'precio_venta' => 'required|numeric|min:0',  // Precio de venta al público
            'descripcion' => 'nullable|string|max:1000', // Campo de texto opcional
            
            'stock' => 'required|integer|min:0',
            
            // Campos que eliminaste en la vista pero mantenías en la validación anterior,
            // si solo usas precio_venta/compra, estos ya no son necesarios:
            // 'precio_carton' => 'nullable|numeric|min:0',
            // 'precio_unidad' => 'nullable|numeric|min:0',
            
        ]);
        
        // El Producto::create() funcionará porque $request->all() solo contiene los campos
        // que fueron validados (siempre y cuando estén en el $fillable del modelo Producto)
        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',

            // 💡 CAMPOS NUEVOS AGREGADOS: precio_compra, precio_venta, descripcion
            'precio_compra' => 'required|numeric|min:0', 
            'precio_venta' => 'required|numeric|min:0',  
            'descripcion' => 'nullable|string|max:1000',

            'stock' => 'required|integer|min:0',
            
            // 'precio_carton' => 'nullable|numeric|min:0',
            // 'precio_unidad' => 'nullable|numeric|min:0',

        ]);

        // El $producto->update() usará los campos validados
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}