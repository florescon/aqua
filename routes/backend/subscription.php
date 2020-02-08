<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TagPaymentController;

Route::group([
    'prefix' => 'subscription',
    'as' => 'subscription.',
    'namespace' => 'Subscription',
], function () {

    Route::group(['namespace' => 'Subscription', 'middleware' => 'permission:suscripciones'], function () {
		Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
	    Route::get('subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
	    Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');

	    Route::patch('subscription', [SubscriptionController::class, 'update'])->name('subscription.update');

		Route::get('subscription/{id}', [SubscriptionController::class, 'show'])->name('subscription.show');
		Route::get('subscription/print/{id}', [SubscriptionController::class, 'print'])->name('subscription.print');

        Route::get('subscription/{id}/generate-pdf', [SubscriptionController::class, 'generatePDF'])->name('subscription.generate');

        Route::post('subscription/{id}/payments-pdf', [SubscriptionController::class, 'printpaymentsPDF'])->name('subscription.printpayments');

	    Route::get('subscription/delete/{id}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');

        Route::get('search', [SubscriptionController::class, 'search'])->name('subscription.search');

	});

    Route::group(['namespace' => 'Payment', 'middleware' => 'permission:mensualidades'], function () {
		Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
	    Route::get('payment/create', [PaymentController::class, 'create'])->name('payment.create');
	    Route::post('payment', [PaymentController::class, 'store'])->name('payment.store');
	    Route::delete('payment/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');

        Route::get('payment/{id}/generate-pdf', [PaymentController::class, 'generatePDF'])->name('payment.generate');

	});
    Route::get('select2-load-payment/{id}', [PaymentController::class, 'select2LoadMore'])->name('payment.select');


    Route::group(['namespace' => 'Tag', 'middleware' => 'permission:etiquetas de mensualidades'], function () {
		Route::get('tag', [TagPaymentController::class, 'index'])->name('tag.index');
	    Route::post('tag', [TagPaymentController::class, 'store'])->name('tag.store');
	    Route::patch('tag', [TagPaymentController::class, 'update'])->name('tag.update');
	    Route::get('tag/delete/{id}', [TagPaymentController::class, 'destroy'])->name('tag.destroy');
	});
    Route::get('select2-load-tagpayment', [TagPaymentController::class, 'select2LoadMore'])->name('tag.select');

});
