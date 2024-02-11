<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'id_compra' => $this->id_compra,
            'id_producto' => $this->id_producto,
            'id_cliente' => $this->id_cliente,
            'producto' => new ProductoResource($this->producto), // Suponiendo que existe una relación 'producto'
            'compra' => new CompraResource($this->compra), // Suponiendo que existe una relación 'compra'
            // Puedes incluir más campos o relaciones si es necesario
        ];
    }
}
