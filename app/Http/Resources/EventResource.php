<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
         'host' => $this->host,
         'location' => $this->location,
         'date' => date('Y-m-d', strtotime($this->published_start)),
         'date_from' => date('Y-m-d', strtotime($this->date_from)),
         'date_end' => date('Y-m-d', strtotime($this->date_end)),
         'register_link' => $this->register_link,
         'certificate_link' => $this->certificate_link,
         'source_link' => $this->source_link,
         'image' => $this->image,
         'description' => $this->description,
      ];
   }
}
