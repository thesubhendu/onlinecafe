<?php


namespace App\Repositories;


use App\Models\Card;
use App\Models\User;

class RewardRepository
{

    public function rewards(User $customer)
    {
        return Card::query()->with('vendor', 'stamps')
            ->where(['user_id' => $customer->id, 'receiver_email' => null])
            ->orWhere('receiver_email', $customer->email)
            ->get();
    }
}
