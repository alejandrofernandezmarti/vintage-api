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
            'precio' => $this->precio,
            'marca' => $this->marca->nombre, // Suponiendo que existe una relación 'marca'
            'categoria' => $this->categoria->nombre, // Suponiendo que existe una relación 'categoria'
            'talla' => $this->talla->etiqueta, // Suponiendo que existe una relación 'talla'
            'medidas' => [
                'alto' => $this->medidas->alto,
                'ancho' => $this->medidas->ancho,
                'manga' => $this->medidas->manga,
            ], // Suponiendo que existe una relación 'medidas'
            'imagenes' => [
                'url_1' => $this->imagen->url_1,
                'url_2' => $this->imagen->url_2,
                'url_3' => $this->imagen->url_3,
                'url_4' => $this->imagen->url_4,
            ],
            'estado' => $this->estado,
            'activo' => $this->activo,
            'vendido' => $this->vendido,
            // Puedes agregar más campos aquí si lo deseas
        ];
    }
}
