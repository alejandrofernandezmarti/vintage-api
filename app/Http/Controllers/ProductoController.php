<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoResource;
use App\Models\Imagen;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\Talla;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return ProductoResource::collection($productos);
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:2',
            'id_marca' => 'required|exists:marcas,id',
            'id_categoria' => 'required|exists:categorias,id',
            'medidas.alto' => 'required|numeric',
            'medidas.ancho' => 'required|numeric',
            'medidas.manga' => 'required|numeric',
            'talla.etiqueta' => 'required|string',
            'talla.real' => 'required|string',
            'imagenes.url_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagenes.url_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagenes.url_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagenes.url_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagenes.url_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagenes.url_6' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $medida = Medida::create($validatedData['medidas']);

        // Crear una instancia de Talla y guardarla en la base de datos
        $talla = Talla::create($validatedData['talla']);

        $producto = new Producto();
        $producto->nombre = $validatedData['nombre'];
        $producto->precio = $validatedData['precio'];
        $producto->id_marca = $validatedData['id_marca'];
        $producto->id_categoria = $validatedData['id_categoria'];
        $producto->id_medida = $medida->id; // Asignar el ID de la medida creada al producto
        $producto->id_talla = $talla->id; // Asignar el ID de la talla creada al producto
        $producto->save();

        // Guardar imágenes
        $imagen = new Imagen();
        $imagen->url_1 = $validatedData['imagenes.url_1'];
        $imagen->url_2 = $validatedData['imagenes.url_2'];
        $imagen->url_3 = $validatedData['imagenes.url_3'];
        $imagen->url_4 = $validatedData['imagenes.url_4'];
        $imagen->url_5 = $validatedData['imagenes.url_5'];
        $imagen->url_6 = $validatedData['imagenes.url_6'];
        $imagen->producto_id = $producto->id; // Asociar la imagen con el producto recién creado
        $imagen->save();

        return response()->json(['message' => 'Producto creado exitosamente'], 201);
    }
}
