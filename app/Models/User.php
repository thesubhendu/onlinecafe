<?php

namespace App\Models;

use BeyondCode\Vouchers\Traits\CanRedeemVouchers;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Orchid\Platform\Models\User as Authenticatable;


class User extends Authenticatable
//    implements MustVerifyEmail,MustVerifyPhone
{
    use HasFactory;
    use HasApiTokens;
    use HasProfilePhoto, Favoriteability, CanRedeemVouchers;
    use Notifiable, Billable, \App\Traits\MustVerifyPhone;
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
        'permissions',
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
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions'       => 'array',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
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

    public function earnedRewards()
    {
        return Card::query()->where(['user_id' => $this->id, 'is_active' => false, 'is_max_stamped' => false])->get();
    }

    public function isVendor()
    {
        return  Gate::allows('vendor');
    }

    public function isAdmin()
    {
        return  Gate::allows('admin');
    }

    public function makeShopActive()
    {
        if($this->hasVerifiedPhone() && $this->hasVerifiedEmail()){
            $this->shop->update(['is_active'=> 1]);
        }
    }
}
