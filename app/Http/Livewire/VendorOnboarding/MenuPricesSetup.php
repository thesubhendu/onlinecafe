<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Models\Product;
use App\Models\Vendor;
use Livewire\Component;

class MenuPricesSetup extends Component
{
    public $productPrices;
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
    public $form = [
        'free_product',
        'get_free',
        'max_stamps',
    ];

    public function mount(): void
    {
        $this->sizes = config('sizes');
        $this->vendor = auth()->user()->shop()->with(['products', 'productOptions'])->first();
        $this->vendorProducts = $this->vendor->products()->orderBy('name')->get()->map(function ($product) {
            $this->setupInitialProductSizesPrice($product, $this->vendor);
            return $product;
        });

        $this->form['max_stamps'] = $this->vendor->max_stamps;
        $this->form['free_product'] = $this->vendor->free_product;
        $this->form['get_free'] = $this->vendor->get_free;

        $this->vendorProductOptions = $this->vendor->productOptions()->where('charge', 1)->orderBy('name')->get();
    }

    private function setupInitialProductSizesPrice(Product $product, Vendor $vendor = null): void
    {
        $savedProduct = $vendor->products->where('name', $product->name)->first();
        if ($savedProduct && count($savedProduct->productPrices)) {
            $savedProduct->productPrices->each(function ($productPrice) use ($product) {
                $this->productPrices[$product->id][$productPrice->size] = $productPrice->price;
            });
        } else {
            foreach ($this->sizes as $size) {
                $this->productPrices[$product->id][$size] = $product->price;
            }
        }
    }

    public function submit()
    {
        $this->vendor->update([
            'free_product' => $this->form['free_product'] === '' ? null : $this->form['free_product'],
            'get_free' => $this->form['get_free'],
            'max_stamps' => $this->form['max_stamps'],
        ]);

        // Save each product size price
        $this->vendorProducts->each(function ($product) {
            if (isset($this->productPrices[$product->id])) {
                foreach ($this->productPrices[$product->id] as $key => $price) {
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

    public function applyPricesToAllProducts(): void
    {
        $firstProductSizePrice = array_values($this->productPrices)[0];

        foreach ($this->productPrices as $index => $product) {
            if($index !== key($this->productPrices))
            {
                foreach($firstProductSizePrice as $size => $sizePrice)
                {
                    if( isset($this->productPrices[$index][$size]))
                    {
                        $this->productPrices[$index][$size] = $sizePrice;
                    }
                }

            }
        }
    }

    public function applyPricesToAllOptions(): void
    {
        $firstOptionPrice = $this->vendorProductOptions->first()->price;

        $this->vendorProductOptions->map(function ($option) use($firstOptionPrice) {
            $option->price = $firstOptionPrice;
            return $option;
        });
    }

}
