<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timesheet extends Model
{
   use HasFactory, SoftDeletes;
   protected $fillable = [
      'date',
      'client_id',
      'kode_pek',
      'jenis_penugasan',
      'tahun',
      'kode_akun',
      'akun',
   ];

   public function client()
   {
      return $this->hasOne(Client::class, 'id', 'client_id');
   }
}
