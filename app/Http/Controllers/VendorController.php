<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Spatie\OpeningHours\OpeningHours;

class VendorController extends Controller
{
    public function show($id)
    {
        $vendor = Vendor::where('id', $id)->firstOrFail();

        if ($vendor->opening_hours) {
            $data = collect($vendor->opening_hours)
                ->filter(fn($val, $key) => $val['is_active'])
                ->map(fn($item, $key) => [$item['from'].'-'.$item['to']]);

            $openingHours = OpeningHours::create($data->toArray());
            $now          = now();
            $range        = $openingHours->currentOpenRange($now);

            if ($range) {
                $openingInfo = "Open Now. Closes at ".$range->end();
            } else {
                $openingInfo = "Closed Now. Opens at ".$openingHours->nextOpen($now)->format('l H:i');
            }
        }

        return view('vendor')
            ->with('vendor', $vendor)
            ->with('openingInfo', $openingInfo ?? '')
            ->with('products');
    }

}
