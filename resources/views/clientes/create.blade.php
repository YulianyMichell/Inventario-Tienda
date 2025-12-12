@extends('layouts.admin')

@section('title', 'Crear Nuevo Cliente')

@section('content')
    
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-xl p-6 md:p-8 mt-6">
        
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2 flex items-center">
            👥 Crear Nuevo Cliente
        </h1>
        
        {{-- Mensajes de Error (Validación) --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Ocurrió un error!</strong>
                <span class="block sm:inline">Revisa los campos del formulario.</span>
            </div>
        @endif

        {{-- Formulario para crear cliente --}}
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            {{-- Campo Nombre del cliente --}}
            <div class="mb-5">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del cliente</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                
                @error('nombre')
                    <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                @enderror
            </div>
            
            {{-- Aquí puedes añadir otros campos como RUT/Identificación, Dirección, Teléfono, etc. --}}

            {{-- Botones de Acción --}}
            <div class="flex justify-end space-x-3 mt-8">
                
                {{-- Botón Guardar --}}
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring ring-blue-300 transition ease-in-out duration-150">
                    <i class="bi bi-save mr-2"></i>
                    Guardar
                </button>
                
                {{-- Botón Cancelar --}}
                <a href="{{ route('clientes.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest bg-white hover:bg-gray-50 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
@endsection