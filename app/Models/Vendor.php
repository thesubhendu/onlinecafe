<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
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
    }

    public function rate($rating)
    {
        $this->ratings()->create(['rating' => $rating]);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}


