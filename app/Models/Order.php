<?php

namespace App\Models;

use App\Mail\OrderConfirmed;
use App\Notifications\OrderConfirmedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
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

        Mail::to($this->user->email)->send(new OrderConfirmed($this));
        $this->user->notify(new OrderConfirmedNotification($this));

        return $this;
    }

    public function generate($cartItems, $total)
    {
        $vendorId = $cartItems->first()->model->vendor_id;

        $order = new Order();
        $order->order_number = uniqid();
        $order->user_id = auth()->id();
        $order->vendor_id = $vendorId;
        $order->order_total = $total;
        $order->save();

        $card = (new Card());

        $activeCard = $card->getOrCreateActive(auth()->id(), $vendorId);


        foreach ($cartItems as $product) {
            $order->products()->attach($product->id, [
                'price' => $product->price,
                'quantity' => $product->qty,
                'options' => json_encode($product->options)
            ]);

            for ($i = 0; $i < $product->qty; $i++) {
                $activeCard->stamps()->create(['order_id' => $order->id, 'product_id' => $product->id]);

                if ($activeCard->stamps()->count() == $order->vendor->max_stamps) {
                    //max stamped
                    $activeCard->is_max_stamped = true;
                    $activeCard->is_active = false;
                    $activeCard->save();

                    //create another
                    $activeCard = $card->getOrCreateActive(auth()->id(), $vendorId);
                }
            }

        }

        return $order;
    }
}
