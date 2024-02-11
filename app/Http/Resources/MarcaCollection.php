<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MarcaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($marca) {
                return [
                    'id' => $marca->id,
                    'nombre' => $marca->nombre,
                    // Agregar aquí más campos según sea necesario
                ];
            })
        ];
    }
}
