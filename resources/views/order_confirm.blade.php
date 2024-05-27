<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Compra</title>
    <style>
        body{
            background-image: url("/public/fondo.jpg") ;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            padding: 75px;
            padding-top: 30px !important;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            background-color: white;
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
        .portada{
            height: 90px;
            width: 90px;
        }
        button {
            margin-left: 43%;
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: white;
            background-color: #2a2a2a;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #505050;
            color: #1c1c1c;
        }
        button a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body class="view">
<div class="container">
    <div class="header">
        <h3>CONFIRMACIÓN DEL PEDIDO #{{ $order->id }}</h3>
        <p class="text-muted">Fecha pedido: {{ $order->fecha }}</p>
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
        <p>Gracias por tu compra, {{ $order->nombre }}, tu pedido ha sido recibido</p>
    </div>
    <div class="footer">
        <p>Esperamos que disfrutes tu pedido. Si tienes alguna pregunta, no dudes en contactarnos.</p>
    </div>
    <button>
        <a href="http://localhost:5173/"> Volver al inicio</a>
    </button>
</div>
</body>
</html>
