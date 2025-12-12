@extends('layouts.admin')

@section('title', 'Gestión de Ventas')

@section('content')
    
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Gestión de Ventas</h1>
    
    <div class="flex justify-between items-center mb-6">
        
        <a href="{{ route('ventas.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-celeste-suave text-azul-profundo font-semibold text-sm rounded-lg shadow-md hover:opacity-90 transition duration-150"
           style="background-color: #8BB3FF; color: #132A54;">
            <i class="bi bi-plus-circle mr-2"></i>
            Registrar Nueva Venta
        </a>
        
        <form action="{{ route('ventas.index') }}" method="GET" class="flex items-center">
            <input type="text" 
                   name="search" 
                   placeholder="Buscar por cliente, ID..." 
                   value="{{ request('search') }}"
                   class="px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-[#8BB3FF] focus:border-[#8BB3FF] transition duration-150">
            <button type="submit" 
                    class="px-4 py-2 bg-gray-700 text-white rounded-r-lg hover:bg-gray-800 transition duration-150">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    
                    {{-- Iterar sobre las ventas (Necesitas pasar la variable $ventas desde el controlador) --}}
                    {{-- @foreach ($ventas as $venta) --}}

                    {{-- Ejemplo 1: Venta exitosa --}}
                    <tr class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Juan Pérez</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">2025-12-10</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-700">$150.50</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Completada
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mx-1" title="Ver Detalle"><i class="bi bi-eye"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900 mx-1" title="Eliminar"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    
                    {{-- Ejemplo 2: Venta pendiente --}}
                    <tr class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Maria López</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">2025-12-11</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-yellow-700">$320.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pendiente
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mx-1" title="Ver Detalle"><i class="bi bi-eye"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900 mx-1" title="Eliminar"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    
                    {{-- @endforeach --}}
                    
                    @empty($ventas)
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
                            No se encontraron ventas registradas.
                        </td>
                    </tr>
                    @endempty
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 bg-gray-50">
            {{-- {{ $ventas->links() }} --}}
            <p class="text-sm text-gray-600">Mostrando 1 a 10 de 50 ventas.</p>
        </div>
    </div>

@endsection