<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Compra</title>
    <style>
        body {
            background-color: #f1f1f1;
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header h3 {
            margin: 0;
            font-size: 28px;
            color: #2c3e50;
        }
        .header p {
            color: #7f8c8d;
            margin-top: 10px;
            font-size: 16px;
        }
        .table, .summary {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td, .summary th, .summary td {
            border-bottom: 1px solid #ecf0f1;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        .table thead th, .summary thead th {
            background-color: #ecf0f1;
            color: #2c3e50;
            font-size: 16px;
        }
        .table .fila img {
            border-radius: 10px;
            width: 70px;
            height: 70px;
        }
        .summary {
            margin-top: 30px;
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #7f8c8d;
        }
        button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #2c3e50;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        button:hover {
            background-color: #34495e;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        button a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h3>CONFIRMACIÓN DEL PEDIDO #{{ $order->id }}</h3>
        <p class="text-muted">Fecha pedido: {{ date('d/m/Y', strtotime($order->fecha)) }}</p>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Artículo</th>
            <th>Precio Ud</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $producto)
            <tr>
                <td class="fila"><img class="portada" src="{{ $producto->imagen }}"></td>
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
            <th>Dirección de entrega</th>
            <td>{{ $order->ciudad }} ,{{ $order->direccion }}</td>
        </tr>
        <tr>
            <th>Teléfono de contacto</th>
            <td>{{ $order->telefono }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>{{ $order->importe }} EUR</td>
        </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Gracias por tu compra, {{ $order->nombre }}, tu pedido ha sido recibido.</p>
        <p>Esperamos que disfrutes tu pedido. Si tienes alguna pregunta, no dudes en contactarnos.</p>
    </div>
    <button>
        <a href="http://localhost:5173/">Volver al inicio</a>
    </button>
</div>
</body>
</html>
