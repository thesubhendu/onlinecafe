<?php

namespace App\Models;

use App\Mail\OrderConfirmed;
use App\Mail\orderSubmitted;
use App\Notifications\NewOrderNotification;
use App\Notifications\OrderConfirmedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use HasFactory, AsSource, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'order_number', 'is_confirmed', 'payment_method', 'order_total', 'user_id', 'vendor_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'date' => 'datetime:d-m-Y'
    ];

    protected $dates = ['confirmed_at'];

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
        return $this->belongsToMany(Product::class)->withPivot('price', 'quantity','options')->withTimestamps();
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function confirm()
    {
        $this->confirmed_at = now();
        $this->confirmed_by = auth()->id();
        $this->save();

        if($this->stamp_count > 0){
            $this->stampRewardCard($this);
        }

        if($this->card_id){
            $this->updateClaimedCard();
        }

        Mail::to($this->user->email)->send(new OrderConfirmed($this));
        $this->user->notify(new OrderConfirmedNotification($this));

        return $this;
    }

    public function generate($cartItems, $total, $rewardData)
    {
        $vendorId = $cartItems->first()->model->vendor_id;

        $order = new Order();
        $order->order_number = uniqid();
        $order->user_id = auth()->id();
        $order->vendor_id = $vendorId;
        $order->order_total = $total;
        $order->free_products_claimed = $rewardData['free_products_claimed'];
        $order->card_id = $rewardData['card_id'];
        $order->stamp_count = $rewardData['stamp_count'];
        $order->save();

        foreach ($cartItems as $product) {
            $order->products()->attach($product->id, [
                'price' => $product->total,
                'quantity' => $product->qty,
                'options' => json_encode($product->options)
            ]);
        }

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);

        Mail::to($order->vendor->shop_email ?? $order->vendor->email)
            ->send(new orderSubmitted($order, $confirm_url));
        $order->vendor->owner->notify(new NewOrderNotification($order));

        return $order;
    }


    // Generate Loyalty card only after order confirm
    public function stampRewardCard($order): void
    {
        $card = (new Card());
        $activeCard = $card->getOrCreateActive($order->user_id, $order->vendor_id);

        for ($i = 0; $i < $order->stamp_count; $i++) {
            $activeCard->stamps()->create(['order_id' => $order->id]);

            if ($activeCard->stamps()->count() == $order->vendor->max_stamps) {
                $activeCard->is_max_stamped = true;
                $activeCard->save();

                $activeCard = $card->getOrCreateActive($order->user_id, $order->vendor_id);
            }
        }
    }

    private function updateClaimedCard()
    {
        $card = Card::find($this->card_id);
        $card->total_claimed = $this->free_products_claimed;
        $card->save();
    }
}
