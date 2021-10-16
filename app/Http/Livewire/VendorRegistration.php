<?php

namespace App\Http\Livewire;

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


    }
}
