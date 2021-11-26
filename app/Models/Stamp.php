<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function getStamps($id)
    {
        $stamp_count = Stamp::where('card_id', $id)->count();

        return $this->$stamp_count;
    }

    public static function stampBalance($id)
    {
        $stamp_count = static::where('card_id', $id)->count();

        return $stamp_count;
    }
}
