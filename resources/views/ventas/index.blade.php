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

<div class="bg-white shadow-xl rounded-xl p-8 max-w-6xl mx-auto">

    <a href="{{ route('ventas.create') }}" 
       class="inline-flex items-center px-6 py-2.5 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:opacity-90 mb-4">
        <i class="bi bi-plus-circle mr-2"></i> Nueva Venta
    </a>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Productos</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($ventas as $venta)
                <tr>
                    <td class="px-4 py-2">{{ $venta->id }}</td>
                    <td class="px-4 py-2">{{ $venta->cliente->nombre }}</td>
                    <td class="px-4 py-2">
                        <ul class="list-disc list-inside">
                            @foreach($venta->detalles as $detalle)
                                <li>{{ $detalle->producto->nombre }} x {{ $detalle->cantidad }} ({{ number_format($detalle->precio, 2) }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-2 font-semibold">${{ number_format($venta->total, 2) }}</td>
                    <td class="px-4 py-2">{{ $venta->fecha->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('factura.show', $venta->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold">
                            Ver
                        </a>

                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('¿Estás seguro de eliminar esta venta?')"
                                    class="text-red-600 hover:text-red-800 font-semibold">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No hay ventas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
