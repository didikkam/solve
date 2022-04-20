<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
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
      $arrayValues = ['nominal', 'slot'];
      return [
         'category_id' => Category::where('scope', 'donation')->select('id')->orderByRaw("RAND()")->first()->id,
         'name' => $this->faker->sentence,
         'description' => $this->faker->text,
         'cover_image' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'img_1' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'img_2' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'img_3' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'img_4' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'img_5' => 'faker/' . $this->faker->image('public/storage/faker', 382, 225, null, false),
         'eva' => $this->faker->numerify('#############'),
         'type' => $arrayValues[rand(0, 1)],
         'slot_unit' => $this->faker->word,
         'slot_value' => $this->faker->numerify('########'),
         'credit' => $this->faker->numerify('########'),
         'debit' => $this->faker->numerify('########'),
         'balance' => $this->faker->numerify('########'),
         'balance_target' => $this->faker->numerify('########'),
         'active_from' => $starts_at,
         'active_until' => $ends_at,
      ];
   }
}
