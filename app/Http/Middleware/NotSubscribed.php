<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->subscribed('subscribed')) {
            return redirect()->route('account.subscriptions');
        }
        return $next($request);
    }
}
