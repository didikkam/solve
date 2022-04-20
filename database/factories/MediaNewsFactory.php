<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MediaNewsFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      $title = $this->faker->sentence;
      $slug = Str::slug($title);
      $view_as = ['list', 'headline'];
      $status = ['draft', 'published'];
      return [
         'category_id' => Category::where('scope', 'news')->select('id')->orderByRaw("RAND()")->first()->id,
         'title' => $title,
         'slug' => $slug,
         'description' => $this->faker->paragraph,
         'image' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'view_as' => $view_as[rand(0, 1)],
         'status' => $status[rand(0, 1)],
      ];
   }
}
