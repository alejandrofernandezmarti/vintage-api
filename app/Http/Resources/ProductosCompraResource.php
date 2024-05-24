<?php

namespace App\Http\Resources;

use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductosCompraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $producto = Producto::find($this->id_producto);
        return [
            'id' => $this->id,
            'id_compra' => $this->id_compra,
            'id_producto' => $this->id_producto,
            'id_cliente' => $this->id_cliente,
            'cantidad' => $this->cantidad,
            'precio_ud'=> $this->precio_ud,
            'nombre'=> $producto->nombre,
            'estado'=> $producto->estado,
            'imagen' => $producto->imagen->url_1,
        ];
    }
}
