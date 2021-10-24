<?php

namespace App\Http\Controllers;

use App\Events\VendorConfirmsOrder;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class VendorOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Vendor $vendor, Order $order)
    {

        $user          = Auth::user();
        $vendor_orders = Order::where('vendor_id', $vendor->id)
            ->with('products')
            ->with('vendor')
            ->get();

        foreach ($vendor_orders as $order) {
            $order->products;
        }

        event(new VendorConfirmsOrder($vendor, $order, $user));

        return view('orders_vendor')
            ->with('vendor', $vendor->orders)
            ->with('order', $order)
            ->with('products');

    }
}
