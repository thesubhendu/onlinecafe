<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionSwapController extends Controller
{
    public function index(Request $request) {

        // dd($request->user()->plan);

        $free = 'free';
        $plans = Plan::where('slug', '!=', $request->user()->plan->slug)->
            where('slug', '!=', 'free')->get();


        return view('account.subscriptions.swap', compact('plans'));
    }

    function store(Request $request) {


        $this->validate($request, [
            'plan' => 'required|exists:plans,slug'
        ]);

        $request->user()->subscription('subscribed')
            ->swap(Plan::where('slug', $request->plan)->first()->stripe_id);

        return    redirect()->route('account.subscriptions');


    }
}
