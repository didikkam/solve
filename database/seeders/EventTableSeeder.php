<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      for ($i = 0; $i < 50; $i++) {
         Event::factory()->count(1)->create();
      }
   }
}
