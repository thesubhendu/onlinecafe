<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $applicationFee = $this->getApplicationFee($activeOrder); //10 cents
        \Stripe\Stripe::setApiKey(config('services.stripe.api_key'));
        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $activeOrder->order_total*100,
                'currency' => 'aud',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'order_id' => $activeOrder->id,
                ],
                 'application_fee_amount' => $applicationFee,
            ],
                ['stripe_account' => $vendor->stripe_account_id]
            );

            return response()->json(['clientSecret'=> $paymentIntent->client_secret, 'stripeConnectedAccountId'=> $vendor->stripe_account_id]);
        } catch (\Exception $e) {
            return response()->json(['error'=> $e->getMessage()], 500);
        }

    }

    /**
     * @return int
     */
    public function getApplicationFee(Order $order): int
    {
        // 3% of total order in cents by default 10 cents (fallback case)
        return $order->order_total*100*0.03 ?? 10;
    }
}
