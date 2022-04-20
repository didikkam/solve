<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
   use HasFactory, SoftDeletes;
   protected $fillable = [
      'name',
      'code',
   ];
   protected $hidden = [
      'created_at',
      'updated_at',
      'deleted_at',
   ];
}
