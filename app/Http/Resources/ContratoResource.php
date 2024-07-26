<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContratoResource extends JsonResource
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
            'descripcion' => $this->descripcion,
            'fecha' => $this->fecha,
            'modalidad' => $this->modalidad,
            'importe' => $this->importe,
            'moneda' => $this->moneda,
            'empresa_id' => $this->empresa_id,
            'ejecutor_id' => $this->ejecutor_id,
            'created_at'=> $this->created_at->toFormattedDateString()
        ];
    }
}