<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      $arrayValues = ['draft', 'published'];
      return [
         'name' => $this->faker->sentence,
         'description' => $this->faker->text,
         'image' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'status' => $arrayValues[rand(0, 1)]
      ];
   }
}
