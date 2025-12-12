@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-semibold mb-8">Crear Producto</h1>

<div class="max-w-lg bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/20">

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf

        <label class="text-white">Nombre</label>
        <input type="text" name="nombre"
            class="w-full mt-1 mb-4 px-4 py-2 rounded-lg bg-white/20 text-white outline-none border border-white/20">

        <label class="text-white">Categoría</label>
        <select name="categoria_id"
            class="w-full mt-1 mb-4 px-4 py-2 rounded-lg bg-white/20 text-white border border-white/20">
            @foreach ($categorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
            @endforeach
        </select>

        <label class="text-white">Precio</label>
        <input type="number" name="precio"
            class="w-full mt-1 mb-4 px-4 py-2 rounded-lg bg-white/20 text-white border border-white/20">

        <label class="text-white">Stock</label>
        <input type="number" name="stock"
            class="w-full mt-1 mb-6 px-4 py-2 rounded-lg bg-white/20 text-white border border-white/20">

        <div class="flex gap-4">
            <button class="bg-purple-500 px-5 py-2 rounded-lg hover:bg-purple-600 text-white">Guardar</button>
            <a href="{{ route('productos.index') }}" class="px-5 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white">Cancelar</a>
        </div>
    </form>

</div>

@endsection
