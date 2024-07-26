<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListNotificationResource extends JsonResource
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
            'description'=> $this->description,
            'level'=> $this->level,
            'scope'=> $this->scope,
            'type'=> $this->type,
            'title'=> $this->title,
            'viewed'=> $this->viewed,
            'direction'=> $this->direction,
            'created_at'=> $this->created_at == null ? null : $this->created_at->toFormattedDateString(),
            'notification_id'=> $this->notification_id,
            'user_id'=> $this->user_id
        ];
    }
}
/*
"id": 49,
"description": "The user TenatPFRVGG was registered.",
"scope": "1",
"level": "1",
"viewed": "",
"direction": "",
"type": "user",
"title": "New user registered",
"created_at": "2022-11-03T20:43:10.000000Z",
"updated_at": null,
"notification_id": 43,
"user_id": 1
*/