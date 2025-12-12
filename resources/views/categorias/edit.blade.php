@extends('layouts.admin')

@section('title', 'Editar Categoría')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
        Editar Categoría: {{ $categoria->nombre }}
    </h1>
    
    <div class="bg-white shadow-xl rounded-xl p-8 max-w-2xl mx-auto">
        
        <form action="{{ route('categorias.update', $categoria) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <strong class="font-bold">¡Ups! Por favor, corrige los siguientes errores:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-5">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Categoría</label>
                <input type="text" 
                       name="nombre" 
                       id="nombre" 
                       value="{{ old('nombre', $categoria->nombre) }}" {{-- Se precarga el valor actual --}}
                       required 
                       placeholder="Ej: Lácteos, Panadería"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                              transition duration-150 @error('nombre') border-red-500 @enderror">
                @error('nombre')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end items-center mt-8 pt-4 border-t border-gray-200">
                
                <a href="{{ route('categorias.index') }}" 
                   class="inline-flex items-center px-6 py-2.5 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg transition duration-150 mr-4">
                    <i class="bi bi-x-circle mr-2"></i>
                    Cancelar
                </a>
                
                <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-celeste-suave text-azul-profundo font-semibold text-base rounded-lg shadow-md hover:opacity-90 transition duration-150"
                        style="background-color: #8BB3FF; color: #132A54;">
                    <i class="bi bi-arrow-repeat mr-2"></i>
                    Actualizar Categoría
                </button>
                
            </div>
            
        </form>
    </div>

@endsection