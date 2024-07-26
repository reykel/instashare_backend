<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'descripcion'=> $this->descripcion,
            'precio'=> $this->precio,
            'um'=> $this->um,
            'categoria_id'=> $this->categoria_id,
            'categoria_desc'=> $this->categorias->descripcion,
            'created_at'=> $this->created_at->toFormattedDateString()
        ];
    }
}