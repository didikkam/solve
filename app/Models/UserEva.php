<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEva extends Model
{
   use HasFactory, SoftDeletes;
   protected $table = 'user_eva';
   protected $hidden = [
      'app_id',
      'account_pin',
      'created_at',
      'updated_at',
      'deleted_at',
   ];
   protected $fillable = [
      'account_no',
      'account_user',
      'account_holder',
      'account_pin',
      'balance',
   ];
}
