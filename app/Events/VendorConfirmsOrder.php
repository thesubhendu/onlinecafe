<?php

namespace App\Events;

use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VendorConfirmsOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vendor;
    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor, Order $order, User $user)
    {
        $this->$user = $user;
        $this->$vendor = $vendor;
        $this->$order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
