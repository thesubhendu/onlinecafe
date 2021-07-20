<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use App\Models\Stamp;
use Illuminate\Http\Request;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $cards
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $cards)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $cards
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $cards)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $cards
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $cards)
    {
        //
    }
}
