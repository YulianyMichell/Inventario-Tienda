@extends('layouts.admin')

@section('title', 'Listado de Ventas')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
    Ventas Registradas
</h1>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-xl rounded-xl p-6 max-w-6xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('ventas.create') }}" 
           class="inline-flex items-center px-6 py-2.5 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:opacity-90">
            <i class="bi bi-plus-circle mr-2"></i> Nueva Venta
        </a>
        
        {{-- Formulario de Búsqueda --}}
        <form action="{{ route('ventas.index') }}" method="GET" class="flex items-center">
            <input type="text" 
                   name="search" 
                   placeholder="Buscar Cliente o ID..." 
                   value="{{ request('search') }}"
                   class="px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
            <button type="submit" 
                    class="px-4 py-2 bg-gray-700 text-white rounded-r-lg hover:bg-gray-800 transition duration-150">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Productos</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($ventas as $venta)
                    <tr>
                        <td class="px-4 py-2">{{ $venta->id }}</td>
                        <td class="px-4 py-2">{{ $venta->cliente->nombre ?? 'N/A' }}</td>
                        <td class="px-4 py-2 max-w-xs">
                            <ul class="list-disc list-inside text-sm">
                                @foreach($venta->detalles->take(2) as $detalle)
                                    <li>
                                        {{ $detalle->producto->nombre ?? 'Producto Eliminado' }} 
                                        <span class="font-medium text-blue-700">({{ $detalle->presentacion->nombre ?? 'Unidad Base' }})</span> {{-- <-- CAMBIO AÑADIDO --}}
                                        x {{ $detalle->cantidad }} 
                                    </li>
                                @endforeach
                                @if($venta->detalles->count() > 2)
                                    <li class="text-gray-500 italic mt-1">
                                        + {{ $venta->detalles->count() - 2 }} productos más.
                                    </li>
                                @endif
                            </ul>
                        </td>
                        <td class="px-4 py-2 font-semibold text-lg">${{ number_format($venta->total, 2) }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2 space-x-2 text-center whitespace-nowrap">
                            <a href="{{ route('factura.show', $venta->id) }}" 
                               class="text-blue-600 hover:text-blue-800 font-semibold"
                               title="Ver Detalles / Generar Factura">
                                <i class="bi bi-eye"></i> Ver
                            </a>

                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('¿Estás seguro de eliminar esta venta? Esto no es reversible.')"
                                        class="text-red-600 hover:text-red-800 font-semibold"
                                        title="Eliminar Venta">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">No hay ventas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    @if(isset($ventas) && $ventas instanceof \Illuminate\Contracts\Pagination\Paginator && $ventas->hasPages())
        <div class="mt-4">
            {{ $ventas->links() }}
        </div>
    @endif
</div>

@endsection