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
    public $mobile;
    public $address;
    public $suburb;
    public $pc;
    public $state;
    public $cardstamps;
    public $agreement;
    public $is_pet_friendly;

    public function render()
    {
        return view('livewire.vendor-onboarding.registration');
    }

    public function register()
    {
        $this->validate([
            'name'            =>'required',
            'email'=>'email|required|unique:vendors',
            'contactName'=>'required',
            'contactLastName'=>'required',
            'mobile'=>'digits:10|required|unique:vendors',
            'abn'=>'required',
            'suburb'=>'required',
            'pc'=>'required',
//            'cardstamps'=>'required|integer',
            'agreement'=>'required',
            'is_pet_friendly' => 'required',
        ]);

        // check if valid business (ABN check)
        $isValid = (new AbnChecker($this->abn))->isValidBusiness();

        if(!$isValid) {
            session()->flash('error', "Not Valid ABN. Please enter correct ABN/ASIC and try again");
            return response()->json(['error'=>'Not Valid ABN'], 422);
        }

        $authUser = auth()->user();

        $authUser->shop()->create([
            'vendor_name'      => $this->name,
            'slug'             => Str::slug($this->name),
            'email'            => $this->email,
            'contact_name'     => $this->contactName,
            'contact_lastname' => $this->contactLastName,
            'address'          => $this->address,
            'mobile'           => $this->mobile,
            'suburb'           => $this->suburb,
            'pc'               => $this->pc,
            'cardstamps'       => $this->cardstamps,
            'state'            => $this->state,
            'abn'              => $this->abn,
            'is_pet_friendly'  => $this->abn,
        ]);

        //set user role to vendor
        $authUser->setRole('vendor');

        session()->flash('message', 'Vendor Registered');

        $this->emitUp('vendorRegistered');
    }
}
