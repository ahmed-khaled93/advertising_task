<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
          'id'          => $this->id,
          'user_id'     => $this->user_id,
          'category_id' => $this->category_id,
          'type_id'     => $this->type_id,
          'title'       => $this->title,
          'description' => $this->description,
          'start_date'  => $this->start_date,
        ];
    }
}
