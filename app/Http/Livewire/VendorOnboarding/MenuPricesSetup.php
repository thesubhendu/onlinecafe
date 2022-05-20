<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Models\Product;
use App\Models\Vendor;
use Livewire\Component;

class MenuPricesSetup extends Component
{
    public $productPrice;
    public $productOptionPrice;
    protected $rules = [
        'menus.*.isSelected' => 'boolean',
        'options.*.isSelected' => 'boolean',
        'vendorProductOptions.*.price' => 'required|decimal'
    ];
    public $vendorProducts;
    public $vendorProductOptions;
    public $vendor;
    public $sizes;

    public function mount(): void
    {
        $this->sizes = config('sizes');
        $this->vendor = auth()->user()->shop()->with(['products', 'productOptions'])->first();
        $this->vendorProducts = $this->vendor->products()->orderBy('name')->get()->map(function ($product) {
            $this->setupInitialProductSizesPrice($product, $this->vendor);
            return $product;
        });

        $this->vendorProductOptions = $this->vendor->productOptions()->where('charge', 1)->orderBy('name')->get();
    }

    private function setupInitialProductSizesPrice(Product $product, Vendor $vendor = null): void
    {
        $savedProduct = $vendor->products->where('name', $product->name)->first();
        if ($savedProduct && count($savedProduct->productPrices)) {
            $savedProduct->productPrices->each(function ($productPrice) use ($product) {
                $this->productPrice[$product->id][$productPrice->size] = $productPrice->price;
            });
        } else {
            foreach ($this->sizes as $size) {
                $this->productPrice[$product->id][$size] = $product->price;
            }
        }
    }

    public function submit()
    {
        // Save each product size price
        $this->vendorProducts->each(function ($product) {
            if (isset($this->productPrice[$product->id])) {
                foreach ($this->productPrice[$product->id] as $key => $price) {
                    $product->productPrices()->updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'size' => $key
                        ],
                        [
                            'price' => $price,
                        ]);
                }
            }
        });

        // Update Option Prices
        foreach ($this->vendorProductOptions as $option) {
            $this->vendor->productOptions()->updateOrCreate(['name' => $option->name], [
                'price' => $option->price,
            ]);
        }

        return redirect()->route('vendor.show', $this->vendor->id);
    }

    public function render()
    {
        return view('livewire.vendor-onboarding.menu-prices-setup');
    }

}
