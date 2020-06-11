<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image_url' => $this->image_url,
            'keyword' => $this->keyword,
            'type' => ucfirst($this->type),
            'created_by' => $this->user->name,
            'is_send_notification' => $this->is_send_notification
        ];
    }
}
