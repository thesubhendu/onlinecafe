<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stamp extends Model
{
    use HasFactory;

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
