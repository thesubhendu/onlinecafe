<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CustomerStripePaymentController extends Controller
{
    function __construct(
        public CartService $cartService
    )
    {

    }
    public function generatePaymentLink(Request $request)
    {
        $customer = auth()->user();
        $activeOrder = $this->cartService->getActiveOrder();
        \Stripe\Stripe::setApiKey(config('services.stripe.api_key'));
        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $activeOrder->order_total*100,
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            //todo add connected account id
            return response()->json(['clientSecret'=> $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error'=> $e->getMessage()], 500);
        }

    }
}
