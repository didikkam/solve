<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSaving extends Model
{
   use HasFactory, SoftDeletes;
   protected $hidden = [
      'app_id',
      'created_at',
      'updated_at',
      'deleted_at',
   ];
   protected $fillable = [
      'user_id',
      'user_fullname',
      'user_nickname',
      'icon_savings',
      'code_savings',
      'name_savings',
      'no_savings',
      'balance_savings',
      'status_savings',
      'validity_savings',
      'qr_savings'
   ];

   public function getIconSavingsAttribute($value)
   {
      if ($value) {
         return url($value);
      } else {
         return url('no-image.jpg');
      }
   }
}
