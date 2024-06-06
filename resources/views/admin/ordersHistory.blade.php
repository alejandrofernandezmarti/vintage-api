@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Administrar Historial de Pedidos</h2>

        <!-- Barra de búsqueda única -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <form action="{{ route('admin.orders.history') }}" method="GET" class="row g-3">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por email, ciudad, teléfono o nombre" value="{{ request()->get('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center">
            @foreach($orders as $order)
                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pedido #{{ $order->id }}</h5>
                            <p class="card-text"><strong>Estado:</strong> {{ $order->estado }}</p>
                            <p class="card-text"><strong>Importe:</strong> €{{ number_format($order->importe, 2) }}</p>
                            <p class="card-text"><strong>Fecha:</strong> {{ date('d/m/Y', strtotime($order->fecha)) }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ $order->email }}</p>
                            <p class="card-text"><strong>Dirección:</strong> {{ $order->ciudad }}, {{ $order->provincia }}</p>
                            <a href="{{ route('admin.orderDetail', $order->id) }}" class="btn btn-primary mt-3">Ver Detalles</a>
                        </div>
                    </div>
                </div>
    @endforeach
@endsection
