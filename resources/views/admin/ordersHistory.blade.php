@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Administrar Historial de Pedidos</h2>
        <div class="row justify-content-center">
            @foreach($orders as $order)
                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pedido #{{ $order->id }}</h5>
                            <p class="card-text"><strong>Estado:</strong> {{ $order->estado }}</p>
                            <p class="card-text"><strong>Importe:</strong> €{{ number_format($order->importe, 2) }}</p>
                            <p class="card-text"><strong>Fecha:</strong> {{ $order->fecha }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ $order->email }}</p>
                            <p class="card-text"><strong>Dirección:</strong> {{ $order->ciudad }}, {{ $order->provincia }}</p>
                            <a href="{{ route('admin.orderDetail', $order->id) }}" class="btn btn-primary mt-3">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

