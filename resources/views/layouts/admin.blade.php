<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f2f2f2;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background: #333;
            color: #282828;
        }
        .navbar-nav .nav-link {
            color: #232323;
            font-weight: bold;
        }
        .navbar-nav .nav-link:hover {
            color: #ccc;
        }
        .container {
            margin-top: 50px;
        }
        .card-2{
            border: none;
            border-radius: 15px;
            background: #fff;
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            background: #fff;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 30px;
        }
        .card-title {
            color: #333;
            font-size: 1.6rem;
            margin-bottom: 15px;
        }
        .card-text {
            color: #555;
            font-size: 1rem;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #333;
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 30px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #555;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
        }
        .text-center {
            color: #333;
            font-weight: bold;
        }
        .shadow-custom {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.productos.index') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orders.index') }}">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.create') }}">New product</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

