<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Models\AllProduct;
use App\Models\ProductOption;
use Livewire\Component;

class MenuProductsSetup extends Component
{
    public $productPrice;
    protected $rules = [
        'menus.*.isSelected' => 'boolean',
        'options.*.isSelected' => 'boolean',
    ];
    public $menus;
    public $options;

    public function mount()
    {
        $vendor = auth()->user()->shop()->first();
        if($vendor->products()->exists())
        {
            return redirect()->route('vendor.show', $vendor->id);
        }
        $this->menus = AllProduct::orderBy('name')->get()->map(function ($product)  {
            $product->isSelected = true;

            return $product;
        });

        $this->options = ProductOption::where('charge', 1)->orderBy('name')->get()->map(function ($option) {
            $option->isSelected = true;

            return $option;
        });
    }

    public function submit()
    {
        $vendor = auth()->user()->shop()->first();

        $selectedProducts = $this->menus->filter(fn($item) => $item->isSelected);
        if (!$selectedProducts->count()) {
            session()->flash('error', "Please select any products to continue");
            return redirect()->route('register-business.menu-products-setup');
        }

        $selectedOptions = $this->options->filter(fn($item) => $item->isSelected);
        if (!$selectedOptions->count()) {
            session()->flash('error', "Please select any options to continue");
            return redirect()->route('register-business.menu-products-setup');
        }

        $vendor->update(['free_product' => null]);

        foreach ($selectedProducts as $menu) {
            $vendor->products()->updateOrCreate(['name' => $menu->name],
                [
                    'description' => $menu->description ?? 'dummy description',
                    'product_image' => $menu->image,
                    'price' => $menu->price,
                    'is_stamp' => 1,
                    'category_id' => $menu->category_id,
                    'is_all_sizes_available' => 1
                ]);
        }

        foreach ($selectedOptions as $option) {
            $this->saveProductOption($option, $vendor);
        }

        ProductOption::zeroChargeProductOptions()->get()->each(function ($option) use ($vendor) {
            $this->saveProductOption($option, $vendor);
        });

        return redirect()->route('register-business.menu-prices-setup');
    }

    public function saveProductOption($option, $vendor): void
    {
        $vendor->productOptions()->create([
            'name' => $option->name,
            'price' => $option->price,
            'option_type_id' => $option->option_type_id,
            'charge' => $option->charge,
            'default_option' => $option->default_option
        ]);
    }

    public function render()
    {
        return view('livewire.vendor-onboarding.menu-products-setup');
    }
}
