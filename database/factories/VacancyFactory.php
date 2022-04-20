<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VacancyFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      $title = $this->faker->jobTitle();
      $slug = Str::slug($title);
      $starts_at = Carbon::createFromTimestamp($this->faker->dateTimeBetween($startDate = '0 days', $endDate = '0 days')->getTimeStamp());
      $ends_at = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addHours($this->faker->numberBetween(24, 50));
      $type = ['full-time', 'part-time'];
      $published = ['draft', 'published'];
      return [
         'category_id' => Category::where('scope', 'vacancy')->select('id')->orderByRaw("RAND()")->first()->id,
         'name' => $title,
         'slug' => $slug,
         'image' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         // 'position' => $this->faker->latitude() . ',' . $this->faker->longitude(),
         'position' => $this->faker->sentence,
         'type' => $type[rand(0, 1)],
         'description' => $this->faker->text,
         'address' => $this->faker->address,
         'company' => $this->faker->company,
         'published' => $published[rand(0, 1)],
         'published_start' => $starts_at,
         'published_end' => $ends_at,
      ];
   }
}
