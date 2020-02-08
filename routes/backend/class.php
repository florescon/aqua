<?php

use App\Http\Controllers\ClassroomTypesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TagController;

Route::group([
    'prefix' => 'class',
    'as' => 'class.',
    'namespace' => 'Class',
], function () {

    Route::group(['namespace' => 'Type', 'middleware' => 'permission:tipo de clase'], function () {
		Route::get('type', [ClassroomTypesController::class, 'index'])->name('type.index');
	    Route::post('type', [ClassroomTypesController::class, 'store'])->name('type.store');
	    Route::patch('type', [ClassroomTypesController::class, 'update'])->name('type.update');
	    Route::get('type/delete/{id}', [ClassroomTypesController::class, 'destroy'])->name('type.destroy');
	});
    Route::get('select-load-type', [ClassroomTypesController::class, 'select2LoadMore'])->name('type.select');

    Route::group(['namespace' => 'Section', 'middleware' => 'permission:secciones'], function () {
		Route::get('section', [SectionController::class, 'index'])->name('section.index');
	    Route::post('section', [SectionController::class, 'store'])->name('section.store');
	    Route::patch('section', [SectionController::class, 'update'])->name('section.update');
	    Route::get('section/delete/{id}', [SectionController::class, 'destroy'])->name('section.destroy');
	});
    Route::get('select2-load-section', [SectionController::class, 'select2LoadMore'])->name('section.select');

    Route::group(['namespace' => 'Class', 'middleware' => 'permission:clases'], function () {
		Route::get('class', [ClassroomController::class, 'index'])->name('class.index');
	    Route::post('class', [ClassroomController::class, 'store'])->name('class.store');
	    Route::patch('class', [ClassroomController::class, 'update'])->name('class.update');
	    Route::delete('class/{id}', [ClassroomController::class, 'destroy'])->name('class.destroy');
	});

    Route::group(['namespace' => 'Tag', 'middleware' => 'permission:etiquetas de clases'], function () {
		Route::get('tag', [TagController::class, 'index'])->name('tag.index');
	    Route::post('tag', [TagController::class, 'store'])->name('tag.store');
	    Route::patch('tag', [TagController::class, 'update'])->name('tag.update');
	    Route::get('tag/delete/{id}', [TagController::class, 'destroy'])->name('tag.destroy');	    
	});
    Route::get('select2-load-tag', [TagController::class, 'select2LoadMore'])->name('tag.select');


});
