@extends('layouts.admin')

@section('title', 'Dashboard Principal')

@section('content')
    
<h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Clientes --}}
    <div class="bg-celeste-suave text-azul-profundo p-6 rounded-lg shadow-xl transform transition duration-300 hover:scale-[1.02] flex flex-col items-center"
         style="background-color: #8BB3FF; color: #132A54;">
        <i class="bi bi-people text-4xl mb-2"></i>
        <h3 class="text-xl font-bold">Clientes</h3>
        <p class="text-4xl font-extrabold">{{ $clientes }}</p>
    </div>

    {{-- Productos --}}
    <div class="bg-[#132A54] text-white p-6 rounded-lg shadow-xl transform transition duration-300 hover:scale-[1.02] flex flex-col items-center">
         <i class="bi bi-box-seam text-4xl mb-2"></i>
        <h3 class="text-xl font-bold">Productos</h3>
        <p class="text-4xl font-extrabold">{{ $totalProductos }}</p>
    </div>

    {{-- Stock bajo --}}
    <div class="bg-[#132A54] text-white p-6 rounded-lg shadow-xl transform transition duration-300 hover:scale-[1.02] flex flex-col items-center">
        <i class="bi bi-exclamation-triangle text-4xl mb-2"></i>
        <h3 class="text-xl font-bold">Stock Bajo</h3>
        <p class="text-4xl font-extrabold">{{ $stockBajo }}</p>
    </div>

    {{-- Ventas hoy --}}
    <div class="bg-[#132A54] text-white p-6 rounded-lg shadow-xl transform transition duration-300 hover:scale-[1.02] flex flex-col items-center">
        <i class="bi bi-currency-dollar text-4xl mb-2"></i>
        <h3 class="text-xl font-bold">Ventas Hoy</h3>
        <p class="text-4xl font-extrabold">${{ number_format($ventasHoy, 2) }}</p>
    </div>

</div> 

{{-- Gráficos --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Productos más vendidos --}}
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Productos Más Vendidos</h2>
        <canvas id="productosChart" class="h-64 w-full"></canvas>
    </div>

    {{-- Ventas últimos 7 días --}}
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Ventas Últimos 7 Días</h2>
        <canvas id="ventasChart" class="h-64 w-full"></canvas>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Productos más vendidos
    new Chart(document.getElementById('productosChart'), {
        type: 'bar',
        data: {
            labels: @json($productosMasVendidosNombres),
            datasets: [{
                label: 'Cantidad Vendida',
                data: @json($productosMasVendidosCantidad),
                backgroundColor: '#8BB3FF'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    // Ventas últimos 7 días
    new Chart(document.getElementById('ventasChart'), {
        type: 'line',
        data: {
            labels: @json($dias),
            datasets: [{
                label: 'Ventas ($)',
                data: @json($ventasDias),
                borderColor: '#132A54',
                backgroundColor: 'rgba(139,179,255,0.3)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive: true }
    });
</script>

@endsection
