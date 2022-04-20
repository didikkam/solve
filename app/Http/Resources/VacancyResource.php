<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
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
         'title' => $this->name,
         'company' => $this->company,
         'position' => $this->position,
         'type' => $this->type,
         'address' => $this->address,
         'date' => date('Y-m-d', strtotime($this->published_start)),
         'thumbnail_image' => $this->image,
         'source_link' => $this->source_link,
         // 'description' => $this->description,
         'content' => $this->description,
      ];
   }
}
