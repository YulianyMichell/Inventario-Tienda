@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <!-- Título -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Factura #{{ $venta->id }}
        </h1>

        <a href="{{ route('factura.index') }}"
           class="bg-gray-700 hover:bg-gray-900 text-white px-4 py-2 rounded-lg">
            Volver
        </a>
    </div>

    <!-- Información del cliente -->
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6 border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Información del Cliente</h2>

        <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
        <p><strong>Correo:</strong> {{ $venta->cliente->email ?? 'N/A' }}</p>
        <p><strong>Teléfono:</strong> {{ $venta->cliente->telefono ?? 'N/A' }}</p>
        <p><strong>Fecha:</strong>
            {{ $venta->fecha
                ? \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y')
                : $venta->created_at->format('d/m/Y')
            }}
        </p>
    </div>

    <!-- Detalles de la factura -->
    <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200 mb-6">
        <h2 class="text-xl font-semibold mb-4">Detalles de la Venta</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border p-3">Producto</th>
                    <th class="border p-3">Cantidad</th>
                    <th class="border p-3">Precio</th>
                    <th class="border p-3">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach($venta->detalles as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="border p-3">{{ $item->producto->nombre }}</td>
                    <td class="border p-3">{{ $item->cantidad }}</td>
                    <td class="border p-3">${{ number_format($item->precio, 2) }}</td>
                    <td class="border p-3">
                        ${{ number_format($item->cantidad * $item->precio, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Total -->
    <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200 text-right">
        <h2 class="text-2xl font-bold">
            Total: ${{ number_format($total, 2) }}
        </h2>
    </div>

</div>
@endsection

