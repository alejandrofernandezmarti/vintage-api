<!-- resources/views/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Producto</h1>
        <form method="POST" action="{{ route('productos.store') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" required>
            </div>
            <!-- Agregar más campos según tus necesidades -->
            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </form>
    </div>
@endsection
