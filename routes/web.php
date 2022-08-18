<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfirmOrderController;
use App\Http\Controllers\DownloadFlyerController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PhoneVerificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Subscriptions\PlanController;
use App\Http\Controllers\Subscriptions\SubscriptionController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorRatingController;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\ClaimLoyaltyProducts;
use App\Http\Livewire\FavoriteVendors;
use App\Http\Livewire\LoyaltyCheckout;
use App\Http\Livewire\MyOrders;
use App\Http\Livewire\VendorOnboarding;
use App\Http\Livewire\VendorOnboarding\ShopSetup;
use App\Services\RewardService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;


Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});


Route::view('/main-landing', 'main-landing')->name('main-landing');
Route::view('/vendor-landing', 'vendor-landing')->name('vendor-landing');

Route::get('tinker', function () {
    $rewardData = (new RewardService(Cart::content()));

});

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

Route::get('/vendor/{vendor}/products', [ProductController::class, 'vendorProducts'])->name('vendor.products');

Route::get('/user/favourites', FavoriteVendors::class)->name('user.likes')->middleware('auth');
Route::get('/confirm/{order}/update',
    [ConfirmOrderController::class, 'confirm'])->name('confirm_order.confirm')->middleware('auth');

//Auth Routes
Route::middleware('auth')->group(function() {

    Route::get('add-to-cart/{product}', \App\Http\Livewire\AddToCart::class)->name('orders.create');

    Route::get('orders', MyOrders::class)->name('orders.index');


    Route::get('/order-submitted/{order}',
        \App\Http\Livewire\OrderSubmitted::class)->name('order.submitted'); //status displaying page

    Route::get('/cart/checkout', Checkout::class)->name('checkout.index');

    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

    Route::get('claim-loyalty-products/{card}', ClaimLoyaltyProducts::class )
        ->name('claim-loyalty-products');
    Route::get('loyalty-checkout/{card}', LoyaltyCheckout::class )
        ->name('loyalty-checkout');
});


Route::get('/cards', \App\Http\Livewire\LoyalityCard::class)->name('cards.index')->middleware('auth');
Route::get('/rate/{vendor}', [VendorRatingController::class, 'index'])->name('vendor_rating.index');

Route::get('save-deal/{deal}', \App\Http\Livewire\SaveDeal::class)->name('save-deal');

Route::view('/comment', 'comment');

Route::get('vendor-onboarding/register',
    VendorOnboarding\Registration::class)->name('register-business.create');
Route::middleware('auth')->prefix('vendor-onboarding')->group(function () {
    Route::get('/payment',
        VendorOnboarding\Payment::class)->name('register-business.payment')->middleware('not.subscribed','can:vendor');

    Route::get('/shop-setup',
        ShopSetup::class)->name('register-business.shop-setup')->middleware('subscribed');
    Route::get('/menu-products-setup',
        VendorOnboarding\MenuProductsSetup::class)->name('register-business.menu-products-setup')->middleware('can:vendor');
    Route::get('/menu-prices-setup',
        VendorOnboarding\MenuPricesSetup::class)->name('register-business.menu-prices-setup')->middleware('can:vendor');

    Route::get('/stripe/refresh-url/{vendor}',[\App\Http\Controllers\StripeConnectController::class, 'refreshUrl'])->name('stripe.refreshUrl');
    Route::get('/stripe/create-connect-account/{vendor}',[\App\Http\Controllers\StripeConnectController::class, 'createAccount'])->name('stripe.createAccount');
});

//send mobile verification code
Route::post('phone-verification/send',
    [PhoneVerificationController::class, 'send'])->name('phone-verification.send')//    ->middleware(['throttle:3,1'])
;
Route::post('phone-verification/verify',
    [PhoneVerificationController::class, 'verify'])->name('phone-verification.verify');

Route::get('/user-info', function (Request $request) {
    if(auth()->check()) {
        return ['user'=> auth()->user()];
    }
    return ['user'=>''];
});

Route::middleware(['auth:sanctum', 'verified','phone_verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/manage-shop', ShopSetup::class)->middleware('auth','subscribed')->name('manage-shop');

Route::view('/verify-phone','auth.verify-email')->name('phone-verification.notice');

Route::get('download-customer-flyer', DownloadFlyerController::class)->name('download-customer-flyer');

Route::get('vendor-search', \App\Http\Livewire\VendorSearch::class)->name('vendor-search');
