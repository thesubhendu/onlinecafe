<?php

namespace App\Http\Controllers;

use App\Models\Card;
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
        // $user = Auth::user();
        // $cards = Card::where('user_id', $user->id);
        // return view('cards')
        //     ->with('cards', $cards)
        //     ->with('user', $user);

        $user = Auth::user();
        return view('cards')
            ->with('user', $user->cards)
            ->with('vendor');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $cards
     * @return \Illuminate\Http\Response
     */
    public function show(Card $cards)
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
