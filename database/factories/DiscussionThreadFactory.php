<?php

namespace Database\Factories;

use App\Domains\Auth\Models\User;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionThreadFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      $status = ['published', 'draft', 'block'];
      return [
         'discussion_id' => Discussion::select('id')->orderByRaw("RAND()")->first()->id,
         'description' => $this->faker->text,
         'image' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'status' => $status[rand(0, 2)],
         'created_by' => User::where('type', 'user')->select('id')->orderByRaw("RAND()")->first()->id,
      ];
   }
}
