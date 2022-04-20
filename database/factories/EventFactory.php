<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
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
      $starts_at = Carbon::createFromTimestamp($this->faker->dateTimeBetween($startDate = '0 days', $endDate = '0 days')->getTimeStamp());
      $ends_at = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addHours($this->faker->numberBetween(24, 50));
      $published_start = Carbon::createFromTimestamp($this->faker->dateTimeBetween($startDate = '+2 days', $endDate = '+1 week')->getTimeStamp());
      $published_end = Carbon::createFromFormat('Y-m-d H:i:s', $published_start)->addHours($this->faker->numberBetween(24, 50));
      $arrayValues = ['draft', 'published'];
      return [
         'category_id' => Category::where('scope', 'event')->select('id')->orderByRaw("RAND()")->first()->id,
         'name' => $title,
         'slug' => $slug,
         'image' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'description' => $this->faker->paragraph,
         'location' => $this->faker->address,
         'host' => $this->faker->sentence,
         'date_from' => $starts_at,
         'date_end' => $ends_at,
         'published' => $arrayValues[rand(0, 1)],
         'published_start' => $starts_at,
         'published_end' => $ends_at,
      ];
   }
}
