@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2>Editar Cliente</h2>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del cliente</label>
            <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}">
            
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>

</div>
@endsection
