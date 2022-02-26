<?php

namespace App\Models;

use BeyondCode\Vouchers\Traits\HasVouchers;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\OpeningHours\OpeningHours;

class Vendor extends Model
{
    use HasFactory, Favoriteable, HasVouchers;

    protected $guarded = ['owner_id'];
    protected $casts = [
        'opening_hours' => 'array',
        'services' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
        // $this->products()->create(['' => $product]); refer to rating function below
    }

    public function productOptions()
    {
        return $this->hasMany(VendorProductOption::class);
    }

    public function rate($rating, $user = null, $comment = null)
    {
        if ($rating > 5 || $rating < 1) {
            throw new \InvalidArgumentException('Rating must be between 1-5.');
        }

        $this
            ->ratings()
            ->updateOrCreate([
                'user_id' => $user ? $user->id : auth()->id(),
            ], compact('rating', 'comment'));

    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function rating()
    {
        return $this->ratings->avg('rating') > 5 ? 5 : $this->ratings->avg('rating');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function getIsOpenAttribute()
    {
        if ($this->opening_hours) {
            $data = collect($this->opening_hours)
                ->filter(fn($val, $key) => $val['is_active'])
                ->map(fn($item, $key) => [$item['from'].'-'.$item['to']]);

            $openingHours = OpeningHours::create($data->toArray());
            $now          = now();
            $range = $openingHours->currentOpenRange($now);

            if ($range) {
                return true;
//                $openingInfo = "Open Now. Closes at ".$range->end();
            }

            return false;
        }
    }


    public function nearbyShops($lat, $lon, $radius = 10)
    {
//        dd($lat, $lon);
//        replace 6371000 with 6371 for kilometer and 3956 for miles
        $nearbyVendors = Vendor::selectRaw("id, vendor_name,shop_name, address, lat, lng,
                     ( 6371 * acos( cos( radians(?) ) *
                       cos( radians( lat ) )
                       * cos( radians( lng ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( lat ) ) )
                     ) AS distance", [$lat, $lon, $lat])
            ->having("distance", "<=", $radius)
            ->orderBy("distance", 'asc')
            ->limit(20)
            ->get();

        return $nearbyVendors;
    }

    public function getNameAttribute()
    {
        return $this->shop_name ?? $this->vendor_name;
    }
}
