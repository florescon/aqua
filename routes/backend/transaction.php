<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\CashOutController;
use App\Http\Controllers\SmallBoxController;

Route::group([
    'prefix' => 'transaction',
    'as' => 'transaction.',
    'namespace' => 'Transaction',
], function () {

    Route::group(['namespace' => 'Expense', 'middleware' => 'permission:egresos'], function () {
		Route::get('expense', [ExpenseController::class, 'index'])->name('expense.index');
	    Route::post('expense', [ExpenseController::class, 'store'])->name('expense.store');
	    Route::patch('expense', [ExpenseController::class, 'update'])->name('expense.update');

        Route::get('expense/{id}/generate-pdf', [ExpenseController::class, 'generatePDF'])->name('expense.generate');

	    Route::get('expense/delete/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
	});

    Route::group(['namespace' => 'Income', 'middleware' => 'permission:ingresos'], function () {
		Route::get('income', [IncomeController::class, 'index'])->name('income.index');
	    Route::post('income', [IncomeController::class, 'store'])->name('income.store');
	    Route::patch('income', [IncomeController::class, 'update'])->name('income.update');
	    Route::get('income/delete/{id}', [IncomeController::class, 'destroy'])->name('income.destroy');
	});

    Route::group(['namespace' => 'Cash', 'middleware' => 'permission:corte de caja'], function () {
		Route::get('cash', [CashOutController::class, 'index'])->name('cash.index');
		Route::get('cashall', [CashOutController::class, 'indexall'])->name('cash.indexall');
		Route::post('cash/inital', [CashOutController::class, 'storeInitial'])->name('cash.initial');
	    Route::post('cash', [CashOutController::class, 'store'])->name('cash.store');
	    Route::patch('cash', [CashOutController::class, 'update'])->name('cash.update');
	    Route::patch('cash/initial', [CashOutController::class, 'updateInitial'])->name('cash.updateinitial');
	    Route::patch('cash/withdraw', [CashOutController::class, 'withdraw'])->name('cash.withdraw');

	    Route::patch('cash/{id}', [CashOutController::class, 'updateFinal'])->name('cash.updatefinal');
		
		Route::get('cashout/{cash}', [CashOutController::class, 'show'])->name('cash.show');
		Route::get('cashout/cash/{cash}', [CashOutController::class, 'showcash'])->name('cash.showcash');
		Route::get('cashout/card/{cash}', [CashOutController::class, 'showcard'])->name('cash.showcard');

        Route::get('cashout/{id}/generate-pdf', [CashOutController::class, 'generatePDF'])->name('cash.generate');


	    Route::delete('cash/{id}', [CashOutController::class, 'destroy'])->name('cash.destroy');
	});


    Route::group(['namespace' => 'Small', 'middleware' => 'permission:caja chica'], function () {
		Route::get('small', [SmallBoxController::class, 'index'])->name('small.index');
	    Route::post('small', [SmallBoxController::class, 'store'])->name('small.store');
	    Route::patch('small', [SmallBoxController::class, 'update'])->name('small.update');
	    Route::get('small/delete/{id}', [SmallBoxController::class, 'destroy'])->name('small.destroy');
	});


});
