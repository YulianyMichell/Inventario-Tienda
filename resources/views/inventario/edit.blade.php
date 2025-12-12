@extends('layouts.admin')

@section('title', 'Editar Movimiento de Inventario')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
        Editar Movimiento #{{ $movimiento->id }}
    </h1>
    
    <div class="bg-white shadow-xl rounded-xl p-8 max-w-4xl mx-auto">
        
        <form action="{{ route('inventario.update', $movimiento) }}" method="POST">
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

            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                <p class="font-bold">Advertencia:</p>
                <p class="text-sm">La edición de un movimiento de inventario puede requerir recalcular el stock del producto afectado. Procede con precaución.</p>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Transacción</label>
                    <select name="tipo" 
                            id="tipo" 
                            required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('tipo') border-red-500 @enderror">
                        <option value="">-- Seleccione el Tipo --</option>
                        <option value="ENTRADA" {{ old('tipo', $movimiento->tipo) == 'ENTRADA' ? 'selected' : '' }}>
                            ENTRADA (Aumento de Stock por Compra/Ingreso)
                        </option>
                        <option value="SALIDA" {{ old('tipo', $movimiento->tipo) == 'SALIDA' ? 'selected' : '' }}>
                            SALIDA (Disminución de Stock por Venta/Ajuste)
                        </option>
                    </select>
                    @error('tipo')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="producto_id" class="block text-sm font-medium text-gray-700 mb-1">Producto</label>
                    <select name="producto_id" 
                            id="producto_id" 
                            required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('producto_id') border-red-500 @enderror">
                        <option value="">-- Seleccione el Producto --</option>
                        {{-- Iterar sobre tus productos ($productos) y seleccionar el actual --}}
                        {{-- @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id', $movimiento->producto_id) == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                        @endforeach --}}
                        
                        {{-- Placeholder para ejemplo: --}}
                        <option value="1" {{ old('producto_id', $movimiento->producto_id) == 1 ? 'selected' : '' }}>Huevos (Cartón)</option>
                        <option value="2" {{ old('producto_id', $movimiento->producto_id) == 2 ? 'selected' : '' }}>Café Molido</option>
                    </select>
                    @error('producto_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <h3 class="text-lg font-semibold border-t pt-4 mt-4 text-gray-800">
                Detalles de la Transacción
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 mt-4">

                <div>
                    <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-1">Cantidad a Mover</label>
                    <input type="number" 
                           name="cantidad" 
                           id="cantidad" 
                           value="{{ old('cantidad', $movimiento->cantidad) }}"
                           required 
                           min="1"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('cantidad') border-red-500 @enderror">
                    @error('cantidad')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="costo" class="block text-sm font-medium text-gray-700 mb-1">Costo Total (Solo si es ENTRADA)</label>
                    <input type="number" 
                           name="costo" 
                           id="costo" 
                           value="{{ old('costo', $movimiento->costo) }}"
                           step="0.01"
                           placeholder="0.00"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('costo') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">
                        Si es SALIDA, este campo puede dejarse en blanco o en cero.
                    </p>
                    @error('costo')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="referencia" class="block text-sm font-medium text-gray-700 mb-1">Referencia / Observaciones</label>
                    <input type="text" 
                           name="referencia" 
                           id="referencia" 
                           value="{{ old('referencia', $movimiento->referencia) }}"
                           placeholder="Ej: Factura #1234, Venta Tienda, Ajuste por Merma"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('referencia') border-red-500 @enderror">
                    @error('referencia')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end items-center mt-8 pt-4 border-t border-gray-200">
                
                <a href="{{ route('inventario.index') }}" 
                   class="inline-flex items-center px-6 py-2.5 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg transition duration-150 mr-4">
                    <i class="bi bi-x-circle mr-2"></i>
                    Cancelar
                </a>
                
                <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-celeste-suave text-azul-profundo font-semibold text-base rounded-lg shadow-md hover:opacity-90 transition duration-150"
                        style="background-color: #8BB3FF; color: #132A54;">
                    <i class="bi bi-arrow-repeat mr-2"></i>
                    Actualizar Movimiento
                </button>
                
            </div>
            
        </form>
    </div>

@endsection