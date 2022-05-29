<?php

namespace App\Http\Middleware;

use App\Models\Card;
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
        $card = Card::find($request->card);
        if ($card && $card->loyalty_claimed === 0
            && $card->is_max_stamped === 1
            && $card->user_id === auth()->id()
            && session()->get('claimCardId') === $card->id) {
            return $next($request);
        }

        return abort(401, 'Not eligible to claim loyalty');
    }
}
