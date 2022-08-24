<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vendor_id', 'is_active', 'receiver_email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function stamps()
    {
        return $this->hasMany(Stamp::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function activeCard($id)
    {

        $card = static::where('user_id', Auth::id())
            ->where('vendor_id', $id)
            ->where('is_active', true)->first();

        if (! $card) {
            return false;
        }

        return $card;
    }

    public function getOrCreateActive($customerId, $vendorId)
    {
        return Card::query()->firstOrCreate([
            'user_id' => $customerId,
            'vendor_id' => $vendorId,
            'is_max_stamped' => false
        ]);
    }

    public static function remainingStampsOnActiveCard($vendor)
    {
        $activeCard = Card::where('vendor_id', $vendor->id)
            ->where('user_id', auth()->id())
            ->where('is_max_stamped', false)
            ->first();
        if($activeCard)
        {
            return $activeCard->vendor->max_stamps - $activeCard->stamps->count();
        }

        return $vendor->max_stamps;
    }

    public function scopeRewardable(Builder $builder)
    {
        return $builder->where([
           'is_max_stamped'=> true,
           'loyalty_claimed'=> false,
        ]);
    }

    public function isRewardable(): bool
    {
        return $this->is_max_stamped && !$this->loyalty_claimed;
    }

}
