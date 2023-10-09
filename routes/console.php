<?php

use App\Imports\VendorImport;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('tinker:order-initiate', function () {

    $vendor = User::where('email', 'vendor@cafe.np')->first();
    $order = \App\Models\Order::first();

    $vendor->notify(new NewOrderNotification($order));

})->purpose('Test command do not run');

Artisan::command('import-vendors', function () {
    $this->output->title('Starting import');
    $vendorImport = new VendorImport();
    $vendorImport->withOutput($this->output)->import( public_path('vendors.csv'));
    $this->output->success('Import successful');

})->purpose('Import vendor from csv');

