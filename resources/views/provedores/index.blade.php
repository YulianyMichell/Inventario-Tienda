@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2>Proveedores</h2>

    <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-3">
        Crear Proveedor
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($proveedores as $prov)
            <tr>
                <td>{{ $prov->id }}</td>
                <td>{{ $prov->nombre }}</td>
                <td>
                    <a href="{{ route('proveedores.edit', $prov) }}" class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('proveedores.destroy', $prov) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar proveedor?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
