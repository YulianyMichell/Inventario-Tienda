@extends('layout.app')

@section('content')
<div class="container mt-4">

    <h2>Movimientos de Inventario</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Stock anterior</th>
                <th>Stock actual</th>
                <th>Fecha</th>
                <th>Usuario</th>
            </tr>
        </thead>

        <tbody>
            @foreach($movimientos as $m)
            <tr>
                <td>{{ $m->producto->nombre }}</td>
                <td>{{ $m->tipo }}</td>
                <td>{{ $m->cantidad }}</td>
                <td>{{ $m->stock_anterior }}</td>
                <td>{{ $m->stock_actual }}</td>
                <td>{{ $m->created_at }}</td>
                <td>{{ $m->usuario->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
