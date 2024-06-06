<!-- resources/views/auth/reset_password.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Restablecer Contraseña</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn w-100">Restablecer Contraseña</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        background-color: #f7f7f7;
        color: #333;
        font-family: 'Arial', sans-serif;
    }

    .container {
        padding: 20px;
    }

    .card {
        border: none;
        border-radius: 8px;
        background-color: #fff;
    }

    .card-body {
        padding: 30px;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        background-color: #f1f1f1;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .form-control:focus {
        border-color: #555;
        background-color: #fff;
    }

    .btn {
        background-color: #333;
        border-color: #333 !important;
        color: #fff;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 4px;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn:hover {
        background-color: #555;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .text-center {
        color: #333;
        font-weight: bold;
    }

    .card {
        border: 1px solid #e0e0e0;
        background-color: #fff;
        border-radius: 10px;
        transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
</style>
