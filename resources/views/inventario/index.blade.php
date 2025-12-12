@extends('layouts.admin')

@section('title', 'Registro Histórico de Inventario')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Registro Histórico de Movimientos de Inventario</h1>
    
    <div class="mb-6">
        <p class="text-sm text-gray-500 italic">
            Esta tabla muestra automáticamente las transacciones (compras, ventas, ajustes) que afectan el stock.
        </p>
    </div>

    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Anterior</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Actual</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($movimientos as $m)
                    <tr class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $m->producto->nombre }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                            @php
                                $tipo = strtoupper($m->tipo);
                                $color = $tipo == 'ENTRADA' ? 'bg-green-100 text-green-800' : 
                                         ($tipo == 'SALIDA' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800');
                            @endphp
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                {{ $tipo }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-semibold 
                            {{ strtoupper($m->tipo) == 'ENTRADA' ? 'text-green-700' : 'text-red-700' }}">
                            {{ strtoupper($m->tipo) == 'ENTRADA' ? '+' : '-' }}{{ $m->cantidad }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">{{ $m->stock_anterior }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">{{ $m->stock_actual }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $m->usuario->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-6 text-center text-gray-500 italic">
                            No se han registrado movimientos de inventario.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        
        {{-- Aquí se puede mostrar la paginación: {{ $movimientos->links() }} --}}
    </div>

@endsection