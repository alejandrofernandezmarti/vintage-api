<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductoDetail;
use App\Http\Resources\ProductoResource;
use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(16);
        return ProductoResource::collection($productos);
    }
    public function indexLotes()
    {
        $productos = Producto::where('tipo', 'Box')->paginate(16);
        return ProductoResource::collection($productos);
    }
    public function indexSelected()
    {
        $productos = Producto::where('tipo', 'Selected')->where('vendido', false)->get();
        return ProductoResource::collection($productos);
    }


    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return new ProductoDetail($producto);
    }

    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request['producto.nombre'];
        $producto->descripcion = $request['producto.descripcion'];
        $producto->precio_ud = $request['producto.precio_ud'];
        $producto->id_categoria = $request['producto.id_categoria'];
        $producto->tipo = $request['producto.tipo'];
        $producto->cantidad = $request['producto.cantidad'];
        $producto->activo = '1';
        $producto->vendido = '0';
        $producto->estado = $request['producto.estado'];
        $producto->save();

        $imagen = new ImagenProducto();
        $imagen->url_1 = $request['imagenes.url_1'];
        $imagen->url_2 = $request['imagenes.url_2'];
        $imagen->url_3 = $request['imagenes.url_3'];
        $imagen->url_4 = $request['imagenes.url_4'];
        $imagen->url_5 = $request['imagenes.url_5'];
        $imagen->url_6 = $request['imagenes.url_6'];
        $imagen->producto_id = $producto->id;
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
        if (!empty($marcasSeleccionadas)) {
            $query->whereIn('id_marca', array_keys($marcasSeleccionadas));
        }
        $productos = $query->get();
        return ProductoResource::collection($productos);
    }

    public function obtenerProductosAleatorios()
    {
        $productos = Producto::inRandomOrder()->limit(8)->get();
        return ProductoResource::collection($productos);
    }


    public function productosPorCategoria($idCategoria)
    {
        $productos = Producto::where('id_categoria', $idCategoria)->where('tipo', 'Box')->get();
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
