<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductResource
     */
    public function show(Product $product)
    {
       return new ProductResource($product);
    }

}
