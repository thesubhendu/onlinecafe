<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductPrice;
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
        $this->selectSize = '';
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

            $totalAdditionalPrice = collect($this->cartProduct['options'])->map(function($option, $optionId) {
                                    $optionObject = ProductOption::find($optionId);
                                    return $optionObject->price ?? 0;
                                })->filter()->sum();

            $this->cartProduct['price'] += $totalAdditionalPrice;
        }

        if($this->selectSize){
            $this->cartProduct['options'][] =  "size: $this->selectSize" ;
        }

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

    public function updateProductPrice( ProductPrice $productPrice): void
    {
        $this->cartProduct['price'] = number_format(($productPrice->price), 2);
    }

}
