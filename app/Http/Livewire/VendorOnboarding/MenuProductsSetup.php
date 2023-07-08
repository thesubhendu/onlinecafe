<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Models\AllProduct;
use App\Models\OptionType;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class MenuProductsSetup extends Component
{
    public $productPrice;
    protected $rules = [
        'menus.*.isSelected' => 'boolean',
        'categories.*.allProducts.*.isSelected' => 'boolean',
        'options.*.isSelected' => 'boolean',
        'formData.menus.*' => 'boolean',
        'formData.options.*' => 'boolean',
    ];
    public $menus;
    public $options;
    public $categories;
    public $optionTypes;

    public $formData;

    public function mount()
    {
        //for showing grouped title only
        $this->categories =
            cache()->remember('product-categories', 5*3600 , function(){
            return ProductCategory::with('optionTypes')->pluck('name','id');
        });
        $this->optionTypes =
            cache()->remember('option-categories', 5*3600 , function(){
             return OptionType::pluck('name','id');
            });



        $vendor = auth()->user()->shop()->first();

        // construct default formdata
        $this->menus = AllProduct::orderBy('name')->get()->map(function ($product)  {
            $this->formData['products'][$product->id] = true; //constructing form data with all checked
            return $product;
        });



        $this->options = ProductOption::orderBy('name')->get()->map(function ($option) {
            $this->formData['options'][$option->id] = true; //constructing form data with all checked
            return $option;
        });

    }

    public function submit()
    {
        $vendor = auth()->user()->shop()->first();

        $selectedProducts = collect($this->formData['products'])->filter(fn($item) => $item)->keys();
        $selectedOptions = collect($this->formData['options'])->filter(fn($item) => $item)->keys();

        //Validation
        if (!$selectedProducts->count()) {
            session()->flash('error', "Please select any products to continue");
            return redirect()->route('register-business.menu-products-setup');
        }
        if (!$selectedOptions->count()) {
            session()->flash('error', "Please select any options to continue");
            return redirect()->route('register-business.menu-products-setup');
        }

        // retrieving models
        $selectedProducts = AllProduct::whereIn('id', $selectedProducts)->get();
        $selectedOptions = ProductOption::whereIn('id', $selectedOptions)->get();


        DB::transaction(function () use($vendor, $selectedProducts, $selectedOptions) {
            $vendor->products()->delete();
            $vendor->productOptions()->delete();

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
        });

        return redirect()->route('register-business.menu-prices-setup');
    }

    public function saveProductOption($option, $vendor): void
    {
       $vendor->productOptions()->updateOrCreate(['name' => $option->name],[
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
