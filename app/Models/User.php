<?php

namespace App\Models;

use App\Traits\MustVerifyPhone;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements FilamentUser
//    implements MustVerifyEmail,MustVerifyPhone
{
    use HasFactory;
    use HasApiTokens;
    use Favoriteability;
    use HasProfilePhoto;
    use MustVerifyPhone;
    use Billable;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

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
        'email_verified_at' => 'datetime'
    ];

    public function canAccessPanel(Panel $panel):bool
    {
        return $this->hasAnyRole('super_admin','vendor'); //todo in production only allow user with superadmin role to access it.
    }

    public function canImpersonate():bool
    {
        return true;
    }

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

    public function isVendor()
    {
        return  (bool) $this->shop;
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

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function shippingAddress(): HasOne
    {
        return $this->hasOne(ShippingAddress::class);
    }
}
