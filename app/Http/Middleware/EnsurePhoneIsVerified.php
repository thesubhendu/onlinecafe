<?php

namespace App\Http\Middleware;

use App\Contracts\MustVerifyPhone;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsurePhoneIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $redirectToRoute=null)
    {
        if (! $request->user() ||
            (
                $request->user() instanceof MustVerifyPhone &&
                ! $request->user()->hasVerifiedPhone())) {
            return $request->expectsJson()
                ? abort(403, 'Your phone is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'phone-verification.notice'));
        }

        return $next($request);

    }
}
