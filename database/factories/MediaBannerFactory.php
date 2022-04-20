<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaBannerFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      $starts_at = Carbon::createFromTimestamp($this->faker->dateTimeBetween($startDate = '0 days', $endDate = '0 days')->getTimeStamp());
      $ends_at = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addHours($this->faker->numberBetween(24, 50));
      $published = ['draft', 'published'];
      return [
         'category_id' => Category::where('scope', 'banner')->select('id')->orderByRaw("RAND()")->first()->id,
         'name' => $this->faker->sentence,
         'image' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'description' => $this->faker->text,
         'term_condition' => $this->faker->text,
         'published' => $published[rand(0, 1)],
         'published_start' => $starts_at,
         'published_end' => $ends_at,
      ];
   }
}
