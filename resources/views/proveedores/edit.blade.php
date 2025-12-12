@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Crear Proveedor</h2>
    <hr>

    {{-- Formulario de Creación --}}
    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf

        {{-- CAMPO 1: Nombre del Proveedor --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Proveedor *</label>
            <input type="text" 
                   name="nombre" 
                   id="nombre"
                   class="form-control @error('nombre') is-invalid @enderror" 
                   value="{{ old('nombre') }}" {{-- 💡 MEJORA: Mantiene el valor en caso de error --}}
                   required>

            @error('nombre')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- CAMPO 2: Nombre de Contacto (Añadido) --}}
        <div class="mb-3">
            <label for="contacto" class="form-label">Persona de Contacto</label>
            <input type="text" 
                   name="contacto" 
                   id="contacto" 
                   class="form-control @error('contacto') is-invalid @enderror" 
                   value="{{ old('contacto') }}">

            @error('contacto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- CAMPO 3: Teléfono (Añadido) --}}
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" 
                   name="telefono" 
                   id="telefono" 
                   class="form-control @error('telefono') is-invalid @enderror" 
                   value="{{ old('telefono') }}">

            @error('telefono')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Botones de Acción --}}
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-2"></i> Guardar Proveedor
        </button>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle me-2"></i> Cancelar
        </a>

    </form>

</div>
@endsection