<?php

use App\Http\Controllers\ConfirmOrderController;
use App\Http\Controllers\DownloadFlyerController;
use App\Http\Controllers\PhoneVerificationController;
use App\Http\Controllers\StripeConnectController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\VendorController;
use App\Livewire\VendorOnboarding\MenuPricesSetup;
use App\Livewire\VendorOnboarding\MenuProductsSetup;
use App\Livewire\VendorOnboarding\Payment;
use App\Livewire\VendorOnboarding\Registration;
use App\Livewire\VendorOnboarding\ShopSetup;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin')->name('home');
Route::redirect('/vendors/login', '/login')->name('vendor.login');

//Static Routes
Route::view('/offline', 'vendor.laravelpwa.offline');
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/terms-conditions', 'termscondition')->name('terms-conditions');
Route::get('download-customer-flyer', DownloadFlyerController::class)->name('download-customer-flyer');

Route::get('/user-info', UserInfoController::class);
Route::get('/vendors/{vendor}', [VendorController::class, 'show'])->name('vendor.show'); //redundant route, have to check
Route::get('/confirm/{order}/update',[ConfirmOrderController::class, 'confirm'])->name('confirm_order.confirm')->middleware('auth');

//Start Vendor Onboarding Routes
Route::get('vendor-onboarding/register',Registration::class)->name('register-business.create');
Route::middleware('auth')->prefix('vendor-onboarding')->group(function () {
    Route::get('/payment',Payment::class)->name('register-business.payment')->can('vendor');
    Route::get('/shop-setup',ShopSetup::class)->name('register-business.shop-setup')->can('vendor');
    Route::get('/menu-products-setup',MenuProductsSetup::class)->name('register-business.menu-products-setup')->middleware('can:vendor');
    Route::get('/menu-prices-setup', MenuPricesSetup::class)->name('register-business.menu-prices-setup')->middleware('can:vendor');

    Route::get('/stripe/refresh-url/{vendor}',[StripeConnectController::class, 'refreshUrl'])->name('stripe.refreshUrl');
    Route::get('/stripe/create-connect-account/{vendor}',[StripeConnectController::class, 'createAccount'])->name('stripe.createAccount');
});
// End Vendor Onboarding Routes

//send mobile verification code
Route::post('phone-verification/send',[PhoneVerificationController::class, 'send'])->name('phone-verification.send');
Route::post('phone-verification/verify',[PhoneVerificationController::class, 'verify'])->name('phone-verification.verify');
Route::view('/verify-phone','auth.verify-email')->name('phone-verification.notice');

Route::get('/manage-shop', ShopSetup::class)->middleware('auth','can:vendor')->name('manage-shop');
