<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\VendorProductOption;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;

    public $cartProduct;
    /**
     * @var mixed
     */
    public $selectSize;

    public $vendorOptionsExist;



    public function render()
    {
        return view('livewire.add-to-cart');
    }

    public function mount(Product $product)
    {
        $this->product     = $product->load('productPrices');
        $this->cartProduct = [
            'id'      => $product->id,
            'name'    => $product->name,
            'price'   => $product->price,
            'weight'  => '0',
            'qty'     => 1,
            'options' => [],
        ];
        if($this->product->productPrices->count()){
            $this->selectSize = 'S';
            $this->cartProduct['price'] = $this->product->productPrices()->where('size', 'S')->first()->price ?? $product->price;
        }
        $this->vendorOptionsExist = VendorProductOption::where('vendor_id', $product->vendor_id)->count();

    }

    public function submit()
    {
        $dealId = session('deal-'.$this->product->vendor_id) ?? null;

        if ((auth()->id() == $this->product->vendor->owner_id) && empty($dealId)) {
            session()->flash('error', 'You cannot order from your own shop');
            return;
        }

        $this->validate();

        //only allowing order from one vendor
        if ($existingItem = Cart::content()->first()) {
            if ($existingItem->model->vendor_id != $this->product->vendor_id) {
                Cart::destroy();
//                session()->flash('message', 'Previous Item in cart from other vendor cleared');
            }
        }

        if(!empty($this->cartProduct['options'])) {
            collect($this->cartProduct['options'])->map(function ($option, $optionTypeId) {
                $option = json_decode($option, false);
                // Recreate cart Product options
                $this->cartProduct['options'][$optionTypeId] =
                    $this->product->optionTypes()->where('id', $optionTypeId)->first()->name . ': ' . $option->name;
            });
        }

        if($this->selectSize){
            $this->cartProduct['options'][] =  "Size: $this->selectSize" ;
        }

        $this->selectSize = 'S';

        Cart::add($this->cartProduct)->associate(Product::class);


        if(Gate::allows('vendor') && $dealId) {
            return redirect()->route('save-deal', $dealId);
        }

        return redirect()->route('checkout.index');
    }

    protected function rules()
    {
        $rules = [
            'cartProduct.qty' => 'required|numeric',
        ];
        // foreach ($this->product->options() as $option) {
        //     $rules['cartProduct.options.'.$option->id] = 'required';
        // }

        return $rules;
    }

    // protected function messages()
    // {
    //     foreach ($this->product->options() as $option) {
    //         $messages['cartProduct.options.' . $option->id . '.required'] = 'Please Select Option';
    //     }

    //     return $messages;
    // }

    public function updateQty($type = 'add')
    {
        $currentQty = $this->cartProduct['qty'];
        if ($type == 'remove') {
            if ($currentQty == 0) {
                return;
            }
            return $this->cartProduct['qty']--;
        }
        if ($currentQty == 10) {
            return;
        }
        $this->cartProduct['qty']++;
    }

    public function updateProductPrice(): void
    {
        $totalOptionPrice = collect($this->cartProduct['options'])->map(function ($option) {
            $option = json_decode($option, false);

            return $option->price ?? 0;
        })->filter()->sum();

        $price = $this->product->price;
        if($this->selectSize)
        {
            $price = $this->product->productPrices()->where('size', $this->selectSize)->first()->price;
        }

        $this->cartProduct['price'] = number_format(($price + $totalOptionPrice), 2);
    }

}
