<?php

use App\Http\Controllers\SettingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\SmallCardController;

Route::group([
    'prefix' => 'setting',
    'as' => 'setting.',
    'namespace' => 'Setting',
], function () {

    Route::group(['namespace' => 'General', 'middleware' => 'permission:configuraciones generales'], function () {
		Route::get('general', [SettingController::class, 'index'])->name('general.index');
	    Route::post('general', [SettingController::class, 'store'])->name('general.store');
	    Route::patch('general', [SettingController::class, 'update'])->name('general.update');
	    Route::delete('general/{id}', [SettingController::class, 'destroy'])->name('general.destroy');
	});

	Route::group(['namespace' => 'School', 'middleware' => 'permission:instituciones'
		], function () {
		Route::get('school', [SchoolController::class, 'index'])->name('school.index');
	    Route::post('school', [SchoolController::class, 'store'])->name('school.store');
	    Route::patch('school', [SchoolController::class, 'update'])->name('school.update');
	    Route::get('school/delete/{id}', [SchoolController::class, 'destroy'])->name('school.destroy');
	});
	Route::get('select2-load-school', [SchoolController::class, 'select2LoadMore'])->name('school.select');


	Route::group(['namespace' => 'Regulation', 'middleware' => 'permission:reglamento'
	], function () {
    
    Route::get('regulation', [RegulationController::class, 'index'])->name('regulation.index');
    // Route::get('regulation/create', [RegulationController::class, 'create'])->name('regulation.create');
    // Route::post('regulation', [RegulationController::class, 'store'])->name('regulation.store');
    Route::get('regulation/generate-pdf', [RegulationController::class, 'generatePDF'])->name('regulation.generate');

		Route::group(['prefix' => 'regulation/{regulation}'], function () {

	    	Route::patch('regulation', [RegulationController::class, 'update'])->name('regulation.update')->where('user', '[0-9]+');
		});
	});

	Route::group(['namespace' => 'Method', 
		'middleware' => 'permission:metodos de pago'
		], function () {
		Route::get('method', [PaymentMethodsController::class, 'index'])->name('method.index');
	    Route::post('method', [PaymentMethodsController::class, 'store'])->name('method.store');
	    Route::patch('method', [PaymentMethodsController::class, 'update'])->name('method.update');
        Route::get('method/{id}', [PaymentMethodsController::class, 'show'])->name('method.show')->middleware('role:'.config('access.users.admin_role'));
	    Route::delete('method/{id}', [PaymentMethodsController::class, 'destroy'])->name('method.destroy');

	    Route::post('smallcard', [SmallCardController::class, 'store'])->name('smallcard.store');
	    Route::patch('smallcard', [SmallCardController::class, 'update'])->name('smallcard.update');
        Route::get('smallcard/{id}', [SmallCardController::class, 'show'])->name('smallcard.show');
	    Route::delete('smallcard/{id}', [SmallCardController::class, 'destroy'])->name('smallcard.destroy');


	});
	Route::get('select2-load-method', [PaymentMethodsController::class, 'select2LoadMore'])->name('method.select');


});

