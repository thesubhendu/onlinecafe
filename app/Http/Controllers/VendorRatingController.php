<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorRatingResource;
use App\Models\Vendor;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;

class VendorRatingController extends Controller
{
    public function __construct(public VendorRepository $vendorRepository)
    {
    }

    public function __invoke(Request $request, Vendor $vendor)
    {
        $request->validate([
            'rating'  => 'required|integer|max:5|min:1',
            'comment' => 'string',
        ]);


        return $this->sendResponse(
            [
                'rating'                =>
                    new VendorRatingResource($this->vendorRepository
                        ->rate($vendor, $request->only('rating', 'comment'))
                        ->load([
                            'author' => function ($query) {
                                return $query->select(['id', 'name']);
                            },
                        ])),
                'vendor_average_rating' => $vendor->rating(),
            ],
            'Rating Saved!'
        );

    }
}
