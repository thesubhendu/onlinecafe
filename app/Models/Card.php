<?php

namespace App\Models;

use App\Models\User;
use App\Models\Stamp;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vendor_id', 'maxStamps', 'is_Active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function stamps()
    {
        return $this->hasMany(Stamp::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function activeCard($id)
    {

        $card = static::where('user_id', Auth::id())
            ->where('vendor_id', $id)
            ->where('is_Active', true)->first();

        if ($card) {
            return $card;
        }

        return false;
    }

    public function create()
    {
        //
    }


    public function stampCard()
    {
        //
    }
}
