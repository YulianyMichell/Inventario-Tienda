@extends('layouts.admin')

@section('title', 'Crear Nueva Presentación')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
        Crear Nueva Presentación de Producto
    </h1>
    
    <div class="bg-white shadow-xl rounded-xl p-8 max-w-3xl mx-auto">
        
        <form action="{{ route('presentaciones.store') }}" method="POST">
            @csrf
            
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label for="producto_id" class="block text-sm font-medium text-gray-700 mb-1">Producto Base</label>
                    <select name="producto_id" 
                            id="producto_id" 
                            required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('producto_id') border-red-500 @enderror">
                        <option value="">-- Seleccione el Producto --</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Presentación</label>
                    <input type="text" 
                           name="nombre" 
                           id="nombre" 
                           value="{{ old('nombre') }}"
                           required 
                           placeholder="Ej: Unidad, Docena, Cartón de 30"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('nombre') border-red-500 @enderror">
                    @error('nombre')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label for="cantidad_base" class="block text-sm font-medium text-gray-700 mb-1">Cantidad de unidades base que contiene</label>
                    <input type="number" 
                           name="cantidad_base" 
                           id="cantidad_base" 
                           value="{{ old('cantidad_base') }}"
                           required 
                           min="1"
                           placeholder="Ej: 30 (Cartón) o 1 (Unidad individual)"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('cantidad_base') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">
                        Define cuántas unidades de inventario representa esta presentación.
                    </p>
                    @error('cantidad_base')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="precio_venta" class="block text-sm font-medium text-gray-700 mb-1">Precio de Venta para esta Presentación ($)</label>
                    <input type="number" 
                           name="precio_venta" 
                           id="precio_venta" 
                           value="{{ old('precio_venta') }}"
                           step="0.01" 
                           required 
                           placeholder="14000.00"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('precio_venta') border-red-500 @enderror">
                    @error('precio_venta')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end items-center mt-8 pt-4 border-t border-gray-200">
                <a href="{{ route('presentaciones.index') }}" 
                   class="inline-flex items-center px-6 py-2.5 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg transition duration-150 mr-4">
                    <i class="bi bi-x-circle mr-2"></i>
                    Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-celeste-suave text-azul-profundo font-semibold text-base rounded-lg shadow-md hover:opacity-90 transition duration-150"
                        style="background-color: #8BB3FF; color: #132A54;">
                    <i class="bi bi-save mr-2"></i>
                    Guardar Presentación
                </button>
            </div>
            
        </form>
    </div>
@endsection