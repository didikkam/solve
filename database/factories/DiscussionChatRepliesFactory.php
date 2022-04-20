<?php

namespace Database\Factories;

use App\Domains\Auth\Models\User;
use App\Models\DiscussionChat;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionChatRepliesFactory extends Factory
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
         'chat_id' => DiscussionChat::select('id')->orderByRaw("RAND()")->first()->id,
         'description' => $this->faker->text,
         'status' => $status[rand(0, 2)],
         'created_by' => User::where('type', 'user')->select('id')->orderByRaw("RAND()")->first()->id,
      ];
   }
}
