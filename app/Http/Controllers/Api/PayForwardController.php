<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\FreeCoffeeGiftMail;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PayForwardController extends Controller
{
    public function sendGift(Card $card, Request $request)
    {
        $request->validate([
            'email'=>'required|email'
        ]);

        $email = $request->email;
        if(!$card->isRewardable()){
            return response()->json([
                'message'=>'Not eligible to pay forward!',
            ]);
        }
        $card->update(['receiver_email' => $email]);

        Mail::to($email)->send(new FreeCoffeeGiftMail($card->user));

        return response()->json([
            'message'=>'Reward gifted successfully!',
            'data'=> $request->all()
        ]);
    }

    public function accept(Card $card)
    {
        $card->update([
            'user_id'=> auth()->id(),
            'receiver_email'=> null,
        ]);

        return response()->json([
            'message'=>'Gift accepted!',
        ]);
    }
    public function reject(Card $card)
    {
        $card->update([
            'receiver_email'=> null,
        ]);

        return response()->json([
            'message'=>'Success!',
        ]);
    }
}
