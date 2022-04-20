<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserToken extends Model
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
      'name',
      'token',
   ];
}
