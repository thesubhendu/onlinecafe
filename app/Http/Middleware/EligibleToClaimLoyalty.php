<?php

namespace App\Http\Middleware;

use App\Services\RewardClaimService;
use Closure;
use Illuminate\Http\Request;

class EligibleToClaimLoyalty
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ((new RewardClaimService())->verifiedLoyaltyCard($request->card)) {
            return $next($request);
        }

        return abort(401, 'Not eligible to claim loyalty');
    }
}
