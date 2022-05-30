<?php

declare(strict_types=1);

use App\Orchid\Screens\DashboardScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', DashboardScreen::class)
     ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
     ->name('platform.profile')
     ->breadcrumbs(function (Trail $trail) {
         return $trail
             ->parent('platform.index')
             ->push(__('Profile'), route('platform.profile'));
     });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
     ->name('platform.systems.users.edit')
     ->breadcrumbs(function (Trail $trail, $user) {
         return $trail
             ->parent('platform.systems.users')
             ->push(__('User'), route('platform.systems.users.edit', $user));
     });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
     ->name('platform.systems.users.create')
     ->breadcrumbs(function (Trail $trail) {
         return $trail
             ->parent('platform.systems.users')
             ->push(__('Create'), route('platform.systems.users.create'));
     });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
     ->name('platform.systems.users')
     ->breadcrumbs(function (Trail $trail) {
         return $trail
             ->parent('platform.index')
             ->push(__('Users'), route('platform.systems.users'));
     });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
     ->name('platform.systems.roles.edit')
     ->breadcrumbs(function (Trail $trail, $role) {
         return $trail
             ->parent('platform.systems.roles')
             ->push(__('Role'), route('platform.systems.roles.edit', $role));
     });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
     ->name('platform.systems.roles.create')
     ->breadcrumbs(function (Trail $trail) {
         return $trail
             ->parent('platform.systems.roles')
             ->push(__('Create'), route('platform.systems.roles.create'));
     });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
     ->name('platform.systems.roles')
     ->breadcrumbs(function (Trail $trail) {
         return $trail
             ->parent('platform.index')
             ->push(__('Roles'), route('platform.systems.roles'));
     });


//Route::screen('idea', 'Idea::class','platform.screens.idea');
Route::screen('product/{product?}', \App\Orchid\Screens\ProductEditScreen::class)
     ->name('platform.product.edit');

Route::screen('products', \App\Orchid\Screens\ProductListScreen::class)
     ->name('platform.product.list');


Route::screen('order/{order?}', \App\Orchid\Screens\OrderEditScreen::class)
     ->name('platform.order.edit');

Route::screen('order-show/{order?}', \App\Orchid\Screens\OrderDetailScreen::class)
     ->name('platform.order.show');

Route::screen('deal-show/{deal?}', \App\Orchid\Screens\DealDetailScreen::class)
     ->name('platform.deal.show');

Route::screen('orders', \App\Orchid\Screens\OrderListScreen::class)
     ->name('platform.order.list');


Route::screen('deals', \App\Orchid\Screens\DealListScreen::class)
     ->name('platform.deal.list');

Route::screen('deal/{deal?}', \App\Orchid\Screens\DealEditScreen::class)
     ->name('platform.deal.edit');

Route::screen('deal-add-product/{product}/{deal}', \App\Orchid\Screens\AddProductToDealScreen::class)
     ->name('platform.deal.addProduct');

Route::screen('services', \App\Orchid\Screens\ServiceListScreen::class)
    ->name('platform.service.list');
Route::screen('service/{service?}', \App\Orchid\Screens\ServiceEditScreen::class)
    ->name('platform.service.edit');
