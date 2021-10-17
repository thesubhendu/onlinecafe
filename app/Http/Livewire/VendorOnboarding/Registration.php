<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Services\AbnChecker;
use Illuminate\Support\Str;
use Livewire\Component;

class Registration extends Component
{
    public $name;
    public $contactName;
    public $contactLastName;
    public $abn;
    public $email;
    public $phone;
    public $address;
    public $suburb;
    public $pc;
    public $state;
    public $cardstamps;
    public $agreement;

    public function render()
    {
        return view('livewire.vendor-onboarding.registration');
    }

    public function register()
    {
        $this->validate([
            'name'=>'required',
            'email'=>'email|required',
            'contactName'=>'required',
            'contactLastName'=>'required',
            'phone'=>'digits:10|required',
            'abn'=>'required',
            'suburb'=>'required',
            'pc'=>'required',
            'cardstamps'=>'required|integer',
            'agreement'=>'required',
        ]);

        // check if valid business (ABN check)
        $isValid = (new AbnChecker($this->abn))->isValidBusiness();

        if(!$isValid) {
            session()->flash('error', "Not Valid ABN. Please enter correct ABN/ASIC and try again");
            return response()->json(['error'=>'Not Valid ABN'], 422);
        }

        auth()->user()->shop()->create([
            'vendor_name'=> $this->name,
            'slug'=> Str::slug($this->name),
            'email'=> $this->email,
            'contact_name'=> $this->contactName,
            'contact_lastname'=> $this->contactLastName,
            'address'=> $this->address,
            'mobile'=> $this->phone,
            'suburb'=> $this->suburb,
            'pc'=> $this->pc,
            'cardstamps'=> $this->cardstamps,
            'state'=> $this->state,
            'abn'=> $this->abn,
        ]);

        //set user role to vendor

        session()->flash('message', 'Vendor Registered');

        $this->emitUp('vendorRegistered');
    }
}
