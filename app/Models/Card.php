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
        $card = Card::with('stamps')
            ->where('user_id', Auth::id())
            ->where('vendor_id', $id)
            ->where('is_Active', true)->get();

        $active_card = collect([$card]);

        // foreach ($card_items->groupBy('id') as $card_id => $card_maxStamp) {
        //     dd($card_id, $card_maxStamp);
        //     $card = Card::find($card_id);
        // }

        // $card_items = $card->pluck('id', 'maxStamps');
        // dd($card_items->all());
        return $active_card;

        // return $this->$card->getCard();

        $card = $this->card();
    }

    public function stampCard()
    {
        //
    }
}
