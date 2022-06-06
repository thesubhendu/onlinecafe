<?php


namespace App\Services;


class RewardService
{

    /**
     * @param $items
     * @return array
     */
    public function freeItemsCount($stampableProducts)
    {
//            $freeProductsToClaim = auth()->user()->remainingClaims();
//            $stampsToCompleteCard = auth()->user()->remainingStampsOnActiveCard();
        $remainingFreeProductClaims = 2;
        $stampsToCompleteCard = 3;

        $lowestPriceProduct = $stampableProducts->sortBy('price')->first();

        $totalPurchaseQty = $stampableProducts->sum('qty');

        //is purchase enough for auto free reward
        if($totalPurchaseQty < $stampsToCompleteCard){
            return ['stamp_count'=> $totalPurchaseQty, 'free_products_claimed'=>0];
        }

        $extraQtyAfterStamps = $totalPurchaseQty - $stampsToCompleteCard;


        $vendor = $lowestPriceProduct->model->vendor;

        $vendorOfferedFreeQty = $vendor->get_free;

        if($extraQtyAfterStamps <=  $vendorOfferedFreeQty) {
            return ['stamp_count'=> 0, 'free_products_claimed'=>$extraQtyAfterStamps];
        }

        $stamps = $extraQtyAfterStamps - $vendorOfferedFreeQty;


        if ($vendorOfferedFreeQty >= $lowestPriceProduct->qty) {
            $finalFreeQty = $lowestPriceProduct->qty;
        } else {
            $finalFreeQty = $vendorOfferedFreeQty;
        }

        return ['stamp_count'=> $stamps, 'free_products_claimed'=> $finalFreeQty];
    }

    /**
     * @param $items
     * @return mixed
     */
    public function stampableProducts($items)
    {
        $stampableProducts = $items->filter(function ($product) {
            $model = $product->model;
            return $model->category_id == $model->vendor->free_category;
        });
        return $stampableProducts;
    }

    public function lowestPriceProduct($products)
    {
        return $products->sortBy('price')->first();
    }




}
