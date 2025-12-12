@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
        Gestión de Productos
    </h1>
    
    {{-- Botón para Crear Nuevo Producto --}}
    <div class="mb-4 flex justify-end">
        <a href="{{ route('productos.create') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 active:opacity-75 focus:outline-none focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150"
           style="background-color: #8BB3FF; color: #132A54;">
            <i class="bi bi-plus-circle mr-2"></i>
            Crear Nuevo Producto
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Contenedor de la Tabla --}}
    <div class="bg-white shadow-xl rounded-xl overflow-x-auto p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proveedor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Compra</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Venta</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                
                {{-- BUCLE PARA MOSTRAR LOS DATOS --}}
                @forelse ($productos as $producto)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $producto->nombre }}</td>
                        
                        {{-- Acceso a la relación Categoría (requiere with('categoria') en el controlador) --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $producto->categoria->nombre ?? 'N/A' }}
                        </td>
                        
                        {{-- Acceso a la relación Proveedor (requiere with('proveedor') en el controlador) --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $producto->proveedor->nombre ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ number_format($producto->precio_compra, 2) }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ number_format($producto->precio_venta, 2) }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->stock }}</td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-center">
                            {{-- Botones de acción (Editar y Eliminar) --}}
                            <a href="{{ route('productos.edit', $producto->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                            
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No hay productos registrados.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

@endsection