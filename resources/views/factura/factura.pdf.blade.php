<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura No. {{ $venta->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .header, .footer {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #333;
            font-size: 24px;
            margin: 0;
        }
        .info-box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .info-box p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .total-box {
            text-align: right;
            margin-top: 20px;
            border-top: 2px solid #333;
            padding-top: 10px;
        }
        .total-box h2 {
            font-size: 18px;
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>FACTURA DE VENTA</h1>
        <p>No. **{{ $venta->id }}**</p>
    </div>

    {{-- Información General --}}
    <div class="info-box">
        <h2 style="font-size: 16px; margin-bottom: 8px; border-bottom: 1px solid #eee;">Datos de la Venta</h2>
        <p style="width: 50%; float: left;"><strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y H:i') }}</p>
        <p style="width: 50%; float: left;"><strong>Vendedor:</strong> {{ $venta->user->name ?? 'Sistema' }}</p>
        <div style="clear: both;"></div>
        
        <h2 style="font-size: 16px; margin-top: 10px; margin-bottom: 8px; border-bottom: 1px solid #eee;">Datos del Cliente</h2>
        <p style="width: 50%; float: left;"><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
        <p style="width: 50%; float: left;"><strong>Teléfono:</strong> {{ $venta->cliente->telefono ?? 'N/A' }}</p>
        <div style="clear: both;"></div>
        <p><strong>Email:</strong> {{ $venta->cliente->email ?? 'N/A' }}</p>
    </div>

    {{-- Detalles de los Productos --}}
    <table>
        <thead>
            <tr>
                <th style="width: 45%;">Producto / Presentación</th>
                <th style="width: 15%;">Precio Unitario</th>
                <th style="width: 15%;">Cantidad</th>
                <th style="width: 25%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalles as $item)
            <tr>
                <td>
                    <strong>{{ $item->producto->nombre }}</strong>
                    <br>
                    {{-- IMPLEMENTACIÓN DE LA PRESENTACIÓN EN EL PDF --}}
                    <span style="font-size: 10px; color: #555;">(Presentación: {{ $item->presentacion->nombre ?? 'Unidad Base' }})</span>
                </td>
                <td style="text-align: right;">${{ number_format($item->precio, 2) }}</td>
                <td style="text-align: center;">{{ $item->cantidad }}</td>
                <td style="text-align: right;">${{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Total --}}
    <div class="total-box">
        <h2>TOTAL PAGADO: ${{ number_format($venta->total, 2) }}</h2>
    </div>

    <div class="footer">
        <p style="margin-top: 40px; font-size: 10px;">¡Gracias por su compra!</p>
    </div>
</div>

</body>
</html>