<?php


namespace App\Repositories;


use App\Models\Card;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;

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
