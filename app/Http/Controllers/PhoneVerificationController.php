<?php

namespace App\Http\Controllers;

use App\Notifications\PhoneVerificationCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhoneVerificationController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function send(Request $request)
    {
        $code = cache()->remember(auth()->id().'-phone-verification-code', 300, function () {
            return Str::random(5);
        });

        auth()->user()->notify(new PhoneVerificationCodeNotification($code));

        return back()->withMessage('Verification code sent');
    }


    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $cachedCode = cache()->get(auth()->id().'-phone-verification-code');

        if ($cachedCode != $request->code) {
            abort(401, "Code does not match");
        }

        $user                    = auth()->user();
        $user->phone_verified_at = now();
        $user->save();

        return redirect()->route('home')->withMessage('Phone Verified');

    }


}
