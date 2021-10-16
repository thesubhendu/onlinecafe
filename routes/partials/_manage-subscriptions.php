<?php
use App\Http\Controllers\Account\Subscriptions\SubscriptionCardController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionSwapController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionCancelController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionResumeController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionInvoiceController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionController as AccountSubscription;

Route::group(['namespace' => 'Subscriptions', 'prefix' => 'subscriptions'], function () {
    Route::get('/', [AccountSubscription::class, 'index'])->name('account.subscriptions');
    Route::get('/cancel', [SubscriptionCancelController::class, 'index'])->name('account.subscriptions.cancel');
    Route::post('/cancel', [SubscriptionCancelController::class, 'store']);

    Route::get('/resume', [SubscriptionResumeController::class, 'index'])->name('account.subscriptions.resume');
    Route::post('/resume', [SubscriptionResumeController::class, 'store']);

    Route::get('/swap', [SubscriptionSwapController::class, 'index'])->name('account.subscriptions.swap');
    Route::post('/swap', [SubscriptionSwapController::class,'store']);

    Route::get('/card', [SubscriptionCardController::class, 'index'])->name('account.subscriptions.card');
    Route::post('/card', [SubscriptionCardController::class,'store']);

    Route::get('/invoices', [SubscriptionInvoiceController::class, 'index'])->name('account.subscriptions.invoices');
    Route::get('/invoices/{id}', [SubscriptionInvoiceController::class, 'show'])->name('account.subscriptions.invoice');
    // Route::post('/resume', [SubscriptionResumeController::class, 'store']);

});
