<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Services\AbnChecker;
use Illuminate\Support\Str;
use Livewire\Component;
use Orchid\Platform\Models\Role;

class Registration extends Component
{
    public $vendor_name;
    public $contact_name;
    public $contact_lastname;
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

    protected $shop;

    public function render()
    {
        return view('livewire.vendor-onboarding.registration');
    }

    public function mount()
    {
        $this->shop = auth()->user()->shop;

        if ($this->shop) {
            $this->fill($this->dataToSave($this->shop));
        }
    }

    protected function dataToSave($vendor = null)
    {
        if (empty($vendor)) {
            $vendor = $this;
        }

        return [
            'vendor_name'      => $vendor->vendor_name,
            'slug'             => Str::slug($vendor->vendor_name),
            'email'            => $vendor->email,
            'contact_name'     => $vendor->contact_name,
            'contact_lastname' => $vendor->contact_lastname,
            'address'          => $vendor->address,
            'mobile'           => $vendor->mobile,
            'suburb'           => $vendor->suburb,
            'pc'               => $vendor->pc,
//            'cardstamps'       => $vendor->cardstamps,
            'state'            => $vendor->state,
            'abn'              => $vendor->abn,
            'is_pet_friendly'  => $vendor->is_pet_friendly,
        ];
    }

    private function validationRules()
    {
        $rules = [
            'vendor_name'      => 'required',
            'email'            => 'email|required|unique:vendors,email',
            'contact_name'     => 'required',
            'contact_lastname' => 'required',
            'mobile'           => 'digits:10|required|unique:vendors,mobile',
            'abn'              => 'required',
            'suburb'           => 'required',
            'pc'               => 'required',
            'agreement'        => 'required',
            'is_pet_friendly'  => 'required',
        ];

        if ( ! auth()->user()->shop) {
            return $rules;
        }
        $rules['email']  = 'email|required|unique:vendors,email,'.auth()->user()->shop->id;
        $rules['mobile'] = 'digits:10|required|unique:vendors,mobile,'.auth()->user()->shop->id;

        return $rules;
    }

    public function register()
    {
        $this->validate($this->validationRules());

        if (auth()->user()->shop) {
            auth()->user()->shop->update($this->dataToSave());
            session()->flash('message', 'Vendor Updated');

            return $this->emitUp('vendorRegistered');
        }
        // check if valid business (ABN check)
        $isValid = (new AbnChecker($this->abn))->isValidBusiness();

        if ( ! $isValid) {
            session()->flash('error', "Not Valid ABN. Please enter correct ABN/ASIC and try again");

            return response()->json(['error' => 'Not Valid ABN'], 422);
        }

        $authUser = auth()->user();

        $authUser->shop()->create($this->dataToSave());

        //set user role to vendor
        $vendorRole = Role::where('slug', 'vendor')->first();
        $authUser->addRole($vendorRole);

        session()->flash('message', 'Vendor Registered');

        $this->emitUp('vendorRegistered');
    }
}
