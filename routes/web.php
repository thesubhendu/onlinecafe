<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\ConfirmOrderController;
use App\Http\Controllers\DownloadFlyerController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PhoneVerificationController;
use App\Http\Controllers\Subscriptions\PlanController;
use App\Http\Controllers\Subscriptions\SubscriptionController;
use App\Http\Controllers\VendorController;
use App\Http\Livewire\VendorOnboarding;
use App\Http\Livewire\VendorOnboarding\ShopSetup;
use Illuminate\Support\Facades\Route;

Route::view('/offline', 'vendor.laravelpwa.offline');

Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/terms-conditions', 'termscondition')->name('terms-conditions');


Route::get('/user-info', function (\Illuminate\Http\Request $request) {
    if (auth()->check()) {
        return ['user' => auth()->user()];
    }
    return ['user' => ''];
});

Route::view('/main-landing', 'main-landing')->name('main-landing');
Route::view('/vendor-landing', 'vendor-landing')->name('vendor-landing');


Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/vendors/{vendor}', [VendorController::class, 'show'])->name('vendor.show');

Route::group(['namespace' => 'Subscriptions'], function () {
    Route::get('plans', [PlanController::class, 'index'])->name('subscriptions.plans');
    Route::get('/plans/subscriptions', [SubscriptionController::class, 'index'])->name('plans.subscribe')->middleware('auth');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store')->middleware('auth');
});

Route::group(['namespace' => 'Account', 'prefix' => 'account'], function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});

require(__DIR__ . '/partials/_manage-subscriptions.php');

Route::get('/confirm/{order}/update',[ConfirmOrderController::class, 'confirm'])->name('confirm_order.confirm')->middleware('auth');

Route::get('vendor-onboarding/register',VendorOnboarding\Registration::class)->name('register-business.create');
Route::middleware('auth')->prefix('vendor-onboarding')->group(function () {
    Route::get('/payment',VendorOnboarding\Payment::class)->name('register-business.payment')->can('vendor');
    Route::get('/shop-setup',ShopSetup::class)->name('register-business.shop-setup')->can('vendor');
    Route::get('/menu-products-setup',VendorOnboarding\MenuProductsSetup::class)->name('register-business.menu-products-setup')->middleware('can:vendor');
    Route::get('/menu-prices-setup', VendorOnboarding\MenuPricesSetup::class)->name('register-business.menu-prices-setup')->middleware('can:vendor');

    Route::get('/stripe/refresh-url/{vendor}',[\App\Http\Controllers\StripeConnectController::class, 'refreshUrl'])->name('stripe.refreshUrl');
    Route::get('/stripe/create-connect-account/{vendor}',[\App\Http\Controllers\StripeConnectController::class, 'createAccount'])->name('stripe.createAccount');
});

//send mobile verification code
Route::post('phone-verification/send',[PhoneVerificationController::class, 'send'])->name('phone-verification.send');
Route::post('phone-verification/verify',[PhoneVerificationController::class, 'verify'])->name('phone-verification.verify');
Route::view('/verify-phone','auth.verify-email')->name('phone-verification.notice');


Route::get('/manage-shop', ShopSetup::class)->middleware('auth','can:vendor')->name('manage-shop');
Route::get('download-customer-flyer', DownloadFlyerController::class)->name('download-customer-flyer');
