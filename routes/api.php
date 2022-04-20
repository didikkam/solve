<?php

use App\Http\Controllers\Backend\AnnouncementController;
use App\Http\Controllers\Backend\API\ChatController;
use App\Http\Controllers\Backend\API\DiscussionChatController;
use App\Http\Controllers\Backend\API\DiscussionChatRepliesController;
use App\Http\Controllers\Backend\API\DiscussionThreadController;
use App\Http\Controllers\Backend\API\GeoController;
use App\Http\Controllers\Backend\API\MajorController;
use App\Http\Controllers\Backend\API\PaymentController;
use App\Http\Controllers\Backend\API\UserSavingController;
use App\Http\Controllers\Backend\API\XenditController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DiscussionController;
use App\Http\Controllers\Backend\DonationController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\MediaBannerController;
use App\Http\Controllers\Backend\MediaNewsController;
use App\Http\Controllers\Backend\MediaVideoController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\ProviderController;
use App\Http\Controllers\Backend\VacancyController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('isApi')->group(function () {
   Route::post('register', [AuthController::class, 'register']);
   Route::post('login', [AuthController::class, 'login']);

   Route::group([
      'prefix' => 'media_news',
      'as' => 'media_news.',
   ], function () {
      Route::get('/', [MediaNewsController::class, 'list'])
         // ->middleware('permission:user.access.media_news.list')
         ->name('list');
   });

   Route::group([
      'prefix' => 'events',
      'as' => 'events.',
   ], function () {
      Route::get('/', [EventController::class, 'ApiEvents'])
         // ->middleware('permission:user.access.events.list')
         ->name('list');
   });

   Route::group([
      'prefix' => 'vacancy',
      'as' => 'vacancy.',
   ], function () {
      Route::get('/internship', [VacancyController::class, 'ApiInternship'])
         // ->middleware('permission:user.access.vacancy.internship')
         ->name('internship');
      Route::get('/job', [VacancyController::class, 'ApiJob'])
         // ->middleware('permission:user.access.vacancy.job')
         ->name('job');
   });

   Route::group([
      'prefix' => 'provider',
      'as' => 'provider.',
   ], function () {
      Route::get('/', [ProviderController::class, 'list'])
         ->name('list');
   });

   Route::post('/resetPassword', [AuthController::class, 'resetPassword'])
      ->name('resetPassword');

   Route::middleware('auth:sanctum')->group(function () {
      Route::post('logout', [AuthController::class, 'logout']);

      Route::group([
         'prefix' => 'user',
         'as' => 'user.',
      ], function () {
         Route::get('/', [AuthController::class, 'user'])
            ->middleware('permission:user.access.user.list')
            ->name('user');
         Route::post('/changePassword', [AuthController::class, 'changePassword'])
            ->middleware('permission:user.access.user.changePassword')
            ->name('changePassword');
         Route::post('/changeProfile', [AuthController::class, 'changeProfile'])
            ->middleware('permission:user.access.user.changeProfile')
            ->name('changeProfile');

         Route::post('/sendMail', [AuthController::class, 'sendMail'])
            ->name('sendMail');
      });
   }); // end auth:sanctum
});
