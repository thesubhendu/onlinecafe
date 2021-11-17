<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $milkOptions = ['Cream', 'Skimmed', 'cow milk'];

    public $cartProduct;

    public $sugar = ['', 1, 2, 3, 4, 5];
    public $syrup = ['', 1, 2, 3, 4, 5];

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
            'qty'     => '1',
            'options' => [],
        ];
    }

    public function submit()
    {
        $this->validate();

        Cart::add($this->cartProduct)->associate(Product::class);

        session()->flash('message', 'Added to cart');
    }

    protected function rules()
    {
        $rules = [
            'cartProduct.quantity' => 'required|numeric',
        ];
        foreach ($this->product->options() as $option) {
            $rules['cartProduct.options.'.$option->id] = 'required';
        }

        return $rules;
    }

    protected function messages()
    {
        foreach ($this->product->options() as $option) {
            $messages['cartProduct.options.'.$option->id.'.required'] = 'Please Select Option';
        }

        return $messages;
    }
}
