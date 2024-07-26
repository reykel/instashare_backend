<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
            'nombre'=> $this->nombre,
            'organismo'=> $this->organismo,
            'partner'=> $this->partner,
            'account_responsable'=> $this->account_responsable,
            'client_code'=> $this->client_code,
            'contact_person'=> $this->contact_person,
            'short_contact_person'=> $this->short_contact_person,
            'personal_category'=> $this->personal_category,
            'position'=> $this->position,
            'language'=> $this->language,
            'mail'=> $this->mail,
            'phone'=> $this->phone,
            //'offerer_enterprise'=> $this->offerer_enterprise,
            'address'=> $this->address,
            'population'=> $this->population,
            'province'=> $this->province,
            'CP'=> $this->CP,
            'NIF'=> $this->NIF,
            'web'=> $this->web,
            'skipe'=> $this->skipe,
            'land_line'=> $this->land_line,
            'prefix'=> $this->prefix,
            'email_body'=> $this->email_body,


            'created_at'=> $this->created_at->toFormattedDateString()
        ];
    }
}