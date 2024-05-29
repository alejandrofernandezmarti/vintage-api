@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Pedidos</h2>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card text-center shadow-sm" style="background-color: brown">
                    <div class="card-body" style="color: white">
                        <h5 class="card-title">Nuevos Pedidos</h5>
                        <p class="card-text">Prepara los nuevos pedidos.</p>
                        <a href="{{ route('admin.orders.news') }}" class="btn" style="background-color: lightgray">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm" style="background-color: brown">
                    <div class="card-body" style="color: white">
                        <h5 class="card-title">Ver historial de pedidos</h5>
                        <p class="card-text">Ver el histórico de pedidos de la página.</p>
                        <a href="{{ route('admin.orders.history') }}" class="btn" style="background-color: lightgray">Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
