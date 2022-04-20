<?php

namespace App\Domains\Announcement\Models;

use App\Domains\Announcement\Models\Traits\Scope\AnnouncementScope;
use Database\Factories\AnnouncementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Announcement.
 */
class Announcement extends Model
{
   use AnnouncementScope,
      HasFactory,
      SoftDeletes,
      LogsActivity;

   public const TYPE_FRONTEND = 'frontend';
   public const TYPE_BACKEND = 'backend';

   protected static $logFillable = true;
   protected static $logOnlyDirty = true;

   /**
    * @var string[]
    */
   protected $fillable = [
      'area',
      'type',
      'message',
      'enabled',
      'starts_at',
      'ends_at',
   ];

   /**
    * @var string[]
    */
   protected $dates = [
      'starts_at',
      'ends_at',
   ];

   /**
    * @var string[]
    */
   protected $casts = [
      'enabled' => 'boolean',
   ];

   /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
   protected static function newFactory()
   {
      return AnnouncementFactory::new();
   }
}
