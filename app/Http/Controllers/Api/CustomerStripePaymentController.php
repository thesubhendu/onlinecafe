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
        $activeOrder = $this->cartService->getActiveOrder();
        $vendor = $activeOrder->vendor;
        $applicationFee = 10; //10 cents
        \Stripe\Stripe::setApiKey(config('services.stripe.api_key'));
        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $activeOrder->order_total*100,
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'order_id' => $activeOrder->id,
                ],
                // 'application_fee_amount' => $applicationFee,
            ],
                ['stripe_account' => $vendor->stripe_account_id]
            );

            return response()->json(['clientSecret'=> $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error'=> $e->getMessage()], 500);
        }

    }
}
