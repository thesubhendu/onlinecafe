<?php

namespace App\Http\Livewire\VendorOnboarding;

use Livewire\Component;
use Livewire\WithFileUploads;

class ShopSetup extends Component
{
    use WithFileUploads;

    public $logo;
    public $form = [
        'shop_name',
        'description',
        'opening_hours'
    ];

    public function render()
    {
        return view('livewire.vendor-onboarding.shop-setup');
    }

    public function submit()
    {
        $this->validate([
           'form.shop_name' => 'required',
        ]);

        $shop = auth()->user()->shop()->first();

        $shop->update([
            'shop_name'=> $this->form['shop_name'],
            'description'=> $this->form['description'],
            'opening_hours'=> json_encode($this->form['opening_hours']),
        ]);

        if(!empty($this->logo)) {
            $fileName = $this->logo->store('vendor-logos');
            $shop->vendor_image = $fileName;
            $shop->save();
        }

        return redirect()->route('vendor.show', $shop->id);
    }
}
