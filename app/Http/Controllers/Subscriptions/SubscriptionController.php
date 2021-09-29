<?php

namespace App\Http\Controllers\Subscriptions;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'not.subscribed']);
    }

    public function index(Request $request)
    {
        return view('subscriptions.checkout', [
            'intent' => $request->user()->createSetupIntent(),
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'token' => 'required',
            'plan' => 'required|exists:plans,slug'
        ]);

        $plan = Plan::where('slug', $request->get('plan', 'monthly'))
            ->first();



        $request->user()->newSubscription('subscribed', $plan->stripe_id)
            ->create($request->token);

        return back();
    }
}

