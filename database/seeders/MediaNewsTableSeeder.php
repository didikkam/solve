<?php

namespace Database\Seeders;

use App\Models\MediaNews;
use Illuminate\Database\Seeder;

class MediaNewsTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      for ($i = 0; $i < 50; $i++) {
         MediaNews::factory()->count(1)->create();
      }
   }
}
