<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductOption;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;

    public $cartProduct;


    public function render()
    {
        return view('livewire.add-to-cart');
    }

    public function mount(Product $product)
    {
        $this->product     = $product;
        $this->cartProduct = [
            'id'      => $product->id,
            'name'    => $product->name,
            'price'   => $product->price,
            'weight'  => '0',
            'qty'     => 1,
            'options' => [],
        ];
    }

    public function submit()
    {

        $this->validate();

        //only allowing order from one vendor
        if($existingItem = Cart::content()->first()) {
            if($existingItem->model->vendor_id != $this->product->vendor_id) {
                Cart::destroy();
                session()->flash('message', 'Previous Item in cart from other vendor cleared');
            }
        }

        if(!empty($this->cartProduct['options'])) {

            $totalAdditionalPrice = collect($this->cartProduct['options'])->map(function($option, $optionId) {
                                    $optionObject = ProductOption::find($optionId);
                                    return $optionObject->price ?? 0;
                                })->filter()->sum();

            $this->cartProduct['price'] += $totalAdditionalPrice;
        }

        Cart::add($this->cartProduct)->associate(Product::class);


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

}
