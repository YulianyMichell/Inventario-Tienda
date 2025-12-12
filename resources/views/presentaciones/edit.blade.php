@extends('layouts.admin')

@section('title', 'Editar Presentación de Producto')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
    Editar Presentación: {{ $presentacion->nombre }}
</h1>

<div class="max-w-3xl bg-white p-6 rounded-xl shadow-xl">

    <form action="{{ route('presentaciones.update', $presentacion) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Producto --}}
        <div class="mb-4">
            <label for="producto_id" class="block text-gray-700 font-medium mb-2">Producto</label>
            <select name="producto_id" id="producto_id" 
                    class="w-full border-gray-300 rounded-lg p-2">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}"
                        {{ $presentacion->producto_id == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
            @error('producto_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nombre --}}
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-medium mb-2">Nombre Presentación</label>
            <input type="text" name="nombre" id="nombre" 
                   value="{{ old('nombre', $presentacion->nombre) }}" 
                   class="w-full border-gray-300 rounded-lg p-2">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Cantidad Base --}}
        <div class="mb-4">
            <label for="cantidad_base" class="block text-gray-700 font-medium mb-2">Cantidad Base (unidades)</label>
            <input type="number" name="cantidad_base" id="cantidad_base" 
                   value="{{ old('cantidad_base', $presentacion->cantidad_base) }}" 
                   class="w-full border-gray-300 rounded-lg p-2">
            @error('cantidad_base')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Precio Venta --}}
        <div class="mb-6">
            <label for="precio_venta" class="block text-gray-700 font-medium mb-2">Precio de Venta ($)</label>
            <input type="number" step="0.01" name="precio_venta" id="precio_venta" 
                   value="{{ old('precio_venta', $presentacion->precio_venta) }}" 
                   class="w-full border-gray-300 rounded-lg p-2">
            @error('precio_venta')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="flex justify-between items-center">
            <a href="{{ route('presentaciones.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-150">
               Cancelar
            </a>

            <button type="submit" 
                    class="px-6 py-2 bg-celeste-suave text-azul-profundo font-semibold rounded-lg hover:opacity-90 transition duration-150">
                Guardar Cambios
            </button>
        </div>

    </form>

</div>

@endsection
