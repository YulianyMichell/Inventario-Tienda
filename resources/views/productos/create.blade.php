@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2>Crear Producto</h2>

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre">
        </div>

        <div class="mb-3">
            <label>Categoría</label>
            <select name="categoria_id" class="form-control">
                @foreach($categorias as $c)
                <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="precio" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control">
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

</div>
@endsection
