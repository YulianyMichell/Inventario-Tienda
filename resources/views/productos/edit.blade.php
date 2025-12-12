@extends('layouts.admin')

@section('title', 'Editar Producto')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
    Editar Producto
</h1>

<div class="bg-white shadow-xl rounded-xl p-8 max-w-4xl mx-auto">

    <form action="{{ route('productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Errores --}}
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

        {{-- Nombre del Producto --}}
        <div class="mb-5">
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Producto *</label>
            <input type="text" 
                   name="nombre" 
                   id="nombre" 
                   value="{{ old('nombre', $producto->nombre) }}"
                   required 
                   placeholder="Ej: Huevos (Cartón)"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                          focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                          transition duration-150 @error('nombre') border-red-500 @enderror">
            @error('nombre')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Categoría y Proveedor --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

            <div>
                <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría *</label>
                <select name="categoria_id" 
                        id="categoria_id" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                               focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                               transition duration-150 @error('categoria_id') border-red-500 @enderror">
                    <option value="">-- Seleccione Categoría --</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="proveedor_id" class="block text-sm font-medium text-gray-700 mb-1">Proveedor *</label>
                <select name="proveedor_id" 
                        id="proveedor_id" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                               focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                               transition duration-150 @error('proveedor_id') border-red-500 @enderror">
                    <option value="">-- Seleccione Proveedor --</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ old('proveedor_id', $producto->proveedor_id) == $proveedor->id ? 'selected' : '' }}>
                            {{ $proveedor->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('proveedor_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Precios y Stock --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

            <div>
                <label for="precio_compra" class="block text-sm font-medium text-gray-700 mb-1">Precio de Compra ($) *</label>
                <input type="number" 
                       name="precio_compra" 
                       id="precio_compra" 
                       value="{{ old('precio_compra', $producto->precio_compra) }}"
                       step="0.01" 
                       min="0.01"
                       required
                       placeholder="12000.00"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                              transition duration-150 @error('precio_compra') border-red-500 @enderror">
                @error('precio_compra')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="precio_venta" class="block text-sm font-medium text-gray-700 mb-1">Precio de Venta ($) *</label>
                <input type="number" 
                       name="precio_venta" 
                       id="precio_venta" 
                       value="{{ old('precio_venta', $producto->precio_venta) }}"
                       step="0.01" 
                       min="0.01"
                       required
                       placeholder="14000.00"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                              transition duration-150 @error('precio_venta') border-red-500 @enderror">
                @error('precio_venta')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Inicial *</label>
                <input type="number" 
                       name="stock" 
                       id="stock" 
                       value="{{ old('stock', $producto->stock) }}"
                       min="0"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                              transition duration-150 @error('stock') border-red-500 @enderror">
                @error('stock')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Descripción --}}
        <div class="mb-5">
            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" 
                      id="descripcion" 
                      rows="3"
                      placeholder="Detalles sobre el producto, presentación, calidad, etc."
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                             focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] 
                             transition duration-150 @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $producto->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="flex justify-end mt-8 pt-4 border-t border-gray-200">

            <a href="{{ route('productos.index') }}" 
               class="inline-flex items-center px-6 py-2.5 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg transition duration-150 mr-4">
                <i class="bi bi-x-circle mr-2"></i>
                Cancelar
            </a>

            <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 bg-celeste-suave text-azul-profundo font-semibold text-base rounded-lg shadow-md hover:opacity-90 transition duration-150"
                    style="background-color: #8BB3FF; color: #132A54;">
                <i class="bi bi-save mr-2"></i>
                Actualizar Producto
            </button>

        </div>

    </form>

</div>

@endsection
