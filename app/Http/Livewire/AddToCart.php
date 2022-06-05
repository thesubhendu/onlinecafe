<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\VendorProductOption;
use App\Services\LoyaltyClaimService;
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
    public $validLoyaltyClaimCard;

    public $claimCardId;
    protected $queryString = [
        'claimCardId' => ['except' => ''],
    ];

    public function render()
    {
        return view('livewire.add-to-cart');
    }

    public function mount(Product $product, LoyaltyClaimService $loyaltyClaimService)
    {
        $this->product     = $product->load('productPrices');
        $this->cartProduct = [
            'id'      => $product->id,
            'name'    => $product->name,
            'price'   => $product->price,
            'weight'  => '0',
            'qty'     => 1,
            'options' => ['extras'=>[]],
        ];

        if($this->claimCardId){
            $this->validLoyaltyClaimCard= $loyaltyClaimService->verifiedLoyaltyCard($this->claimCardId);
        }

        $this->vendorOptionsExist = VendorProductOption::where('vendor_id', $product->vendor_id)->count();
        $this->setDefaultOption();
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

        if(!empty($this->cartProduct['options']['extras'])) {
            collect($this->cartProduct['options']['extras'])->map(function ($optionName, $optionTypeId) {
                // Recreate cart Product options
                $this->cartProduct['options']['extras'][$optionTypeId] =
                    $this->product->optionTypes()->where('id', $optionTypeId)->first()->name . ': ' . $optionName;
            });
        }

        if($this->selectSize){
            $this->cartProduct['options']['extras'][] =  "Size: $this->selectSize" ;
        }

        $this->selectSize = 'S';

        if($this->validLoyaltyClaimCard)
        {
            $loyaltyClaimService = new LoyaltyClaimService();
            $loyaltyClaimService->addClaimProductOnCart($this->validLoyaltyClaimCard, $this->cartProduct);
            $remainingClaimProduct = $loyaltyClaimService->remainingClaim($this->validLoyaltyClaimCard);

            if($remainingClaimProduct)
            {
                return redirect()->route('claim-loyalty-products', ['card' => $this->claimCardId]);
            }

            return redirect()->route('checkout.index', ['claimCardId' => $this->claimCardId]);
        }

        session()->forget('claimCardId');
        // only add free price product on loyalty claim
        $claimedCardProductIds = Cart::content()->where('price', 0)->pluck('rowId');
        foreach($claimedCardProductIds as $cardProductId)
        {
            Cart::remove($cardProductId);
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

    public function updateProductPrice(): void
    {
        $totalOptionPrice = $this->getTotalOptionsPrice($this->cartProduct['options']['extras']);

        $price = $this->product->price;
        if($this->selectSize)
        {
            $price = $this->product->productPrices()->where('size', $this->selectSize)->first()->price;
        }
        $this->cartProduct['price'] = $price + $totalOptionPrice;
    }

    private function setDefaultOption(): void
    {
        if($this->product->productPrices->count()){
            $this->selectSize = 'S';
            $this->cartProduct['price'] = $this->product->productPrices()->where('size', 'S')->first()->price ?? $this->product->price;
        }
        $defaultOptionType = [
            'Coffee Type' => 'House Blend',
            'Milk' => 'Full Cream',
            'Sugar' => 'No Sugar',
            'Syrups' => 'No thanks'
        ];
        $this->product->optionTypes()->each( function($optionType) use ($defaultOptionType) {
            if(array_key_exists($optionType->name, $defaultOptionType))
            {
                $this->cartProduct['options']['extras'][$optionType->id] = $defaultOptionType[$optionType->name];
            }
        });
        $totalOptionsPrice = $this->getTotalOptionsPrice($this->cartProduct['options']['extras']);
        $this->cartProduct['price'] += $totalOptionsPrice;
    }

    public function getTotalOptionsPrice($options)
    {
        return $this->product->vendor
            ->productOptions()
            ->whereIn('name', $options)
            ->sum('price');
    }

}
