<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserData extends Model
{
   use HasFactory, SoftDeletes;
   protected $hidden = [
      'created_at',
      'updated_at',
      'deleted_at',
   ];
   protected $fillable = [
      'users_id',
      'majors_id',
      'year_entry',
      'year_out',
      'nim',
      'address',
      'country_id',
      'province_id',
      'city_id',
      'location',
      'profile_image'
   ];

   public function user()
   {
      return $this->hasOne(User::class, 'id', 'users_id');
   }

   public function major()
   {
      return $this->belongsTo(Major::class, 'majors_id', 'id');
   }

   public function country()
   {
      return $this->belongsTo(GeoCountry::class, 'country_id', 'id');
   }

   public function province()
   {
      return $this->belongsTo(GeoProvince::class, 'province_id', 'id');
   }

   public function city()
   {
      return $this->belongsTo(GeoCity::class, 'city_id', 'id');
   }

   public function user_eva()
   {
      return $this->belongsTo(UserEva::class, 'users_id', 'account_user');
   }

   // public function getProfileImageUrlAttribute($value)
   // {
   //    if ($value) {
   //       return url('storage/' . $value);
   //    } else {
   //       return "https://gravatar.com/avatar/2e7b5d42b3771a1f06b277608ce6673d?s=80&d=mp";
   //    }
   // }
}
