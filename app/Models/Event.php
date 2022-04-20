<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
   use HasFactory, SoftDeletes;
   protected $fillable = [
      'category_id',
      'name',
      'image',
      'description',
      'location',
      'host',
      'certificate_link',
      'register_link',
      'slug',
      'date_from',
      'date_end',
      'published',
      'published_start',
      'published_end',
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
         return url('storage/' . $value);
      } else {
         return url('no-image.jpg');
      }
   }
}
