<?php


namespace App\Services;


use App\Models\Card;

class RewardService
{

    public $discount;
    public $stampCount;
    public $freeProductsClaimed;
    public $lowestPriceProduct;

    public $stampableProducts;
    /**
     * @param $items
     * @return array
     */

    function __construct($products)
    {
        $this->stampableProducts = $this->stampableProducts($products);

        if($this->stampableProducts->isNotEmpty()) {
            $this->handle();
        }
    }
    private function calculate($stampCount, $freeProduct)
    {
        $this->stampCount = $stampCount;
        $this->freeProductsClaimed = $freeProduct;
        $this->discount = $this->discountPercent();

        return true;
    }
    private function handle()
    {
//            $freeProductsToClaim = auth()->user()->remainingClaims();
//            $stampsToCompleteCard = auth()->user()->remainingStampsOnActiveCard();
//        $remainingFreeProductClaims = 2;

        $this->lowestPriceProduct = $this->stampableProducts->sortBy('price')->first();

        $vendor = $this->lowestPriceProduct->model->vendor;
        $stampsToCompleteCard = Card::remainingStampsOnActiveCard($vendor);
        $totalPurchaseQty = $this->stampableProducts->sum('qty');

        //is purchase enough for auto free reward
        if($totalPurchaseQty <= $stampsToCompleteCard){
            return $this->calculate($totalPurchaseQty,0);
        }

        $extraQtyAfterStamps = $totalPurchaseQty - $stampsToCompleteCard;


        $vendorOfferedFreeQty = $vendor->get_free;

        if($extraQtyAfterStamps <=  $vendorOfferedFreeQty) {
            return $this->calculate(0, $extraQtyAfterStamps);
        }
        $stamps = $extraQtyAfterStamps - $vendorOfferedFreeQty;


        if ($vendorOfferedFreeQty >= $this->lowestPriceProduct->qty) {
            $finalFreeQty = $this->lowestPriceProduct->qty;
        } else {
            $finalFreeQty = $vendorOfferedFreeQty;
        }

        return $this->calculate($stamps, $finalFreeQty);
    }

    /**
     * @param $items
     * @return mixed
     */
    private function stampableProducts($items)
    {
        $stampableProducts = $items->filter(function ($product) {
            $model = $product->model;
            return $model->category_id == $model->vendor->free_category;
        });

        return $stampableProducts;
    }


    /**
     * geting discount percent
     * @param mixed $finalFreeQty
     * @param $lowestPriceProduct
     * @param mixed $stampableProducts
     */
    private function discountPercent(): float
    {
        $price = $this->lowestPriceProduct->price;

        $priceToReduce = $price* $this->freeProductsClaimed;

        $total = $price * $this->lowestPriceProduct->qty;

        if($total == 0) {
            return 0;
        }
        return ($priceToReduce / $total) * 100;
    }


}
