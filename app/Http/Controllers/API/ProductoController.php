<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return new ProductoResource($producto);
    }

    public function store(Request $request)
    {


        $medida = Medida::create($request['medidas']);


        // Crear una instancia de Talla y guardarla en la base de datos
        $talla = Talla::create($request['talla']);

        $producto = new Producto();
        $producto->nombre = $request['producto.nombre'];
        $producto->precio = $request['producto.precio'];
        $producto->id_marca = $request['producto.id_marca'];
        $producto->id_categoria = $request['producto.id_categoria'];
        $producto->id_medidas = $medida->id; // Asignar el ID de la medida creada al producto
        $producto->id_talla = $talla->id; // Asignar el ID de la talla creada al producto
        $producto->activo = '1';
        $producto->vendido = '0';
        $producto->estado = 'nuevo';
        $producto->save();

        // Guardar imágenes
        $imagen = new Imagen();
        $imagen->url_1 = $request['imagenes.url_1'];
        $imagen->url_2 = $request['imagenes.url_2'];
        $imagen->url_3 = $request['imagenes.url_3'];
        $imagen->url_4 = $request['imagenes.url_4'];
        $imagen->url_5 = $request['imagenes.url_5'];
        $imagen->url_6 = $request['imagenes.url_6'];
        $imagen->producto_id = $producto->id; // Asociar la imagen con el producto recién creado
        $imagen->save();

        return response()->json(['message' => 'Producto creado exitosamente'], 201);
    }

    public function filtrar(Request $request)
    {
        $categoriasSeleccionadas = $request->categorias ?: [];
        $marcasSeleccionadas = $request->marcas ?: [];

        $query = Producto::query();


      if (!empty($categoriasSeleccionadas)) {
            $query->whereIn('id_categoria',array_keys($categoriasSeleccionadas));
        }

        // Filtrar por marcas seleccionadas
        if (!empty($marcasSeleccionadas)) {
            $query->whereIn('id_marca', array_keys($marcasSeleccionadas));
        }

        // Obtener los productos filtrados
        $productos = $query->get();

        // Retornar los productos a la vista correspondiente
        return ProductoResource::collection($productos);
    }

    public function obtenerProductosAleatorios()
    {
        $productos = Producto::inRandomOrder()->limit(8)->get();
        return ProductoResource::collection($productos);
    }


    public function productosPorCategoria($idCategoria)
    {
        $productos = Producto::where('id_categoria', $idCategoria)->get();

        return ProductoResource::collection($productos);
    }
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return new ProductoResource($producto);
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(null, 204);
    }
}
