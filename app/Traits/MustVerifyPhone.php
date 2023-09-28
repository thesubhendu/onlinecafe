<?php


namespace App\Traits;


use App\Services\PhoneVerification;

trait MustVerifyPhone
{
    /**
     * Determine if the user has verified their phone address.
     *
     * @return bool
     */
    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    /**
     * Mark the given user's phone as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => now(),
        ])->save();
    }

    /**
     * Send the phone verification notification.
     *
     * @return void
     */
    public function sendPhoneVerificationNotification()
    {
        (new PhoneVerification())->sendCode($this);
    }

    /**
     * Get the phone address that should be used for verification.
     *
     * @return string
     */

    public function routeNotificationForVonage($notification)
    {
        return $this->mobile;
    }
}

