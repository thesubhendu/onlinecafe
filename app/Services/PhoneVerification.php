<?php


namespace App\Services;


use App\Exceptions\VerificationCodeNotMatchedException;
use App\Notifications\PhoneVerificationCodeNotification;
use Illuminate\Support\Str;

class PhoneVerification
{

    public function sendCode($model)
    {
        $code = cache()->remember(auth()->id().'-phone-verification-code', 300, function () {
            return Str::random(5);
        });

        try {
            $model->notify(new PhoneVerificationCodeNotification($code));

        } catch (\Exception $e) {

            logger()->info($e->getMessage());
        }


    }

    public function getCode($user)
    {
       return cache()->get(auth()->id().'-phone-verification-code');

    }
    public function verify($model, $code)
    {
        $cachedCode = cache()->get($model->id.'-phone-verification-code');

        if ($cachedCode != $code) {
            throw new VerificationCodeNotMatchedException("Code does not match");
        }else {
            $model->markPhoneAsVerified();
            $model->makeShopActive();
        }

    }
}
