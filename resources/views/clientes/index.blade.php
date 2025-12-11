@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2>Clientes</h2>

    <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">
        Crear Cliente
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Cliente</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($clientes as $cl)
            <tr>
                <td>{{ $cl->id }}</td>
                <td>{{ $cl->nombre }}</td>
                <td>
                    <a href="{{ route('clientes.edit', $cl) }}" class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('clientes.destroy', $cl) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar cliente?')">
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
