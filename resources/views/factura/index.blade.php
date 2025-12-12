@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">Lista de Facturas</h1>

    <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border p-3">ID</th>
                    <th class="border p-3">Cliente</th>
                    <th class="border p-3">Fecha</th>
                    <th class="border p-3">Total</th>
                    <th class="border p-3">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($ventas as $venta)
                <tr class="border-b hover:bg-gray-50">
                    <td class="border p-3">{{ $venta->id }}</td>

                    <td class="border p-3">
                        {{ $venta->cliente->nombre ?? 'Sin cliente' }}
                    </td>

                    <td class="border p-3">
                        {{ $venta->fecha
                            ? \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y')
                            : $venta->created_at->format('d/m/Y') }}
                    </td>

                    <td class="border p-3">
                        ${{ number_format($venta->total, 2) }}
                    </td>

                    <td class="border p-3">
                        <a href="{{ route('factura.show', $venta->id) }}"
                           class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-2 rounded-lg">
                            Ver factura
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>
@endsection
