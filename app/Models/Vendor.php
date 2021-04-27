<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
        if($rating > 5 || $rating < 1){
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
}


