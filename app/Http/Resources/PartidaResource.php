<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartidaResource extends JsonResource
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
            'cantidad'=> $this->cantidad,
            'precio'=> $this->precio,
            'importe'=> $this->importe,
            'producto_id'=> $this->producto_id,
            //'factura_id'=> $this->factura_id,
            'oferta_id'=> $this->oferta_id,
            'producto'=> $this->productos->descripcion,
            'created_at'=> $this->created_at->toFormattedDateString()
        ];
    }
}