<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductoDetail;
use App\Http\Resources\ProductoResource;
use App\Models\Categoria;
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
        $request->validate([
            'producto.nombre' => 'required|string|max:255',
            'producto.descripcion' => 'required|string|max:255',
            'producto.precio_ud' => 'required|numeric',
            'producto.id_categoria' => 'required|integer|exists:categorias,id',
            'producto.tipo' => 'required|string',
            'producto.cantidad' => 'nullable|integer',
            'producto.estado' => 'required|string|max:255',
            'base64.url_1' => 'nullable|string',
            'base64.url_2' => 'nullable|string',
            'base64.url_3' => 'nullable|string',
            'base64.url_4' => 'nullable|string',
            'base64.url_5' => 'nullable|string',
            'base64.url_6' => 'nullable|string',
        ]);

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
        $imagen->url_1 = $request['base64.url_1'];
        $imagen->url_2 = $request['base64.url_2'];
        $imagen->url_3 = $request['base64.url_3'];
        $imagen->url_4 = $request['base64.url_4'];
        $imagen->url_5 = $request['base64.url_5'];
        $imagen->url_6 = $request['base64.url_6'];
        $imagen->producto_id = $producto->id;
        $imagen->save();

        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado exitosamente.');
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.createProduct', compact('categorias'));
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
    public function showAdmin($id)
    {
        $producto = new ProductoDetail(Producto::findOrFail($id));
        $categorias = Categoria::all();
        $imagenes = ImagenProducto::where('producto_id', $id)->firstOrFail();
        return view('admin.productDetail', compact('producto','categorias','imagenes'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->input('nombre');
        $producto->precio_ud = $request->input('precio_ud');
        $producto->cantidad = $request->input('cantidad');
        $producto->id_categoria = $request->input('categoria');
        $producto->descripcion = $request->input('descripcion');
        $producto->tipo = $request->input('tipo');
        $producto->estado = $request->input('estado');
        $producto->activo = $request->input('activo');
        $producto->vendido = $request->input('vendido');
        $producto->update();

        $imagen = ImagenProducto::where('producto_id',$id)->firstOrFail();
        $imagen->url_1 = $request->input('base64.url_1');
        $imagen->url_2 = $request->input('base64.url_2');
        $imagen->url_3 = $request->input('base64.url_3');
        $imagen->url_4 = $request->input('base64.url_4');
        $imagen->url_5 = $request->input('base64.url_5');
        $imagen->url_6 = $request->input('base64.url_6');
        $imagen->update();

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(null, 204);
    }
}
