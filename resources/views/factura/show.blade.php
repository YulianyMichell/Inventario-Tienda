@extends('layouts.admin')

@section('title', 'Detalle de Factura')

@section('content')
<h1 class="text-3xl font-bold mb-6">Factura #{{ $venta->id }}</h1>

<p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
<p><strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y H:i') }}</p>
<p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>

<h2 class="mt-6 font-semibold">Productos:</h2>
<ul class="list-disc list-inside">
    @foreach($venta->detalles as $detalle)
        <li>{{ $detalle->producto->nombre }} x {{ $detalle->cantidad }} ({{ number_format($detalle->precio, 2) }})</li>
    @endforeach
</ul>
@endsection
