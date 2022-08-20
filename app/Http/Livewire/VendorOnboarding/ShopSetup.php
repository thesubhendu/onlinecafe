<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Models\Service;
use App\Services\StripeService;
use Carbon\Carbon;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class ShopSetup extends Component
{
    use WithFileUploads;

    public $vendor;
    public $logo;
    public $vendorImage;
    public $form = [
        'shop_name',
        'shop_email',
        'shop_mobile',
        'description',
        'opening_hours',
        'max_stamps',
        'free_category',
        'get_free',
        'address',
        'lat',
        'lng',
        'is_rewarding_active',
        'services'
    ];
    public $openingHoursOptions = [];
    public $daysInWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    public $services;
    public $newService;
    public $listeners = ['markerPositionChanged', 'addressChanged'];
    public $vendorProductsExists;

    public function addService()
    {
        $this->validate([
            'newService' => 'sometimes|required|unique:services,name',
        ]);
        Service::create(['name' => $this->newService]);
        $this->services = Service::all();
        $this->newService = '';
    }

    public function mount()
    {
        $this->makeOpeningHoursOptions();
        $this->initializeOpeningHours();

        $vendor = auth()->user()->shop()->with('products')->first();
        $this->vendor = $vendor;
        $this->vendorProductsExists = $vendor->products()->exists();
        $this->services = Service::all();

        if ($vendor) {
            $this->form['shop_name'] = $vendor->shop_name;
            $this->form['shop_email'] = $vendor->shop_email;
            $this->form['shop_mobile'] = $vendor->shop_mobile;
            $this->form['description'] = $vendor->description;
            $this->form['address'] = $vendor->address;
            $this->form['lat'] = $vendor->lat;
            $this->form['lng'] = $vendor->lng;
            $this->form['max_stamps'] = $vendor->max_stamps;
            $this->form['free_category'] = $vendor->free_category;
            $this->form['get_free'] = $vendor->get_free;
            $this->form['is_rewarding_active'] = $vendor->is_rewarding_active;

            if ($vendor->opening_hours) {
                $this->form['opening_hours'] = $vendor->opening_hours;
                $services = [];
                foreach ($vendor->services as $s) {
                    $services[$s] = true;
                    if($this->services->where('name', $s)->get('name'))
                    {
                        $this->services[] = $s;
                    }
                }
                $this->form['services'] = $services;
            }

        }
    }

    public function submit()
    {
        $this->validate([
            'form.shop_name' => 'required',
            'form.shop_email' => 'email|required',
            'form.shop_mobile' => 'digits:10|required',
            'form.opening_hours' => 'required',
            'form.services' => 'required',
        ]);
        if($this->logo){
            $this -> validate([
                'logo' => 'image|max:512',
            ]);
        }elseif($this->vendorImage){
            $this -> validate([
                'vendorImage' => 'image|max:2048',
            ]);
        }

        $vendor = auth()->user()->shop()->first();

        if (empty($vendor)) {
            //register business first
            return redirect()->route('register-business.create');
        }

        $formData = [
            'shop_name' => $this->form['shop_name'],
            'shop_email' => $this->form['shop_email'],
            'shop_mobile' => $this->form['shop_mobile'],
            'description' => $this->form['description'] ?? '',
            'opening_hours' => $this->formatOpeningHours($this->form['opening_hours']),
            'address' => $this->form['address'],
            'lat' => $this->form['lat'] ,
            'lng' => $this->form['lng'],
            'services'=> collect($this->form['services'])->filter(fn($val, $key) => $val)->keys()->toArray(),
            'free_category' => $this->form['free_category'] === '' ? null : $this->form['free_category'],
            'get_free' => $this->form['get_free'],
            'max_stamps' => $this->form['max_stamps'],
            'is_rewarding_active' => $this->form['is_rewarding_active'],
        ];

        $vendor->update($formData);


        if (!empty($this->logo)) {
            if(Storage::exists($vendor->vendor_logo)) {
                Storage::delete($vendor->vendor_logo);
            }

            $fileName = $this->logo->store('vendor-logos');
            $vendor->vendor_logo = $fileName;
            $vendor->save();
        }

        if (!empty($this->vendorImage))
        {
            if(Storage::exists($vendor->vendor_image)) {
                Storage::delete($vendor->vendor_image);
            }

            $hashName = $this->vendorImage->hashName();
            $saveUrl = 'vendor-images/'.$hashName;
            $img = Image::make($this->vendorImage)->resize(500, 172)->save($hashName);
            Storage::disk('public')->put($saveUrl ,$img);

            $vendor->vendor_image = $saveUrl;
            $vendor->save();
        }


        $stripeConnectUrl = (new StripeService())->createAccount($vendor->fresh());
        return redirect()->to($stripeConnectUrl);
    }

    public function render()
    {
        return view('livewire.vendor-onboarding.shop-setup');
    }

    private function initializeOpeningHours()
    {
        foreach ($this->daysInWeek as $day) {
            $this->form['opening_hours'][$day]['from'] = '';
            $this->form['opening_hours'][$day]['to'] = '';
            $this->form['opening_hours'][$day]['is_active'] = true;
        }
    }

    protected function makeOpeningHoursOptions()
    {
        $baseTime = Carbon::parse('today at 12 AM');

        while ($baseTime->notEqualTo(Carbon::parse('today 11:45 PM'))) {
            $baseTime = $baseTime->addMinutes(15);
            $this->openingHoursOptions[$baseTime->format('H:i')] = $baseTime->format('h:i A');
        }
    }

    public function applyTimesToAllDays()
    {
        $referenceTimeFrom = $this->form['opening_hours']['Monday']['from'];
        $referenceTimeTo = $this->form['opening_hours']['Monday']['to'];

        foreach ($this->daysInWeek as $day) {
            if ($day != 'Monday') {
                $this->form['opening_hours'][$day]['from'] = $referenceTimeFrom;
                $this->form['opening_hours'][$day]['to'] = $referenceTimeTo;
            }
        }
    }

    private function formatOpeningHours(array $opening_hours)
    {
        return collect($opening_hours)->map(function ($item, $key) use ($opening_hours) {
            $formatted = $opening_hours[$key];
            $formatted['from'] = Carbon::parse($item['from'])->format('H:i');
            $formatted['to'] = Carbon::parse($item['to'])->format('H:i');

            return $formatted;
        });
    }

    public function addressChanged($address)
    {
        $this->form['address'] = $address;
    }

    public function markerPositionChanged($position)
    {
        $this->form['lat'] = $position[0];
        $this->form['lng'] = $position[1];
    }

    public function freeProductCategoryChange(): void
    {
        if($this->form['free_category'] === '')
        {
            $this->form['get_free'] = null;
        }
    }
}
