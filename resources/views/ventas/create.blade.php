@extends('layouts.admin')

@section('title', 'Crear Venta')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Crear Nueva Venta</h1>

<div class="bg-white shadow-xl rounded-xl p-8 max-w-5xl mx-auto">

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <strong class="font-bold">¡Ups! Corrige los siguientes errores:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        {{-- Cliente --}}
        <div class="mb-6">
            <label for="cliente_id" class="block text-sm font-medium text-gray-700 mb-1">Cliente *</label>
            <select name="cliente_id" id="cliente_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150 @error('cliente_id') border-red-500 @enderror">
                <option value="">-- Seleccione Cliente --</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
            @error('cliente_id')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Productos --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Productos *</label>
            <table class="min-w-full divide-y divide-gray-200 mb-4" id="tabla-productos">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Filas dinámicas aquí --}}
                </tbody>
            </table>

            <button type="button" id="agregar-producto"
                    class="px-4 py-2 bg-celeste-suave text-azul-profundo rounded-lg shadow-md hover:opacity-90 transition duration-150"
                    style="background-color: #8BB3FF; color: #132A54;">
                <i class="bi bi-plus-circle mr-2"></i> Agregar Producto
            </button>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end mt-8 pt-4 border-t border-gray-200">
            <a href="{{ route('ventas.index') }}" 
               class="inline-flex items-center px-6 py-2.5 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg transition duration-150 mr-4">
                <i class="bi bi-x-circle mr-2"></i> Cancelar
            </a>
            <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 bg-celeste-suave text-azul-profundo font-semibold text-base rounded-lg shadow-md hover:opacity-90 transition duration-150"
                    style="background-color: #8BB3FF; color: #132A54;">
                <i class="bi bi-save mr-2"></i> Guardar Venta
            </button>
        </div>

    </form>
</div>

{{-- Script para agregar productos dinámicamente --}}
<script>
    const productos = @json($productos);
    const tabla = document.querySelector('#tabla-productos tbody');
    let index = 0;

    document.getElementById('agregar-producto').addEventListener('click', () => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td class="px-4 py-2">
                <select name="productos[${index}][id]" required
                        class="w-full px-2 py-1 border border-gray-300 rounded-lg">
                    <option value="">-- Seleccione Producto --</option>
                    ${productos.map(p => `<option value="${p.id}">${p.nombre} (Stock: ${p.stock})</option>`).join('')}
                </select>
            </td>
            <td class="px-4 py-2">
                <input type="number" name="productos[${index}][cantidad]" min="1" value="1" required
                       class="w-full px-2 py-1 border border-gray-300 rounded-lg">
            </td>
            <td class="px-4 py-2">
                <button type="button" class="text-red-600 hover:text-red-800 font-semibold" onclick="this.closest('tr').remove()">Eliminar</button>
            </td>
        `;
        tabla.appendChild(row);
        index++;
    });
</script>

@endsection
