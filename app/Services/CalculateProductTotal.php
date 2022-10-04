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
        $this->totalPrice = $product->price;

        $sizeId = $productOptions['selected_size_id'];
        $selectedOptions = $productOptions['selected_extras'];

        $size = $product->productPrices()->find($sizeId);

        $this->totalPrice += $size->price ?? 0;


        $this->redableOptions['extra']['size'] = $size->size;

        //sum of options
        foreach ($selectedOptions as $optionTypeId => $optionsId){
            $optType = OptionType::find($optionTypeId);
            $selectedOption = $product->vendor->productOptions()->find($optionsId);
            $this->totalPrice += $selectedOption->price ?? 0;
            $this->redableOptions['extra'][$optType->name] = $selectedOption->name;
        }

    }
}
