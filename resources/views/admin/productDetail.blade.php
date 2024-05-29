@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Detalle del Producto #{{ $producto->id }}</h2>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.productos.update', $producto->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}">
                    </div>

                    <div class="form-group">
                        <label for="precio_ud" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio_ud" name="precio_ud" value="{{ $producto->precio_ud }}">
                    </div>

                    <div class="form-group">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-control" id="tipo" name="tipo">
                            <option value="Box" {{ $producto->tipo == 'Box' ? 'selected' : '' }}>Box</option>
                            <option value="Selected" {{ $producto->tipo == 'Selected' ? 'selected' : '' }}>Selected</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $producto->cantidad }}">
                    </div>

                    <div class="form-group">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-control" id="categoria" name="categoria">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $producto->categoria->id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion">{{ $producto->descripcion }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado">
                            <option value="Grado A" {{ $producto->estado == 'Grado A' ? 'selected' : '' }}>Grado A</option>
                            <option value="Grado B" {{ $producto->estado == 'Grado B' ? 'selected' : '' }}>Grado B</option>
                            <option value="Calidad premium" {{ $producto->estado == 'Calidad premium' ? 'selected' : '' }}>Calidad premium</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="activo" class="form-label">Activo</label>
                        <select class="form-control" id="activo" name="activo">
                            <option value="1" {{ $producto->activo ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ !$producto->activo ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vendido" class="form-label">Vendido</label>
                        <select class="form-control" id="vendido" name="vendido">
                            <option value="1" {{ $producto->vendido ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ !$producto->vendido ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="imagenes" class="form-label">Imágenes</label>
                        <div class="row">
                            @for ($i = 1; $i <= 6; $i++)
                                <div class="col-md-4">
                                    <input type="file" class="form-control mb-2" id="url_{{ $i }}" name="imagenes[url_{{ $i }}]" accept="image/*" onchange="handleImageUpload(event, {{ $i }})">
                                    <img id="preview_url_{{ $i }}" src="{{ $imagenes["url_$i"] ?? '' }}" class="img-thumbnail" style="max-height: 150px;">
                                    <input type="hidden" id="base64_url_{{ $i }}" name="base64[url_{{ $i }}]" value="{{ $imagenes["url_$i"] }}">
                                </div>
                            @endfor
                        </div>
                    </div>

                    <input type="hidden" id="base64_images" name="base64_images">

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function handleImageUpload(event, index) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const base64Image = reader.result;
                document.getElementById('preview_url_' + index).src = base64Image;
                document.getElementById('base64_url_' + index).value = base64Image;
            };

            reader.readAsDataURL(file);
        }
    </script>
@endsection
