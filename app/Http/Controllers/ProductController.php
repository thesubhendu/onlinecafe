<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Vendor;

class ProductController extends Controller
{
    public function vendorProducts(Vendor $vendor)
    {
        return view('products', [
            'deals'          => $vendor->deals,
            'vendorProducts' => $vendor->products,
        ]);
    }

    public function vendorLoyaltyProducts(Vendor $vendor, Card $card)
    {
        if($card->eligibleClaimLoyalty() ){
            return view('vendorLoyaltyProducts', [
                'vendorProducts' => $vendor->products()->where('category_id', $vendor->free_category)->get(),
                'card'=> $card
            ]);
        }

        return abort(404);
    }

}
