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
            margin-bottom: 20px;
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
        .btn-primary {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 50px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-primary:hover {
            background-color: #138496;
            box-shadow: 0 8px 15px rgba(23, 162, 184, 0.3);
        }
    </style>

    <div class="container">
        <h2 class="text-center mb-4">Listado de Productos</h2>
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">#{{ $producto->id }}  {{ $producto->nombre }}</h5>
                            <p class="card-text"><strong>Precio:</strong> €{{ number_format($producto->precio_ud, 2) }}</p>
                            <p class="card-text"><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                            <p class="card-text"><strong>Estado:</strong> {{ $producto->estado }}</p>
                            <p class="card-text"><strong>Tipo:</strong> {{ $producto->tipo }}</p>
                            <a href="{{ route('admin.productos.show', $producto->id) }}" class="btn btn-primary">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
