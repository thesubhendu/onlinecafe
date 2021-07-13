<?php

namespace App\Models;

use App\Models\User;
use App\Models\Stamp;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

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

    public static function activeCard($id)
    {
        $card = Card::where('user_id', Auth::id())
            ->where('vendor_id', $id)
            ->where('is_Active', true)
            ->get();
        return $card;


        // $card = Card::where('user_id', Auth::id())
        //     ->where('vendor_id', $id)
        //     ->where('is_Active', true)
        //     ->get();
        // return $card->id->value();

        // return static::where('user_id', Auth::id())
        //     ->where('vendor_id', $id)
        //     ->where('is_active', true)
        //     ->get();



        // $card = collect(
        //     [
        //         'user_id', Auth::id(),
        //         'vendor_id', $id,
        //         'is_Active', true
        //     ]
        // )
        //     ->map(function ($card) {
        //     })->reject(function ($is_Active) {
        //         return empty($is_Active);
        //     });

        // return $this->vendor->contains('vendor_id', $id->id);



    }
}
