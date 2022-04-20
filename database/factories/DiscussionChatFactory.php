<?php

namespace Database\Factories;

use App\Domains\Auth\Models\User;
use App\Models\DiscussionThread;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionChatFactory extends Factory
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
         'thread_id' => DiscussionThread::select('id')->orderByRaw("RAND()")->first()->id,
         'description' => $this->faker->text,
         'status' => $status[rand(0, 2)],
         'created_by' => User::where('type', 'user')->select('id')->orderByRaw("RAND()")->first()->id,
      ];
   }
}
