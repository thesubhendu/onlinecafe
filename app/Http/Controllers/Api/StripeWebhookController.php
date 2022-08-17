<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
   public function __invoke(Request $request)
   {
       \Stripe\Stripe::setApiKey(config('services.stripe.api_key'));

       try {
           $event = \Stripe\Event::constructFrom($request->all());
       } catch(\UnexpectedValueException $e) {
           // Invalid payload
           abort(400);
       }

       // Handle the event
       switch ($event->type) {
           case 'payment_intent.succeeded':
               $eventData = $event->data->object;
               $orderId = $eventData->metadata?->order_id;
               if($orderId){
                   $order = Order::find($orderId);
                   if($order){
                       $order->is_paid= true;
                       $order->save();
                   }
               }
               break;
           case 'account.updated':
               $eventData = $event->data->object;

               $accountId = $eventData->id;
               $vendor = Vendor::where('stripe_account_id', $accountId)->first();
               if($vendor && is_null($vendor->charges_enabled_at) && $eventData->charges_enabled === true){
                  $vendor->charges_enabled_at = now();
                  $vendor->save();
               }
               break;
           default:
               echo 'Received unknown event type ' . $event->type;
       }

       return response('success');
   }
}
