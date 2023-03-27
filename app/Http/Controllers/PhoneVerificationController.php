<?php

namespace App\Http\Controllers;

use App\Exceptions\VerificationCodeNotMatchedException;
use App\Services\PhoneVerification;
use Illuminate\Http\Request;

class PhoneVerificationController extends Controller
{
    /**
     * @var PhoneVerification
     */
    private PhoneVerification $phoneVerification;

    function __construct(PhoneVerification $phoneVerification)
    {
        $this->middleware('auth');
        $this->phoneVerification = $phoneVerification;
    }

    public function send(Request $request)
    {
        (new PhoneVerification())->sendCode($request->user());

        return back()->withMessage('Verification code sent');
    }


    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        try {
            $this->phoneVerification->verify($request->user(), $request->code);
        } catch (VerificationCodeNotMatchedException $e) {
            return back()->withErrors("Code does not match");
        }

        return redirect()->route('home')->withMessage('Phone Verified');

    }


}
