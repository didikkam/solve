<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
   /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
   public function toArray($request)
   {
      $data = [
         'id' => $this->user->id,
         'name' => $this->user->name,
         'email' => $this->user->email,
         'no_hp' => $this->user->no_hp,
         'major' => $this->major->name,
         'nim' => $this->nim,
         // 'type' => $this->type,
         'year_entry' => $this->year_entry,
         'year_out' => $this->year_out,
         'address' => $this->address,
         'location' => $this->location,
         'profile_image' => ($this->profile_image) ? url('storage/' . $this->profile_image) : "https://gravatar.com/avatar/2e7b5d42b3771a1f06b277608ce6673d?s=80&d=mp",
         'country' => $this->country->country_name,
      ];
      if (isset($this->province)) {
         $data['province'] = $this->province->name;
      }
      if (isset($this->city)) {
         $data['city'] = $this->city->name;
      }
      return $data;
   }
}
