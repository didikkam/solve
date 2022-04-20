<?php

use App\Http\Controllers\Backend\AnnouncementController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TimesheetController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RecapController;
use Illuminate\Http\Request;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
   ->name('dashboard')
   ->breadcrumbs(function (Trail $trail) {
      $trail->push(__('Dashboard'), route('admin.dashboard'));
   });

Route::group([
   'prefix' => 'timesheet',
   'as' => 'timesheet.',
], function () {
   Route::get('/', [TimesheetController::class, 'index'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
         $trail->parent('admin.dashboard')
            ->push(__('Time Sheet'), route('admin.timesheet.index'));
      });
   Route::get('create', [TimesheetController::class, 'create'])
      ->name('create')
      ->breadcrumbs(function (Trail $trail) {
         $trail->parent('admin.timesheet.index')
            ->push(__('Tambah Time Sheet'), route('admin.timesheet.create'));
      });
   Route::get('{id}/edit', [TimesheetController::class, 'edit'])
      ->name('edit')
      ->breadcrumbs(function (Trail $trail) {
         $trail->parent('admin.timesheet.index')
            ->push(__('Edit Time Sheet'));
      });
   Route::post('store', [TimesheetController::class, 'store'])
      ->name('store');
   Route::delete('{id}/destroy', [TimesheetController::class, 'destroy'])
      ->name('destroy');
});
Route::group([
   'prefix' => 'recap',
   'as' => 'recap.',
], function () {
   Route::get('/', [RecapController::class, 'index'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
         $trail->parent('admin.dashboard')
            ->push(__('Recap'), route('admin.recap.index'));
      });
   Route::get('create', [RecapController::class, 'create'])
      ->name('create')
      ->breadcrumbs(function (Trail $trail) {
         $trail->parent('admin.recap.index')
            ->push(__('Tambah Recap'), route('admin.recap.create'));
      });
   Route::get('{id}/edit', [RecapController::class, 'edit'])
      ->name('edit')
      ->breadcrumbs(function (Trail $trail) {
         $trail->parent('admin.recap.index')
            ->push(__('Edit Recap'));
      });
   Route::post('store', [RecapController::class, 'store'])
      ->name('store');
   Route::delete('{id}/destroy', [RecapController::class, 'destroy'])
      ->name('destroy');
});
