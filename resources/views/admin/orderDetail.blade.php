@extends('layouts.admin')

@section('content')
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 30px;
        }
        .card-title {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #343a40;
        }
        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }
        .card-text strong {
            color: #495057;
        }
        .btn-primary, .btn-secondary {
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 50px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-primary {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-primary:hover {
            background-color: #138496;
            box-shadow: 0 8px 15px rgba(23, 162, 184, 0.3);
        }
        .btn-secondary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-secondary:hover {
            background-color: #218838;
            box-shadow: 0 8px 15px rgba(40, 167, 69, 0.3);
        }
        .text-center {
            color: #343a40;
            font-weight: bold;
        }
        .product-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .product-card h5 {
            color: #007bff;
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
    </style>

    <div class="container">
        <h2 class="text-center mb-4">Detalles del Pedido #{{ $order->id }}</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detalles del Pedido</h5>
                <p class="card-text"><strong>Estado:</strong> <span id="order-status">{{ $order->estado }}</span></p>
                <p class="card-text"><strong>Importe:</strong> €{{ number_format($order->importe, 2) }}</p>
                <p class="card-text"><strong>Fecha:</strong> {{ $order->fecha }}</p>
                <p class="card-text"><strong>Nombre:</strong> {{ $order->nombre }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $order->email }}</p>
                <p class="card-text"><strong>Dirección:</strong> {{ $order->direccion }}, {{ $order->ciudad }}, {{ $order->provincia }} - {{ $order->codPostal }}</p>
                <p class="card-text"><strong>Teléfono:</strong> {{ $order->telefono }}</p>
                @php
                    $buttonClass = '';
                    $buttonText = '';

                    switch ($order->estado) {
                        case 'pagado':
                            $buttonClass = 'btn-success';
                            $buttonText = 'Marcar como preparado';
                            break;
                        case 'enviado':
                            $buttonClass = 'btn-primary';
                            $buttonText = 'Esperando al repartidor';
                            break;
                        case 'cancelado':
                            $buttonClass = 'btn-danger';
                            $buttonText = 'Pedido Cancelado';
                            break;
                        case 'entregado':
                            $buttonClass = 'btn-secondary';
                            $buttonText = 'Pedido Entregado';
                            break;
                        default:
                            $buttonClass = 'btn-secondary';
                            $buttonText = 'Estado Desconocido';
                            break;
                    }
                @endphp

                <button id="update-status-btn" class="btn {{ $buttonClass }}">
                    {{ $buttonText }}
                </button>
            </div>
        </div>

        <h3 class="text-center my-4">Productos</h3>
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4">
                    <div class="product-card">
                        <h5>{{ $producto->nombre }}</h5>
                        <p><strong>Precio:</strong> €{{ number_format($producto->precio_ud, 2) }}</p>
                        <p><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                        <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                        <p><strong>Estado:</strong> {{ $producto->estado }}</p>
                        <p><strong>Tipo:</strong> {{ $producto->tipo }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('update-status-btn').addEventListener('click', function () {
            const orderId = {{ $order->id }};
            const updateStatusBtn = this;

            fetch(`/admin/orders/${orderId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: 'enviado' })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('order-status').innerText = 'enviado';
                        updateStatusBtn.innerText = 'Esperando al repartidor';
                        updateStatusBtn.classList.remove('btn-primary');
                        updateStatusBtn.classList.add('btn-secondary');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
