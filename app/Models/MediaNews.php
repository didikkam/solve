<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaNews extends Model
{
   use HasFactory, SoftDeletes;
   protected $fillable = [
      'category_id',
      'title',
      'slug',
      'description',
      'image',
      'view_as',
      'status',
      'source_link',
      'provider_id',
   ];

   public function categories()
   {
      return $this->hasOne(Category::class, 'id', 'category_id');
   }

   public function provider()
   {
      return $this->hasOne(Provider::class, 'id', 'provider_id');
   }

   public function getImageAttribute($value)
   {
      if ($value) {
         $http = substr($value, 0, 4);
         if ($http == "http") {
            $value = str_replace("http://news.unair.ac.id", url(''), $value);
            return $value;
         } else {
            return url('storage/' . $value);
         }
      } else {
         return url('no-image.jpg');
      }
   }
}
