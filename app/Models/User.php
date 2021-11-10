<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class User extends \Illuminate\Foundation\Auth\User implements MustVerifyEmail
{
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable, Billable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function shop()
    {
        return $this->hasOne(Vendor::class, 'owner_id');
    }

    public function plan()
    {
        return $this->hasOneThrough(
            Plan::class,
            Subscription::class,
            'user_id',
            'stripe_id',
            'id',
            'stripe_price'
        );
    }

    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    public function routeNotificationForNexmo($notification)
    {
        return $this->mobile;
    }
}
