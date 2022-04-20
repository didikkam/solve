<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', [HomeController::class, 'index'])
   ->name('index')
   ->breadcrumbs(function (Trail $trail) {
      $trail->push(__('Home'), route('frontend.index'));
   });

Route::get('/privacy', [HomeController::class, 'privacy'])
   ->name('privacy')
   ->breadcrumbs(function (Trail $trail) {
      $trail->push(__('Home'), route('frontend.privacy'));
   });

Route::get('/term', [HomeController::class, 'term'])
   ->name('term')
   ->breadcrumbs(function (Trail $trail) {
      $trail->push(__('Home'), route('frontend.term'));
   });

Route::get('/faq', [HomeController::class, 'faq'])
   ->name('faq')
   ->breadcrumbs(function (Trail $trail) {
      $trail->push(__('Home'), route('frontend.faq'));
   });

Route::get('terms', [TermsController::class, 'index'])
   ->name('pages.terms')
   ->breadcrumbs(function (Trail $trail) {
      $trail->parent('frontend.index')
         ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
   });



// Route::get('/sendmail', [HomeController::class, 'sendmail'])
//    ->name('sendmail');

Route::get('/successEmail', [HomeController::class, 'successEmail'])
   ->name('successEmail');

Route::get('/failed', [HomeController::class, 'failed'])
   ->name('failed');

Route::get('/emailVerify', [AuthController::class, 'emailVerify'])
   ->name('emailVerify');

Route::get('/resetPasswordEmail', [AuthController::class, 'resetPasswordEmail'])
   ->name('resetPasswordEmail');
