@extends('layouts.admin')

@section('content')
    <style>
        .form-group{
            margin-top: 20px;
        }
    </style>
    <div class="container">
        <h2>Crear Nuevo Producto</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-2">
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="nombre">Nombre del Producto:</label>
                        <input type="text" id="nombre" name="producto[nombre]" class="form-control" value="{{ old('producto.nombre') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcion" name="producto[descripcion]" class="form-control" value="{{ old('producto.descripcion') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="precio_ud">Precio:</label>
                        <input type="number" step="0.01" id="precio_ud" name="producto[precio_ud]" class="form-control" value="{{ old('producto.precio_ud') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" name="producto[tipo]" class="form-control" required onchange="toggleCantidadInput()">
                            <option value="">Seleccione un tipo</option>
                            <option value="Selected" {{ old('producto.tipo') == 'Selected' ? 'selected' : '' }}>Box / Selected</option>
                            <option value="Box" {{ old('producto.tipo') == 'Box' ? 'selected' : '' }}>Lote</option>
                        </select>
                    </div>
                    <div class="form-group" id="cantidad-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" id="cantidad" name="producto[cantidad]" class="form-control" value="{{ old('producto.cantidad') }}">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select id="estado" name="producto[estado]" class="form-control" required>
                            <option value="">Seleccione un estado</option>
                            <option value="Grado A" {{ old('producto.estado') == 'Grado A' ? 'selected' : '' }}>Grado A</option>
                            <option value="Grado B" {{ old('producto.estado') == 'Grado B' ? 'selected' : '' }}>Grado B</option>
                            <option value="Calidad premium" {{ old('producto.estado') == 'Calidad premium' ? 'selected' : '' }}>Calidad premium</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoría:</label>
                        <select id="categoria" name="producto[id_categoria]" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('producto.id_categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagenes" class="form-label">Imágenes</label>
                        <div class="row">
                            @for ($i = 1; $i <= 6; $i++)
                                <div class="col-md-4">
                                    <input type="file" class="form-control mb-2" id="url_{{ $i }}" name="imagenes[url_{{ $i }}]}" accept="image/*" onchange="handleImageUpload(event, {{ $i }})">
                                    <img id="preview_url_{{ $i }}" class="img-thumbnail" style="max-height: 150px;">
                                    <input type="hidden" id="base64_url_{{ $i }}" name="base64[url_{{ $i }}]">
                                </div>
                            @endfor
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
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

        function toggleCantidadInput() {
            const tipoSelect = document.getElementById('tipo');
            const cantidadGroup = document.getElementById('cantidad-group');
            const cantidadInput = document.getElementById('cantidad');

            if (tipoSelect.value === 'Box') {
                cantidadGroup.style.display = 'none';
                cantidadInput.value = 0;
            } else {
                cantidadGroup.style.display = 'block';
                cantidadInput.value = '';
            }
        }

        // Ejecutar al cargar la página para mantener el estado correcto del campo de cantidad
        document.addEventListener('DOMContentLoaded', function() {
            toggleCantidadInput();
        });
    </script>
@endsection
