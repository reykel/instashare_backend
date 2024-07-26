<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfertaResource extends JsonResource
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
            'account_responsable'=> $this->account_responsable,
            'empresa_id'=> $this->empresa_id,
            'empresa_desc'=> $this->empresas->nombre,
            'partner'=> $this->empresas->partner,


            'contact_person'=> $this->ejecutores->contact_person,
            'short_contact_person'=> $this->ejecutores->short_contact_person,
            'personal_category'=> $this->ejecutores->personal_category,
            'position'=> $this->ejecutores->position,
            'language'=> $this->ejecutores->language,
            'mail'=> $this->ejecutores->mail,
            'phone'=> $this->ejecutores->phone,
            'prefix'=> $this->ejecutores->prefix,
            'code_prefix'=> $this->ejecutores->paises->prefijo,



            'ejecutor_id'=> $this->ejecutor_id,
            'ejecutor_desc'=> $this->ejecutores->name,

            'client_code'=> $this->empresas->client_code,
            'address'=> $this->empresas->address,
            'population'=> $this->empresas->population,
            'province'=> $this->empresas->province,
            'CP'=> $this->empresas->CP,
            'NIF'=> $this->empresas->NIF,
            'web'=> $this->empresas->web,
            'skipe'=> $this->empresas->skipe,
            'land_line'=> $this->empresas->land_line,
            'email_body'=> $this->empresas->email_body,
            
            'cert_eidas'=> $this->cert_eidas == "1" ? true : false,
            'cert_ens'=> $this->cert_ens == "1" ? true : false,
            'cert_27001'=> $this->cert_27001 == "1" ? true : false,
            'cert_9001'=> $this->cert_9001 == "1" ? true : false,
            'cert_17024'=> $this->cert_17024 == "1" ? true : false,
            'cert_14001'=> $this->cert_14001 == "1" ? true : false,
            'cert_grattil'=> $this->cert_grattil == "1" ? true : false,
            'cert_ovp'=> $this->cert_ovp == "1" ? true : false,
            'cert_anfac'=> $this->cert_anfac == "1" ? true : false,
            'cert_nda'=> $this->cert_nda == "1" ? true : false,
            
            //'anual'=> $this->anual,    
            'dead_line'=> substr($this->dead_line,0,10),
            'responsable_comments'=> $this->responsable_comments,
            'purchase_conditions'=> $this->purchase_conditions,
            'desde'=> $this->ejecutores->desde,
            'hasta'=> $this->ejecutores->hasta,

            'open'=> $this->open,   
            'active'=> $this->active,
            'enviada'=> $this->enviada,   




            'created_at'=> $this->created_at->toFormattedDateString()
        ];
    }
}