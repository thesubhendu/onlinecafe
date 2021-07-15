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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getCard($id)
    {
        // $card = Card::with('stamps')
        //     ->where('user_id', Auth::id())
        //     ->where('vendor_id', $id)
        //     ->where('is_Active', true)->get();

        // $active_card = collect([$card]);

        // return $this->$active_card($card)->all();

        // return (new static)::with('stamps')
        //     ->where('user_id', Auth::id())
        //     ->where('vendor_id', $id)
        //     ->where('is_Active', true)->first();

        $get_card = Card::with('stamps')
            ->where('user_id', Auth::id())
            ->where('vendor_id', $id)
            ->where('is_Active', true)->first();
        $card = collect([
            'id' => $get_card->id,
            'maxStamps' => $get_card->maxStamps
        ]);

        $active_card = $card->mapWithKeys(function ($card_items) {
            return [$card_items['id'] => $card_items['maxStamps']];
        });

        $active_card->all();
    }


    public function stampCard()
    {
        //
    }
}
