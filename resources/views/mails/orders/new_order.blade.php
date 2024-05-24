<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Compra</title>
    <style>
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: left;
            padding: 20px 0;
        }
        .header h3 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #6c757d;
            margin-top: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border-bottom: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        .table thead th {
            background-color: #f8f9fa;
        }
        .table .fila {
            padding: 20px 10px;
        }
        .summary {
            width: 100% !important;
            margin-top: 30px;
            padding-left: 30%;
            float: right !important;
            margin-bottom: 30px;
        }
        .summary th, .summary td {
            border-bottom: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        .summary thead th {
            background-color: #f8f9fa;
        }
        .footer {
            margin-top: 40px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h3>PEDIDO #{{ $order->id }}</h3>
        <p class="text-muted">Fecha pedido: {{ $order->fecha }}</p>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Artículo</th>
            <th>Precio Ud</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $producto)
            <tr>
                <td class="fila">{{ $producto->nombre }}</td>
                <td class="fila">{{ $producto->precio_ud }} EUR</td>
                <td class="fila">{{ $producto->cantidad }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table class="summary">
        <tbody>
        <tr>
            <th>Direccion de entrega</th>
            <td class="fila">{{ $order->ciudad }} ,{{ $order->direccion }}</td>
        </tr>
        <tr>
            <th>Telefono contacto</th>
            <td class="fila">{{ $order->telefono }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td class="fila">{{ $order->importe }} EUR</td>
        </tr>
        </tbody>
    </table><br>

    <div class="footer">
        <p>Gracias por tu compra, {{ $order->nombre }}!</p>
        <p>Tu pedido ha sido recibido y está siendo procesado.</p>
    </div>
</div>
</body>
</html>
