<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
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
            'nombre' => $this->nombre,
            'precio_ud' => $this->precio_ud,
            'cantidad' => $this->cantidad,
            'categoria' => $this->categoria->nombre,
            'precio_env' => $this->categoria->precio_env,
            'descripcion' => $this->descripcion,
            'tipo' => $this->tipo,
            'imagenes' => [
                'url_1' => $this->imagen->url_1,
                'url_2' => $this->imagen->url_2,
                'url_3' => $this->imagen->url_3,
                'url_4' => $this->imagen->url_4,
                'url_5' => $this->imagen->url_5,
                'url_6' => $this->imagen->url_6,
            ],
            'estado' => $this->estado,
            'activo' => $this->activo,
            'vendido' => $this->vendido,
        ];
    }
}
