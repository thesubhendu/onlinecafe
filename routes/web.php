<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfirmOrderController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhoneVerificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RedeemFreeCoffeeController;
use App\Http\Controllers\Subscriptions\PlanController;
use App\Http\Controllers\Subscriptions\SubscriptionController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorRatingController;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\FavoriteVendors;
use App\Http\Livewire\MyOrders;
use App\Http\Livewire\VendorOnboarding;
use App\Http\Livewire\VendorOnboarding\ShopSetup;
use Illuminate\Support\Facades\Route;

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});

Route::view('/main-landing', 'main-landing')->name('main-landing');
Route::view('/vendor-landing', 'vendor-landing')->name('vendor-landing');

//Route::get('tinker', function () {
//
//    $vendor = \App\Models\User::find(4);
//    $vendor->notify(new \App\Notifications\NewOrderNotification(Order::first()));
////    \App\Events\OrderConfirmed::dispatch(Order::find(10));
//    dd('order confirmed notifi');
//
//});

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/vendor/{vendor}', [VendorController::class, 'show'])->name('vendor.show');

Route::group(['namespace' => 'Subscriptions'], function () {
    Route::get('plans', [PlanController::class, 'index'])
        ->name('subscriptions.plans');

    Route::get('/plans/subscriptions', [SubscriptionController::class, 'index'])
        ->name('plans.subscribe')->middleware('auth');

    Route::post('/subscriptions', [SubscriptionController::class, 'store'])
    ->name('subscriptions.store')->middleware('auth');
});

Route::group(['namespace' => 'Account', 'prefix' => 'account'], function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});

require(__DIR__ . '/partials/_manage-subscriptions.php');

Route::post('/vendor/{vendor}/rate', [VendorRatingController::class, 'store'])->name('vendor.rating')->middleware('auth');
Route::get('/vendor/{vendor}/products', [ProductController::class, 'vendorproducts'])->name('vendor.products');

Route::get('/user/favourites', FavoriteVendors::class)->name('user.likes')->middleware('auth');
Route::get('/confirm/{order}/update',
    [ConfirmOrderController::class, 'confirm'])->name('confirm_order.confirm')->middleware('auth');

//Auth Routes
Route::middleware('auth')->group(function() {

    Route::get('add-to-cart/{product}', \App\Http\Livewire\AddToCart::class)->name('orders.create');

    Route::get('orders', MyOrders::class)->name('orders.index');

    Route::resource('/orders', OrderController::class, ['except' => 'create'])->names([
        'store' => 'order.store',
    ])->only('store');

    Route::get('/order-submitted/{order}',
        \App\Http\Livewire\OrderSubmitted::class)->name('order.submitted'); //status displaying page

    Route::get('/cart/checkout', Checkout::class)->name('checkout.index');

    Route::get('/cart', \App\Http\Livewire\ShoppingCart::class)->name('cart');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
});

//Route::post('/cart/saveforlater/{product}', [CartSaveForLaterController::class, 'save'])->name('saveforlater.save');
//Route::delete('/saveforlater/{product}', [CartSaveForLaterController::class, 'destroy'])->name('saveforlater.remove');
//Route::post('/saveforlater/addtocart/{product}',
//    [CartSaveForlaterController::class, 'moveToCart'])->name('saveforlater.addtocart');


Route::get('/cards', \App\Http\Livewire\LoyalityCard::class)->name('cards.index')->middleware('auth');
Route::get('/rate/{vendor}', [VendorRatingController::class, 'index'])->name('vendor_rating.index');


Route::view('/comment', 'comment');

Route::middleware('auth')->prefix('vendor-onboarding')->group(function () {
    Route::get('/register',
        VendorOnboarding\Registration::class)->name('register-business.create');

    Route::get('/payment',
        VendorOnboarding\Payment::class)->name('register-business.payment');

    Route::get('/shop-setup',
        ShopSetup::class)->name('register-business.shop-setup');
});

//send mobile verification code
Route::post('phone-verification/send',
    [PhoneVerificationController::class, 'send'])->name('phone-verification.send')//    ->middleware(['throttle:3,1'])
;
Route::post('phone-verification/verify',
    [PhoneVerificationController::class, 'verify'])->name('phone-verification.verify');

Route::get('/user-info', function (Request $request) {
    return auth()->user();
})->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/manage-shop', ShopSetup::class)->middleware('auth')->name('manage-shop');
