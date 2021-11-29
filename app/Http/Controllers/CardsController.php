<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::where('user_id', Auth::id())
            ->with('vendor')
            ->with('stamps')
            ->get();

        return view('cards')
            ->with('cards', $cards);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Card  $card
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Card $card, $id)
    {
        //
        $card = Card::where('user_id', Auth::id())
            ->where('card_id', $card->id)
            ->where('is_active', true)
            ->with('vendor')
            ->with('stamps')
            ->get();
        $card->stamp->create([
            'user_id' => Auth::id(),
            'vendor_id' => $card->vendor_id,
            'card_id' => $card->card_id,
            'order_id' => $id
        ]);
        return back();

        // $card->stamp(Card('stamp'));
    }

}
