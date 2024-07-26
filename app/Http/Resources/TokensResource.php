<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokensResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'=> $this->id,
            'client_id'=> $this->client_id,
            'user_id'=> $this->user_id,
            'created_at'=> $this->created_at->toFormattedDateString(),
            'updated_at'=> $this->updated_at->toFormattedDateString(),
            'expires_at'=> $this->expires_at->toFormattedDateString()
        ];
    }
}