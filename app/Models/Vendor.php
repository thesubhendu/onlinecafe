<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = ['owner_id'];
    protected $casts = [
        'opening_hours' => 'array',
    ];

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
        // $this->products()->create(['' => $product]); refer to rating function below
    }

    public function rate($rating, $user = null)
    {
        if ($rating > 5 || $rating < 1) {
            throw new \InvalidArgumentException('Rating must be between 1-5.');
        }

        $this
            ->ratings()
            ->updateOrCreate([
                'user_id' => $user ? $user->id : auth()->id(),
            ], compact('rating'));

        // $this->ratings()->create(['rating' => $rating]);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function rating()
    {
        return $this->ratings->avg('rating');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
