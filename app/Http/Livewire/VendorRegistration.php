<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use App\Services\AbnChecker;
use Livewire\Component;

class VendorRegistration extends Component
{
    public $name;
    public $abn;
    public $email;
    public $phone;
    public $agreement;

    public function render()
    {
        return view('livewire.vendor-registration')->extends('layout.app');
    }

    public function register()
    {
        $this->validate([
            'name'=>'required',
            'email'=>'email|required',
            'phone'=>'digits:10|required',
            'abn'=>'required',
            'agreement'=>'required',
        ]);

        // check if valid business (ABN check)

        $isValid = (new AbnChecker($this->abn))->isValidBusiness();

        if(!$isValid) {
            session()->flash('error', "Not Valid ABN");
        }else {

            auth()->user()->shop()->create([
                'name'=> $this->name,
                'email'=> $this->email,
                'phone'=> $this->phone,
                'abn'=> $this->abn,
                'is_active'=> true
            ]);


        }


    }
}
