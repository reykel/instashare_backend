<?php

namespace App\Http\Resources;
use App\Models\User;
use App\Models\Organization;

use Illuminate\Http\Resources\Json\JsonResource;

class AuditoriasResource extends JsonResource
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
            'user_type'=> $this->user_type,
            'user_id'=> User::firstWhere('id', $this->user_id) == null ? "Eliminado" : User::firstWhere('id', $this->user_id)->name,
            'event'=> strtoupper($this->event),
            'auditable'=> $this->auditable,
            'old_values'=> $this->old_values,
            'new_values'=> $this->new_values,
            'url'=> $this->url,
            'ip_address'=> $this->ip_address,
            'user_agent'=> $this->user_agent,
            'tags'=> $this->tags,
            'organization_id'=> Organization::firstWhere('id', $this->organization_id) == null ? "Eliminada" : Organization::firstWhere('id', $this->organization_id)->name,
            'created_at'=> $this->created_at->toDateTimeString()
        ];
    }
}