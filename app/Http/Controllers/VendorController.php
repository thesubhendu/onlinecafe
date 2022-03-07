<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Spatie\OpeningHours\OpeningHours;

class VendorController extends Controller
{
    public function show($id)
    {
        $vendor = Vendor::where('id', $id)->firstOrFail();

        $featuredProducts = $vendor->products->take(8);

        $openingInfo = '';

        if ($vendor->opening_hours) {
            $data = collect($vendor->opening_hours)
                ->filter(fn($val, $key) => $val['is_active'])
                ->map(fn($item, $key) => [$item['from'] . '-' . $item['to']]);

            $openingHours = OpeningHours::create($data->toArray());
            $now = now();
            $range = $openingHours->currentOpenRange($now);

            if ($range) {
                $openingInfo = "Open Now. Closes at " . $range->end();
            } else {
                $openingInfo = "Closed Now. Opens at " . $openingHours->nextOpen($now)->format('l H:i A');
            }
        }

        $deals = $vendor->deals()->active()->get();

        return view('vendor', compact('vendor', 'openingInfo', 'featuredProducts','deals'));

    }

}
