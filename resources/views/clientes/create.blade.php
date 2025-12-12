@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h2>Crear Cliente</h2>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre del cliente</label>
            <input type="text" name="nombre" class="form-control">
            
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>

</div>
@endsection
