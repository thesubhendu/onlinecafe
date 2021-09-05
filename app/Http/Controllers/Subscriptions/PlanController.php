<?php

namespace App\Http\Controllers\Subscriptions;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::get();
        return view('subscriptions.plans', compact('plans'));
    }
}
