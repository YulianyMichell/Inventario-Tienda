@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2>Editar Categoría</h2>

    <form action="{{ route('categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre de la categoría</label>
            <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}">
            
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

</div>
@endsection
