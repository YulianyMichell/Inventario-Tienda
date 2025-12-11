@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2>Editar Producto</h2>

    <form action="{{ route('productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}">
        </div>

        <div class="mb-3">
            <label>Categoría</label>
            <select name="categoria_id" class="form-control">
                @foreach($categorias as $c)
                <option value="{{ $c->id }}" {{ $c->id == $producto->categoria_id ? 'selected' : '' }}>
                    {{ $c->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" class="form-control" name="precio" value="{{ $producto->precio }}">
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" class="form-control" name="stock" value="{{ $producto->stock }}">
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

</div>
@endsection
