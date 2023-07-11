<?php

namespace App\Services;

use App\Models\OptionType;
use App\Models\Product;

class CalculateProductTotal
{

    public array $redableOptions;
    public float $totalPrice = 0;

    public function __construct(Product $product, array $productOptions)
    {

        $sizeId = $productOptions['selected_size_id'];
        $selectedOptions = $productOptions['selected_extras'];

        $size = $product->productPrices()->find($sizeId);

        if(!empty($size->price)){
            $this->totalPrice = $size->price;
        }else{
            $this->totalPrice = $product->price;
        }

        $this->redableOptions['extra']['size'] = $size->size;

        //sum of options
        foreach ($selectedOptions as $optionTypeId => $optionsId){

            $optType = OptionType::find($optionTypeId);

            $optionsName = [];
            //For multiple options select
            if(is_array($optionsId)){
                foreach ($optionsId as $optId){
                        $selectedOption = $product->vendor->productOptions()->find($optId);
                        $this->totalPrice += $selectedOption->price ?? 0;
                        $optionsName[] = $selectedOption->name;
                }

                $this->redableOptions['extra'][$optType->name] = implode(', ', $optionsName);

            }else{
                $selectedOption = $product->vendor->productOptions()->find($optionsId);
                $this->totalPrice += $selectedOption->price ?? 0;
                $this->redableOptions['extra'][$optType->name] = $selectedOption->name;
            }

        }

    }
}
