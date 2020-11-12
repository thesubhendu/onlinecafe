<?php

use Illuminate\Support\Facades\Route;

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
route::get('/', 'App\http\Controllers\LandingPageController@index')->name('landing-page');
route::get('/vendor/{vendor}', 'App\http\Controllers\VendorController@show')->name('vendor.show');

Route::view('/menu', 'menu');
Route::view('/cart', 'cart');
Route::view('/vendor', 'vendor');
Route::view('/orders', 'orders');
Route::view('/comment', 'comment');
Route::view('/favourites', 'favourites');
Route::view('/order_submitted', 'order_submitted');
Route::view('/thankyou', 'thankyou');
Route::view('/cards', 'cards');

