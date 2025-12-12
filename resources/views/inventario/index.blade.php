@extends('layouts.admin')

@section('title', 'Historial de Movimientos de Inventario')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
        📦 Historial de Inventario
    </h1>
    
    {{-- Botones para Registrar Movimiento (Entrada y Salida) --}}
    <div class="mb-4 flex justify-end space-x-3">
        
        {{-- Botón de Entrada (Con los colores originales solicitados) --}}
        <a href="{{ route('inventario.createEntrada') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 active:opacity-75 focus:outline-none focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150"
           style="background-color: #8BB3FF; color: #132A54;">
            <i class="bi bi-plus-circle mr-2"></i>
            Registrar Entrada Manual
        </a>
        
        {{-- Botón de Salida (Añadido con color rojo estándar) --}}
        <a href="{{ route('inventario.createSalida') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 active:opacity-75 focus:outline-none focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
           style="background-color: #EF4444; color: white;">
            <i class="bi bi-dash-circle mr-2"></i>
            Registrar Salida Manual
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Contenedor de la Tabla --}}
    <div class="bg-white shadow-xl rounded-xl overflow-x-auto p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    {{-- Columnas de Inventario: created_at, producto_id, tipo, cantidad, stock_anterior, stock_actual, descripcion, user_id --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Anterior</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Actual</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registrado por</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                
                @forelse ($inventarios as $movimiento)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $movimiento->created_at->format('d/m/Y H:i') }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $movimiento->producto->nombre ?? 'Producto Eliminado' }}
                        </td>
                        
                        {{-- Colorea el tipo de movimiento --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                            @php
                                $color = $movimiento->tipo === 'entrada' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                {{ ucfirst($movimiento->tipo) }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $movimiento->cantidad }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            {{ $movimiento->stock_anterior }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900">
                            {{ $movimiento->stock_actual }}
                        </td>
                        
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $movimiento->descripcion }}">
                            {{ $movimiento->descripcion }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $movimiento->user->name ?? 'Sistema/N/A' }}
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No hay movimientos de inventario registrados.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        
        {{-- Enlaces de Paginación --}}
        <div class="mt-4">
            {{ $inventarios->links() }}
        </div>
    </div>

@endsection