<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompraResource extends JsonResource
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
            'fecha' => $this->fecha,
            'metodo_pago' => $this->metodo_pago,
            'direccion' => $this->direccion,
            'estado' => $this->estado,
            'email' => $this->email,
            'id_user' => $this->id_user,
            // Puedes agregar más campos aquí si lo deseas
        ];
    }
}
