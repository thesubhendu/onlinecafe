<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerStripePaymentController extends Controller
{
    public function generatePaymentLink(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.api_key'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 2,
            ]],
            'mode' => 'payment',
            'success_url' => config('app.client_url').'/#!/my-orders/',
            'cancel_url' => config('app.client_url').'/#!/checkout',
//            'payment_intent_data' => [
//                'application_fee_amount' => 123,
//            ],
        ]
//            ['stripe_account' => '{{CONNECTED_ACCOUNT_ID}}']
        );

        return ['sessionId'=> $session->id];
    }
}
