<?php

namespace App\Models;

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
            'is_active' => true
        ]);
    }


}
