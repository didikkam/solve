<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaNewsResource extends JsonResource
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
         'title' => $this->title,
         'date' => date('Y-m-d H:i', strtotime($this->created_at)),
         'image' => $this->image,
         'source_link' => $this->source_link,
         // 'description' => $this->description,
         'content' => $this->description,
         'category' => $this->categories->slug,
      ];
   }
}
