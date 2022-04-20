<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use Illuminate\Database\Seeder;

class VacancyTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      for ($i = 0; $i < 50; $i++) {
         Vacancy::factory()->count(1)->create();
      }
   }
}
