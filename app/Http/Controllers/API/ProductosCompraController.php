<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductoResource;
use App\Http\Resources\ProductosCompraResource;
use App\Models\Producto;
use App\Models\ProductoCompra;
use Illuminate\Http\Request;

class ProductosCompraController extends Controller
{
    public function index($id_compra)
    {
        $productosCompra = ProductoCompra::where('id_compra', $id_compra)->get();
        return ProductosCompraResource::collection($productosCompra);
    }

    // Mostrar un producto de una compra específica
    public function show($id_compra, $id_producto)
    {
        $productoCompra = ProductoCompra::where('id_compra', $id_compra)
            ->where('id_producto', $id_producto)
            ->firstOrFail();
        return new ProductosCompraResource($productoCompra);
    }

    public function getCarrito(Request $request)
    {
        $productIds = $request->input('products');
        $carrito = [];

        foreach ($productIds as $productId) {
            $product = Producto::find($productId['id']);

            if ($product) {
                if (($product->tipo === 'Selected' && !$product->vendido && $product->activo) || ($product->tipo === 'Box' && $product->activo)) {
                    if ($product->nombre === $productId['nombre']){
                        $carrito[] = [
                            'id' => $product->id,
                            'nombre' => $product->nombre,
                            'precio_ud' => $productId['precio_ud'],
                            'precio_env' => $product->categoria->precio_env,
                            'cantidad' => $productId['cantidad'],
                            'tipo' => $product->tipo,
                            'imagenes' => [
                                'url_1' => $product->imagen->url_1
                            ]
                        ];
                    }

                }
            }
        }

        return response()->json(['carrito' => $carrito]);
    }


    public function store(Request $request, $id_compra)
    {
        $productoCompra = new ProductoCompra();
        $productoCompra->id_compra = $id_compra;
        $productoCompra->id_producto = $request->input('id_producto');
        $productoCompra->id_cliente = $request->input('id_cliente');
        $productoCompra->save();

        return new ProductosCompraResource($productoCompra);
    }

    public function destroy($id_compra, $id_producto)
    {
        $productoCompra = ProductoCompra::where('id_compra', $id_compra)
            ->where('id_producto', $id_producto)
            ->firstOrFail();
        $productoCompra->delete();

        return response()->json(null, 204);
    }
}
