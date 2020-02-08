<?php

use App\Http\Controllers\CmsPageController;
use App\Http\Controllers\CmsImageController;
use App\Http\Controllers\CmsPersonController;
use App\Http\Controllers\CalendarController;

Route::group([
	'prefix' => 'cms',
	'as' => 'cms.',
	'namespace' => 'Cms',  
	], function () {
    Route::group(['namespace' => 'Support', 'middleware' => 'permission:cms soporte'], function () {
        Route::get('support', [CmsPageController::class, 'index'])->name('support.index');
        Route::post('support', [CmsPageController::class, 'store'])->name('support.store');
        Route::get('support/{id}/edit', [CmsPageController::class, 'edit'])->name('support.edit');
        Route::put('support/{id}', [CmsPageController::class, 'update'])->name('support.update');
        Route::delete('support/{id}', [CmsPageController::class, 'destroy'])->name('support.destroy');
    });

	Route::group(['namespace' => 'Gallery', 'middleware' => 'permission:cms galeria'], function () {
        Route::get('gallery', [CmsImageController::class, 'index'])->name('gallery.index');
        Route::post('gallery', [CmsImageController::class, 'store'])->name('gallery.store');
        Route::delete('gallery/{id}', [CmsImageController::class, 'destroy'])->name('gallery.destroy');
    });

	Route::group(['namespace' => 'Staff', 'middleware' => 'permission:cms personal'], function () {
        Route::get('staff', [CmsPersonController::class, 'index'])->name('staff.index');
        Route::post('staff', [CmsPersonController::class, 'store'])->name('staff.store');
        Route::get('staff/{id}/edit', [CmsPersonController::class, 'edit'])->name('staff.edit');
       Route::delete('staff/{id}', [CmsPersonController::class, 'destroy'])->name('staff.destroy');
    });

    Route::group(['namespace' => 'Pages', 'middleware' => 'permission:cms paginas'], function () {
        Route::get('pages', [CmsPageController::class, 'indexPage'])->name('pages.index');
        Route::post('pages', [CmsPageController::class, 'storePage'])->name('pages.store');
        Route::get('pages/{id}/edit', [CmsPageController::class, 'editPage'])->name('pages.edit');
        Route::put('pages/{id}', [CmsPageController::class, 'updatePage'])->name('pages.update');
        Route::delete('pages/{id}', [CmsPageController::class, 'destroyPage'])->name('pages.destroy');
    });

    Route::group(['namespace' => 'Schedule', 'middleware' => 'permission:cms horario'], function () {
        Route::get('schedule', [CalendarController::class, 'index'])->name('schedule.index');
        Route::post('schedule', [CalendarController::class, 'store'])->name('schedule.store');
        Route::patch('schedule', [CalendarController::class, 'update'])->name('schedule.update');
        Route::delete('schedule/{id}', [CalendarController::class, 'destroy'])->name('schedule.destroy');

    });

    Route::group(['namespace' => 'Events', 'middleware' => 'permission:cms eventos'], function () {

    });

    Route::group(['namespace' => 'Plans', 'middleware' => 'permission:cms planes'], function () {

    });

});

