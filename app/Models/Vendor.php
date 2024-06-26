<?php

namespace App\Models;

use App\Services\GeoLocationService;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\OpeningHours\OpeningHours;


class Vendor extends Model
{
    use HasFactory, Favoriteable;

    protected $guarded = ['owner_id'];
    protected $casts = [
        'opening_hours' => 'array',
        'services' => 'array',
        'is_taking_orders' => 'boolean'
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
    }

    public function activeProducts()
    {
        return $this->hasMany(Product::class)->where('is_active', true);
    }

    public function productOptions()
    {
        return $this->hasMany(VendorProductOption::class);
    }

    public function freeCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'free_category', 'id');
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
        return $this->ratings->avg('rating') > 5 ? 5 : (int)$this->ratings->avg('rating');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function getIsOpenAttribute()
    {

        if($this->is_taking_orders == false){
            return false;
        }

        if ($this->opening_hours) {
            $data = collect($this->opening_hours)
                ->filter(fn($val, $key) => $val['is_active'])
                ->map(fn($item, $key) => [$item['from'].'-'.$item['to']]);

            $openingHours = OpeningHours::create($data->toArray());
            $now          = now();
            $range = $openingHours->currentOpenRange($now);

            if ($range) {
                return true;
            }

            return false;
        }

        return true;
    }


    public function nearbyShops($lat, $lon, $radius = 10)
    {
//        replace 6371000 with 6371 for kilometer and 3956 for miles
        $nearbyVendors = Vendor::subscribed()->selectRaw("id, vendor_name,shop_name, address, lat, lng,
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

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function getDistanceFromCustomer($customerLocation)
    {
        $latFrom = $customerLocation->lat ;
        $lngFrom = $customerLocation->lon ;

        $latTo = $this->lat;
        $lngTo = $this->lng;

        if(is_null($latTo) || is_null($lngTo) || empty($customerLocation)) {
            return null;
        }

        return round((new GeoLocationService())->haversineGreatCircleDistance($latFrom,$lngFrom, $latTo,$lngTo));
    }

    public function scopeSubscribed($query)
    {
        return $query->where('is_subscribed', '1');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    }

    public function freeCategoryProducts(): Collection
    {
        return $this->products()->where('category_id', $this->free_category)->get();
    }

    public function getIsFavoriteAttribute(): bool
    {
        return $this->isFavorited();
    }

    public function scopePopular($query)
    {
       return $query->withCount('orders')->orderByDesc('orders_count');
    }

    public function scopeTopRated($query)
    {
       return $query->withCount('ratings')->orderByDesc('ratings_count');
    }

    public function scopeNearBy($query, $location)
    {
        $lat = floatval($location->lat);
        $lng = floatval($location->lon);
        $radius = 15;
        $distance = \DB::raw("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance");
        return $query->select($distance)->orderBy('distance')->having('distance', '<=', $radius);
    }
    public function userRewardsQuery(User $user)
    {
        return $user->cards()->where('vendor_id',$this->id)->rewardable();
    }

    public function isRewardAvailable(User $user) : bool
    {
        return (bool)$this->userRewardsQuery($user)->count();
    }

    /*
     * Generate setup code for vendor
     * using this they can claim their business easily (helps during registration)
     */
    private function generateSetupCode()
    {
        //generate unique code
        $code = \Str::random(10);
        $this->vendor_setup_code = $code;
        $this->save();
        return $code;
    }

    public function getBusinessClaimLink()
    {
        return route('register-business.create', ['code' => $this->generateSetupCode()]);

    }
}
