<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class UserOrderProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'data' => [
                'orderProducts' => $this->collection->map(function ($data) {
                    return [
                        'id'           => $data->id,
                        'order_id'     => $data->order_id,
                        'vendor_id'    => $data->order->vendor->id,
                        'vendor_name'  => $data->order->vendor->name,
                        'product_id'   => $data->product_id,
                        'price'        => $data->price,
                        'quantity'     => $data->quantity,
                        'order_total'=> $data->order->order_total,
                        'options'      =>$data->options,
                        'status'=>  $data->order->status,
                        'product_name' => $data->product->name,
                    ];
                })->values()
            ]
        ];
    }

    public function with($request): array
    {
        return [
            'message' => 'Order Products retrieved successfully'
        ];
    }
}
