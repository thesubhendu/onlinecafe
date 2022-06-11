<?php


namespace App\Repositories;


use App\Models\Vendor;

class SearchRepository
{

    public function get($searchTerm)
    {
        return Vendor::where(function ($query) use ($searchTerm) {
            $query->where('vendor_name', 'like', '%'.$searchTerm.'%')
                ->orWhere('address', 'LIKE', "%".$searchTerm."%")
                ->orWhere('shop_name', 'LIKE', "%".$searchTerm."%");

        })
            ->orWhere(function ($query) use ($searchTerm) {
                return $query->whereRelation('products', "name", 'like', '%'.$searchTerm.'%');
            })
            ->paginate(6);
    }

}
