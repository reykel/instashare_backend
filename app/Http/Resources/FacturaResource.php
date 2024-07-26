<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacturaResource extends JsonResource
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
            'concepto'=> $this->concepto,
            'no_factura'=> $this->no_factura,
            'no_solicitud'=> $this->no_solicitud,
            'estado'=> $this->estado,
            'moneda'=> $this->moneda,
            'importe'=> $this->importe,
            'fecha'=> $this->fecha,
            'observaciones'=> $this->observaciones,
            'importe_texto'=> $this->importe_texto,
            'contrato_id'=> $this->contrato_id,
            'created_at'=> $this->created_at->toFormattedDateString()
        ];
    }
}