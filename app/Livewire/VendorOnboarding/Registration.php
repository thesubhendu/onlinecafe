<?php

namespace App\Livewire\VendorOnboarding;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Plan;
use App\Models\User;
use App\Models\Vendor;
use App\Services\AbnChecker;
use App\Services\StripeService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class Registration extends Component
{
    use PasswordValidationRules;

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
    public $agreement;
    public $password;
    protected $shop;
    public $authUser;
    public $password_confirmation;

    public $validationError;

    public $code;
    protected $queryString = ['validationError', 'code'];

    public function render()
    {
        return view('livewire.vendor-onboarding.registration');
    }

    public function mount(): void
    {

        $this->authUser = auth()->user();

        if ($this->code) {
            $vendor = Vendor::where('vendor_setup_code', $this->code)->first();
            if($vendor) {
                $this->fillDataFromExistingVendor($vendor);
            }else {
                session()->flash('error', "Invalid Vendor Code");
            }
        } elseif($this->authUser) {
            $this->autoFillFields();
        }
    }

    protected function dataToSave($vendor = null): array
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
            'mobile'           => "+61".ltrim($vendor->mobile, "0"),
            'suburb'           => $vendor->suburb,
            'pc'               => $vendor->pc,
            'state'            => $vendor->state,
            'abn'              => $vendor->abn,
        ];
    }

    private function validationRules(): array
    {
        $shop = $this->getShop();

        $rules = [
            'vendor_name'      => 'required|unique:vendors,vendor_name',
            'contact_name'     => 'required',
            'contact_lastname' => 'required',
            'abn'              => 'required|unique:vendors,abn',
            'suburb'           => 'required',
            'pc'               => 'required',
            'agreement' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ];

        if (!$this->authUser) {
            $rules['password'] = $this->passwordRules();
            $rules['email'] = 'email|required|unique:users,email';
            $rules['mobile'] = 'required|unique:users,mobile';

        }else{
            $rules['email'] = 'email|required|unique:users,email,'.auth()->user()->id;
            $rules['mobile'] = 'required|unique:users,mobile,'.auth()->user()->id;
        }


        if($shop)
        {
            $rules['vendor_name'] = 'required|unique:vendors,vendor_name,'.$shop->id;
            $rules['abn'] = 'required|unique:vendors,abn,'.$shop->id;
        }


        return $rules;
    }

    public function submit()
    {
        if(empty($this->validationError)){
            $this->register();
        }else {
            $this->updateData();
        }
    }

    public function register()
    {
        $this->validate($this->validationRules());

        // check if valid business (ABN check)
        $abnService = (new AbnChecker($this->abn));
        $isValid = $abnService->isValidBusiness();

        if (!$isValid) {
            session()->flash('error', "Not Valid ABN. Please enter correct ABN/ASIC and try again");

            return response()->json(['error' => 'Not Valid ABN'], 422);
        }

        $isValidBusinessName = $abnService->isValidBusinessName($this->vendor_name);
        if (!$isValidBusinessName) {
            session()->flash('error', "Invalid Business Name. Please enter correct Business Name and try again");

            return response()->json(['error' => 'Invalid Business Name'], 422);
        }

        // Update user and vendor data on auth user exist

        if ($this->authUser && $this->authUser->shop) {
            $this->authUser->shop->update($this->dataToSave());
            session()->flash('message', 'Vendor Updated');

            $this->dispatch('vendorRegistered');
            return redirect()->route('register-business.payment');
        } else {
            // Create new User
            $user = $this->createUser();
            event(new Registered($user));
            auth()->login($user);
            $this->authUser = auth()->user();
        }

        // Create Shop
        $this->authUser->shop()->create($this->dataToSave());

        //set user role to vendor
        $this->authUser->assignRole('vendor');

        session()->flash('message', 'Vendor Registered');
        $this->dispatch('vendorRegistered');

        return redirect()->route('register-business.payment');
    }

    public function updateData()
    {
        $this->validate($this->validationRules());

        // check if valid business (ABN check)
        $abnService = (new AbnChecker($this->abn));
        $isValid = $abnService->isValidBusiness();

        if (!$isValid) {
            session()->flash('error', "Not Valid ABN. Please enter correct ABN/ASIC and try again");

            return response()->json(['error' => 'Not Valid ABN'], 422);
        }

        $isValidBusinessName = $abnService->isValidBusinessName($this->vendor_name);

        if (!$isValidBusinessName) {
            session()->flash('error', "Invalid Business Name. Please enter correct Business Name and try again");

            return response()->json(['error' => 'Invalid Business Name'], 422);
        }


        if ($this->authUser) {
            $this->authUser->update(
                $this->dataToSave()
            );
        }

        $vendor = auth()->user()->shop;

        $vendor->update($this->dataToSave());

        return redirect()->route('register-business.payment');
    }

    private function createUser()
    {
        $input =
            [
                'name'     => $this->contact_name.' '.$this->contact_lastname,
                'email'    => $this->email,
                'mobile'   => "+61".ltrim($this->mobile, "0"),
                'password' => Hash::make($this->password),
            ];

        return User::create($input);
    }

    /**
     * @return mixed
     */
    public function getShop()
    {
        $shop = null;

        if ($this->code) {
            return Vendor::where('vendor_setup_code', $this->code)->first();
        }
        return $this->authUser->shop ?? $shop;
    }

    private function updateUser(): void
    {
        $user = auth()->user();
        $input =
            [
                'name'   => $this->contact_name.' '.$this->contact_lastname,
                'email'  => $this->email,
                'mobile' => $this->mobile,
            ];
        if ($input['email'] !== $user->email) {
            $input['email_verified_at'] = null;
            $user->forceFill($input)->save();
            event(new Registered($user));
        } else {
            $user->forceFill($input)->save();
        }
    }

    private function autoFillFields(): void
    {
         $name = explode(' ', auth()->user()->name, 2);
            $this->contact_name = $name[0];
            $this->contact_lastname = $name[1] ?? '';
            $this->email = auth()->user()->email;
            $this->mobile = auth()->user()->mobile;

        $this->shop = $this->authUser->shop;

        if ($this->shop) {
            $this->fillDataFromExistingVendor($this->shop);
        }
    }

    private function fillDataFromExistingVendor(Vendor $vendor)
    {
        $this->fill(
            [
                'vendor_name'      => $vendor->vendor_name,
                'address'          => $vendor->address,
                'suburb'           => $vendor->suburb,
                'pc'               => $vendor->pc,
                'state'            => $vendor->state,
                'abn'              => $vendor->abn,
            ]
        );
    }
}
