<?php


namespace App\Repositories;


use App\Models\Vendor;
use Spatie\OpeningHours\OpeningHours;

class VendorRepository
{
    public function __construct(
        public Vendor $vendor
    ) {
    }

    public function getAll()
    {
        return $this->vendor::with('ratings','freeCategory','products')
            ->subscribed()
            ->get();
    }

    public function getOpeningInfo($vendor): ?string
    {
        if ($vendor->opening_hours) {
            $data = collect($vendor->opening_hours)
                ->filter(fn($val, $key) => $val['is_active'])
                ->map(fn($item, $key) => [$item['from'].'-'.$item['to']]);

            $openingHours = OpeningHours::create($data->toArray());
            $now = now();
            $range = $openingHours->currentOpenRange($now);

            if ($range) {
                return "Open Now. Closes at ".$range->end();
            }

            return "Closed Now. Opens at ".$openingHours->nextOpen($now)->format('l H:i A');
        }

        return null;
    }

}
