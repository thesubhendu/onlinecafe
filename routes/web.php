<?php

use app\Models\Card;
use app\Models\Order;
use app\Mail\orderSubmitted;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\CardController;
use app\Http\Controllers\CartController;
use app\Http\Controllers\CardsController;
use app\Http\Controllers\OrderController;
use Gloudemans\Shoppingcart\Facades\Cart;
use app\Http\Controllers\VendorController;
use app\Http\Controllers\ProductController;
use app\Http\Controllers\CheckoutController;
use app\Http\Controllers\Auth\LoginController;
use app\Http\Controllers\FavouritesController;
use app\Http\Controllers\VendorLikeController;
use app\Http\Controllers\Auth\LogoutController;
use app\Http\Controllers\LandingPageController;
use app\Http\Controllers\ConfirmOrderController;
use app\Http\Controllers\VendorOrdersController;
use app\Http\Controllers\VendorRatingController;
use app\Http\Controllers\Auth\RegisterController;
use app\Http\Controllers\Account\AccountController;
use app\Http\Controllers\CartSaveForLaterController;
use app\Http\Controllers\Subscriptions\PlanController;
use app\Http\Controllers\Subscriptions\SubscriptionController;
use app\Http\Controllers\Account\Subscriptions\SubscriptionCardController;
use app\Http\Controllers\Account\Subscriptions\SubscriptionSwapController;
use app\Http\Controllers\Account\Subscriptions\SubscriptionCancelController;
use app\Http\Controllers\Account\Subscriptions\SubscriptionResumeController;
use app\Http\Controllers\Account\Subscriptions\SubscriptionInvoiceController;
use app\Http\Controllers\Account\Subscriptions\SubscriptionController as AccountSubscription;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/', 'landing-page');
// route::get('/', 'App\http\Controllers\LandingPageController@index')->name('landing-page');
route::get('/', [LandingPageController::class, 'index'])->name('home');
route::get('/vendor/{vendor}', [VendorController::class, 'show'])->name('vendor.show');
Route::get('/vendornew/{vendor}', [VendorController::class, 'vendorshow'])->name('vendor.newshow');
Route::get('/vendor/{vendor}/orders', [VendorOrdersController::class, 'index'])->name('vendor.orders');



Route::group(['namespace' => 'Subscriptions'], function () {
    Route::get('plans', [PlanController::class, 'index'])
    ->name('subscriptions.plans');
    Route::get('/plans/subscriptions', [SubscriptionController::class, 'index'])
    ->name('plan.subscriptions');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])
    ->name('subscriptions.store');
});

Route::group(['namespace' => 'Account', 'prefix' => 'account'], function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});

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

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/vendor/{vendor}/likes', [VendorLikeController::class, 'store'])->name('vendor.likes');
Route::delete('/vendor/{vendor}/likes', [VendorLikeController::class, 'destroy']);

Route::post('/vendor/{vendor}/rate', [VendorRatingController::class, 'store'])->name('vendor.rating')->middleware('auth');

Route::get('/vendor/{vendor}/products', [ProductController::class, 'vendorproducts'])->name('vendor.products');


Route::get('/user/favourites', [FavouritesController::class, 'userlikes'])->name('user.likes');

Route::get('/confirm/{order}/update', [ConfirmOrderController::class, 'update'])->name('confirm_order.update');
Route::get('orders/create/{product}', [OrderController::class, 'create'])->name('orders.create')->middleware('auth');

// Route::resource('orders', OrderController::class, ['names' => [
//     'store' => 'order.store'
// ]])->middleware('auth');

Route::resource('/orders', OrderController::class, ['except' => 'create'])->names([
    'store' => 'order.store'
])->middleware('auth');

Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.remove');

Route::post('/cart/saveforlater/{product}', [CartController::class, 'saveItemForLater'])->name('cart.saveForLater');
Route::delete('/saveforlater/{product}', [CartSaveForLaterController::class, 'destroy'])->name('saveforlater.remove');
Route::post('/saveforlater/addtocart/{product}', [CartSaveForlaterController::class, 'moveToCart'])->name('saveforlater.addtocart');



Route::get('/cards', [CardsController::class, 'index'])->name('cards.index');
Route::get('/rate/{vendor}', [VendorRatingController::class, 'index'])->name('vendor_rating.index');

Route::view('/thankyou', 'thankyou')->name('order.thankyou');


Route::get('empty', function () {
    Cart::destroy();
});

Route::get('/testcard', function () {
    $card = Card::find(1);

    dd($card->stamps->groupBy('card_id'));
});

Route::get('/email', function () {

    $order = Order::find(134);
    Mail::to('coffeeshoporders0@gmail.com')->send(new orderSubmitted($order));
    return new orderSubmitted($order);
});

Route::view('/comment', 'comment');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
