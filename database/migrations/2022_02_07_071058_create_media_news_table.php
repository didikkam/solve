<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaNewsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('media_news', function (Blueprint $table) {
         $table->id();
         $table->string('app_id', 200)->default('id.teknova.app.smkplus');
         $table->integer('category_id');
         $table->string('title', 200);
         $table->string('slug', 255);
         $table->longText('description');
         $table->text('image')->nullable();
         $table->enum('view_as', ['list', 'headline'])->default('list');
         $table->enum('status', ['draft', 'published'])->default('draft');
         $table->string('source_link', 255)->nullable();
         $table->integer('provider_id')->nullable();
         $table->timestamps();
         $table->softDeletes();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('media_news');
   }
}
