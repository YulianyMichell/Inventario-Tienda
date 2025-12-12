@extends('layouts.admin')

@section('title', 'Gestión de Categorías')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Gestión de Categorías</h1>
    
    <div class="flex justify-end mb-6">
        <a href="{{ route('categorias.create') }}" 
           class="inline-flex items-center px-6 py-2.5 bg-celeste-suave text-azul-profundo font-semibold text-base rounded-lg shadow-md hover:opacity-90 transition duration-150"
           style="background-color: #8BB3FF; color: #132A54;">
            <i class="bi bi-tags-fill mr-2"></i>
            Crear Nueva Categoría
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8/12">Nombre</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">Acciones</th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categorias as $categoria)
                    <tr class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">{{ $categoria->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $categoria->nombre }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center space-x-2">
                                
                                <a href="{{ route('categorias.edit', $categoria) }}" 
                                   class="text-sm px-3 py-1.5 rounded-lg text-azul-profundo hover:bg-[#8BB3FF]/20 transition duration-150"
                                   style="color: #132A54;">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                
                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('¿Está seguro de querer eliminar la categoría {{ $categoria->nombre }}? Esto podría afectar a los productos asociados.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-sm px-3 py-1.5 rounded-lg text-red-600 hover:bg-red-100 transition duration-150">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-6 text-center text-gray-500 italic">
                            No hay categorías registradas.
                            <a href="{{ route('categorias.create') }}" class="text-indigo-600 hover:text-indigo-800 ml-1">Crea la primera ahora.</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        
        {{-- @if($categorias->hasPages())
        <div class="px-6 py-4 bg-gray-50">
             {{ $categorias->links() }}
        </div>
        @endif --}}
    </div>

@endsection