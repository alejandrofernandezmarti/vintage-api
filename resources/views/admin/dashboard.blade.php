@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Dashboard</h2>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-custom">
                    <div class="card-body">
                        <h5 class="card-title">Crear Productos</h5>
                        <p class="card-text">Sube nuevos productos a la tienda.</p>
                        <a href="{{ route('products.create') }}" class="btn btn-custom">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-custom">
                    <div class="card-body">
                        <h5 class="card-title">Administrar Productos</h5>
                        <p class="card-text">Gestiona los productos actuales.</p>
                        <a href="{{ route('admin.productos.index') }}" class="btn btn-custom">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-custom">
                    <div class="card-body">
                        <h5 class="card-title">Administrar Pedidos</h5>
                        <p class="card-text">Gestiona los pedidos recibidos.</p>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-custom">Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
