<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EjecutorResource extends JsonResource
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
            'id' => $this->id,
            'name'=> $this->name,
            'contact_person'=> $this->contact_person,
            'short_contact_person'=> $this->short_contact_person,
            'personal_category'=> $this->personal_category,
            'position'=> $this->position,
            'language'=> $this->language,
            'mail'=> $this->mail,
            'phone'=> $this->phone,
            'prefix'=> $this->prefix,
            'code_prefix'=> $this->paises->prefijo,
            'desde'=> $this->desde,
            'hasta'=> $this->hasta,
            'created_at'=> $this->created_at->toFormattedDateString()
        ];
    }
}