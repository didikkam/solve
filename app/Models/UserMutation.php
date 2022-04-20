<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMutation extends Model
{
   use HasFactory, SoftDeletes;
   protected $hidden = [
      'app_id',
      'created_at',
      'updated_at',
      'deleted_at',
   ];
   protected $fillable = [
      'trx_code',
      'trx_serialization',
      'trx_type',
      'trx_remarks',
      'account_institution',
      'account_no',
      'starting_balance',
      'credit',
      'debit',
      'ending_balance'
   ];
}
