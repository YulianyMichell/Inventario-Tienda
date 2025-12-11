@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2>Editar Proveedor</h2>

    <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del proveedor</label>
            <input type="text" name="nombre" class="form-control" value="{{ $proveedor->nombre }}">

            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>

</div>
@endsection
