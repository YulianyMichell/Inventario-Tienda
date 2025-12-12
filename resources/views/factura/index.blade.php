@extends('layouts.admin')

@section('title', 'Gestión de Facturas')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
    Gestión de Facturas
</h1>

{{-- Botón para Crear / Ver --}}
<div class="mb-4 flex justify-end">
    {{-- Aquí podrías poner un botón para “Nueva Factura” si aplica --}}
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white shadow-xl rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total ($)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($ventas as $venta)
                    <tr class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $venta->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $venta->cliente->nombre ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($venta->total, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $venta->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            
                            <a href="{{ route('factura.show', $venta) }}" 
                               class="text-indigo-600 hover:text-indigo-800 mx-1 px-2 py-1 rounded-md border border-indigo-300 transition duration-150"
                               title="Ver Detalle">
                                <i class="bi bi-eye"></i>
                                Ver
                            </a>

                            <a href="{{ route('factura.descargar', $venta) }}" 
                               class="text-green-600 hover:text-green-800 mx-1 px-2 py-1 rounded-md border border-green-300 transition duration-150"
                               title="Descargar PDF">
                                <i class="bi bi-download"></i>
                                PDF
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic">
                            No se encontraron facturas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Paginación --}}
    @if($ventas->hasPages())
    <div class="px-6 py-4 bg-gray-50">
        {{ $ventas->links() }}
    </div>
    @endif

</div>

@endsection
