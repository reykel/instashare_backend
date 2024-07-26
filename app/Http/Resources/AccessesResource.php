<?php

namespace App\Http\Resources;
use App\Models\User;
use App\Models\Organization;

use Illuminate\Http\Resources\Json\JsonResource;

class AccessesResource extends JsonResource
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
            'user_id'=> User::firstWhere('id', $this->user_id) == null ? "Eliminado" : User::firstWhere('id', $this->user_id)->name,
            'action'=> $this->action,
            //'succeded'=> $this->succeded == "-1" ? true : false,
            'succeded'=> $this->succeded,
            'ip_address'=> $this->ip_address,
            'user_agent'=> $this->user_agent,
            'organization_id'=> Organization::firstWhere('id', $this->organization_id) == null ? "Eliminada" : Organization::firstWhere('id', $this->organization_id)->name,
            'created_at'=> $this->created_at->toDateTimeString(),
            'updated_at'=> $this->updated_at->toFormattedDateString()
        ];
    }
}