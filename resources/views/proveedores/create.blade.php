@extends('layouts.admin')

@section('title', 'Crear Proveedor')

@section('content')
    
    {{-- Título de la página, alineado con el diseño de Crear Producto --}}
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
        Crear Nuevo Proveedor
    </h1>
    
    {{-- Contenedor principal con sombra y fondo blanco --}}
    <div class="bg-white shadow-xl rounded-xl p-8 max-w-4xl mx-auto">
        
        <form action="{{ route('proveedores.store') }}" method="POST">
            @csrf

            {{-- Fila 1: Nombre del Proveedor --}}
            <div class="mb-5">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre del Proveedor *
                </label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       value="{{ old('nombre') }}"
                       required 
                       placeholder="Ej: Distribuidora La Granja S.A."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                              transition duration-150 @error('nombre') border-red-500 @enderror">
                
                @error('nombre')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones de Acción --}}
            <div class="flex justify-end mt-8 pt-4 border-t border-gray-200">
                
                <a href="{{ route('proveedores.index') }}" 
                   class="inline-flex items-center px-6 py-2.5 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg transition duration-150 mr-4">
                    <i class="bi bi-x-circle mr-2"></i>
                    Cancelar
                </a>
                
                <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-celeste-suave text-azul-profundo font-semibold text-base rounded-lg shadow-md hover:opacity-90 transition duration-150"
                        style="background-color: #8BB3FF; color: #132A54;">
                    <i class="bi bi-save mr-2"></i>
                    Guardar Proveedor
                </button>
                
            </div>
            
        </form>
    </div>

@endsection