@extends('layouts.admin')

@section('title', 'Dashboard Principal')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-celeste-suave text-azul-profundo p-6 rounded-lg shadow-xl transform transition duration-300 hover:scale-[1.02] flex flex-col items-center"
             style="background-color: #8BB3FF; color: #132A54;">
            <i class="bi bi-people text-4xl mb-2"></i>
            <h3 class="text-xl font-bold">Clientes</h3>
            <p class="text-4xl font-extrabold">6</p>
        </div>

        <div class="bg-[#132A54] text-white p-6 rounded-lg shadow-xl transform transition duration-300 hover:scale-[1.02] flex flex-col items-center">
             <i class="bi bi-box-seam text-4xl mb-2"></i>
            <h3 class="text-xl font-bold">Productos</h3>
            <p class="text-4xl font-extrabold">19</p>
        </div>

        <div class="bg-[#132A54] text-white p-6 rounded-lg shadow-xl transform transition duration-300 hover:scale-[1.02] flex flex-col items-center">
            <i class="bi bi-arrow-left-short text-4xl mb-2"></i>
            <h3 class="text-xl font-bold">Entradas</h3>
            <p class="text-4xl font-extrabold">9</p>
        </div>

        <div class="bg-[#132A54] text-white p-6 rounded-lg shadow-xl transform transition duration-300 hover:scale-[1.02] flex flex-col items-center">
            <i class="bi bi-arrow-right-short text-4xl mb-2"></i>
            <h3 class="text-xl font-bold">Salidas</h3>
            <p class="text-4xl font-extrabold">3</p>
        </div>

    </div> 
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Productos con Más Movimientos</h2>
            <div class="h-64 flex items-center justify-center text-gray-500 border-dashed border-2 p-4 rounded-lg">
                 [Integrar librería de gráficos aquí para el Bar Chart]
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Entradas y Salidas por Día</h2>
            <div class="h-64 flex items-center justify-center text-gray-500 border-dashed border-2 p-4 rounded-lg">
                [Integrar librería de gráficos aquí para el Line Chart]
            </div>
        </div>

    </div>

@endsection