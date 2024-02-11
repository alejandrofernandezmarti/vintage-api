<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductosCompraResource;
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

    // Agregar un producto a una compra
    public function store(Request $request, $id_compra)
    {
        $productoCompra = new ProductoCompra();
        $productoCompra->id_compra = $id_compra;
        $productoCompra->id_producto = $request->input('id_producto');
        $productoCompra->id_cliente = $request->input('id_cliente');
        $productoCompra->save();

        return new ProductosCompraResource($productoCompra);
    }

    // Eliminar un producto de una compra
    public function destroy($id_compra, $id_producto)
    {
        $productoCompra = ProductoCompra::where('id_compra', $id_compra)
            ->where('id_producto', $id_producto)
            ->firstOrFail();
        $productoCompra->delete();

        return response()->json(null, 204);
    }
}
