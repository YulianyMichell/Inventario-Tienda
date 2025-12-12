@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Gestión de Productos</h1>
    
    <div class="flex justify-between items-center mb-6">
        
        <a href="{{ route('productos.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-celeste-suave text-azul-profundo font-semibold text-sm rounded-lg shadow-md hover:opacity-90 transition duration-150"
           style="background-color: #8BB3FF; color: #132A54;">
            <i class="bi bi-box-seam-fill mr-2"></i>
            Registrar Nuevo Producto
        </a>
        
        <form action="{{ route('productos.index') }}" method="GET" class="flex items-center">
            <input type="text" 
                   name="search" 
                   placeholder="Buscar por nombre, SKU..." 
                   value="{{ request('search') }}"
                   class="px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150">
            <button type="submit" 
                    class="px-4 py-2 bg-gray-700 text-white rounded-r-lg hover:bg-gray-800 transition duration-150">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($productos as $producto)
                    <tr class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $producto->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $producto->categoria->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-right text-green-700">${{ number_format($producto->precio, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            @if($producto->stock > 10)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $producto->stock }}
                                </span>
                            @elseif($producto->stock > 0)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $producto->stock }}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Agotado
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            
                            <a href="{{ route('productos.edit', $producto) }}" 
                               class="text-amber-600 hover:text-amber-800 mx-1 px-2 py-1 rounded-md border border-amber-300 transition duration-150"
                               title="Editar">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </a>

                            <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 mx-1 px-2 py-1 rounded-md border border-red-300 transition duration-150"
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar el producto {{ $producto->nombre }}?')"
                                        title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic">
                            No se encontraron productos registrados.
                            <a href="{{ route('productos.create') }}" class="text-indigo-600 hover:text-indigo-800 ml-1">Crea uno ahora.</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        
        {{-- Aquí se puede mostrar la paginación: {{ $productos->links() }} --}}
    </div>

@endsection