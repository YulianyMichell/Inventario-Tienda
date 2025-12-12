<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Inventario;
use App\Models\Presentacion;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Muestra listado de ventas.
     * Incluye Eager Loading, Búsqueda y Paginación para optimización.
     */
    public function index(Request $request)
    {
        // Eager Loading Optimizado:
        // Cargamos 'detalles.presentacion', 'cliente' y 'detalles.producto'.
        $query = Venta::with([
            'cliente', 
            'detalles.producto', 
            'detalles.presentacion'
        ])->orderBy('fecha', 'desc');

        // Lógica de Búsqueda (por ID de venta o nombre de cliente)
        if ($request->filled('search')) {
            $search = $request->input('search');
            
            $query->where('id', $search) // Buscar por ID de Venta
                  ->orWhereHas('cliente', function ($q) use ($search) {
                      // Buscar por nombre del cliente
                      $q->where('nombre', 'like', '%' . $search . '%');
                  });
        }

        // Paginación para un mejor rendimiento
        $ventas = $query->paginate(15); 
        
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Muestra formulario para crear venta.
     */
    public function create()
    {
        // CORRECCIÓN APLICADA: Cargar productos con sus presentaciones (Eager Loading)
        $productos = Producto::with('presentaciones')->get();
        $clientes = Cliente::all();
        
        return view('ventas.create', compact('productos', 'clientes'));
    }

    /**
     * Guarda la venta y sus detalles, actualizando el stock e inventario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.presentacion_id' => 'required|exists:presentaciones,id', // Se requiere el ID de la Presentación
        ]);

        // 1. Validar stock disponible (validación simple contra stock de Producto)
        foreach ($request->productos as $prod) {
            $producto = Producto::find($prod['id']);
            if ($producto->stock < $prod['cantidad']) {
                 return back()->with('error', 'No hay stock suficiente de: ' . $producto->nombre);
            }
        }

        // 2. Crear venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'user_id' => auth()->id(),
            'total' => 0,
            'fecha' => now(),
        ]);

        $total = 0;

        // 3. Crear detalles y actualizar stock
        foreach ($request->productos as $prod) {
            $producto = Producto::find($prod['id']);
            $presentacion = Presentacion::find($prod['presentacion_id']);
            
            // Obtener precio de la Presentación
            $precio = $presentacion->precio_venta; 
            $cantidad = $prod['cantidad'];
            $subtotal = $precio * $cantidad;

            VentaDetalle::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
                'presentacion_id' => $presentacion->id, // Guardar el ID de Presentación
                'cantidad' => $cantidad,
                'precio' => $precio,
                'subtotal' => $subtotal,
            ]);

            // Restar stock y registrar movimiento de inventario
            $stockAnterior = $producto->stock;
            $producto->stock -= $cantidad; // Resta asumiendo que es en unidades base
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

        // 4. Actualizar total
        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente.');
    }

    /**
     * Elimina venta y restaura stock.
     */
    public function destroy(Venta $venta)
    {
        $venta->load('detalles.producto'); // Aseguramos que los productos estén cargados

        foreach ($venta->detalles as $detalle) {
            // Asegurarse de que $detalle->producto exista antes de manipular stock
            if ($detalle->producto) {
                $producto = $detalle->producto;

                // Restaurar stock
                $stockAnterior = $producto->stock;
                $producto->stock += $detalle->cantidad;
                $producto->save();
                $stockActual = $producto->stock;

                // Registrar entrada en inventario por restauración
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
        }

        // Eliminar detalles y venta
        $venta->detalles()->delete();
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}