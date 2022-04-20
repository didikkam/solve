<?php

namespace Database\Factories;

use App\Models\Category;
use Faker\Provider\Youtube;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaVideoFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      $this->faker->addProvider(new Youtube($this->faker));
      $arrayValues = ['draft', 'published'];
      return [
         'category_id' => Category::where('scope', 'videos')->select('id')->orderByRaw("RAND()")->first()->id,
         'title' => $this->faker->sentence,
         'description' => $this->faker->text,
         'image' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'url_video' => $this->faker->youtubeUri(),
         'status' => $arrayValues[rand(0, 1)]
      ];
   }
}
