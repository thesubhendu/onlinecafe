<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'date' => 'datetime:d-m-Y'
    ];

    public function getFormattedDate()
    {
        return $this->date->format('d-m-Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'quantity', 'milk', 'sugar', 'syrup')->withTimestamps();
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    // public function getCard($id)
    // {
    //     $card = Card::with('stamps')
    //         ->where('user_id', Auth::id())
    //         ->where('vendor_id', $id)
    //         ->where('is_Active', true)->get();

    //     $active_card = collect([$card]);

    //     // foreach ($card_items->groupBy('id') as $card_id => $card_maxStamp) {
    //     //     dd($card_id, $card_maxStamp);
    //     //     $card = Card::find($card_id);
    //     // }

    //     // $card_items = $card->pluck('id', 'maxStamps');
    //     // dd($card_items->all());
    //     return $active_card;

    //     // return $this->$card->getCard();

    //     $card = $this->card();
    // }
}
