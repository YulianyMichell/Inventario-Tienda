<h2>Factura #{{ $venta->id }}</h2>

<p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
<p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y') }}</p>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($venta->detalles as $item)
        <tr>
            <td>{{ $item->producto->nombre }}</td>
            <td>{{ $item->cantidad }}</td>
            <td>${{ $item->precio }}</td>
            <td>${{ $item->cantidad * $item->precio }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Total: ${{ $venta->total }}</h3>

<br><br>
<p>___________</p>
<p>Firma</p>