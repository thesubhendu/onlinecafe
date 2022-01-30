<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Models\AllProduct;
use App\Models\ProductOption;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShopSetup extends Component
{
    use WithFileUploads;

    protected $rules = [
        'menus.*.isSelected'   => 'boolean',
        'menus.*.is_stamp'   => 'boolean',
        'menus.*.price'        => 'required',
        'options.*.isSelected' => 'boolean',
        'options.*.price'      => 'required|decimal',
    ];
    public $logo;
    public $form = [
        'shop_name',
        'shop_email',
        'shop_mobile',
        'description',
        'opening_hours',
        'max_stamps',
        'free_product',
        'get_free',
        'address',
        'lat',
        'lng',
        'services'
    ];
    public $openingHoursOptions = [];
    public $daysInWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    public $menus;
    public $options;

    public $services = ['Food','Coffee','Drinks', 'Pet Friendly'];

    public $listeners = ['markerPositionChanged', 'addressChanged'];

    public function mount()
    {
        $this->makeOpeningHoursOptions();
        $this->initializeOpeningHours();

        $this->menus = AllProduct::all()->map(function ($product) {
            $product->isSelected = true;
            $product->is_stamp = true;

            return $product;
        });


        $this->options = ProductOption::all()->map(function ($option) {
            $option->isSelected = true;

            return $option;
        });

        $vendor = auth()->user()->shop()->first();

        if ($vendor) {
            $this->form['shop_name'] = $vendor->shop_name;
            $this->form['shop_email'] = $vendor->shop_email;
            $this->form['shop_mobile'] = $vendor->shop_mobile;
            $this->form['description'] = $vendor->description;
            $this->form['address'] = $vendor->address;
            $this->form['lat'] = $vendor->lat;
            $this->form['lng'] = $vendor->lng;
            $this->form['max_stamps'] = $vendor->max_stamps;
            $this->form['free_product'] = $vendor->free_product;
            $this->form['get_free'] = $vendor->get_free;

            if ($vendor->opening_hours) {
                $this->form['opening_hours'] = $vendor->opening_hours;
                $services = [];
                foreach ($vendor->services as $s) {
                    $services[$s] = true;
                }
                $this->form['services'] = $services;
            }
        }
    }

    public function submit()
    {
        $this->validate([
            'form.shop_name' => 'required',
            'form.shop_email' => 'email|required|unique:vendors,shop_email',
            'form.shop_mobile' => 'digits:10|required|unique:vendors,shop_mobile',
            'form.opening_hours' => 'required',
            'form.address' => 'required',
        ]);

        $vendor = auth()->user()->shop()->first();

        if (empty($vendor)) {
            //register business first
            return redirect()->route('register-business.create');
        }

        $vendor->update([
            'shop_name' => $this->form['shop_name'],
            'description' => $this->form['description'] ?? '',
            'opening_hours' => $this->formatOpeningHours($this->form['opening_hours']),
            'address' => $this->form['address'],
            'lat' => $this->form['lat'] ,
            'lng' => $this->form['lng'],
            'services'=> collect($this->form['services'])->filter(fn($val, $key) => $val)->keys()->toArray()
        ]);

        if (!empty($this->logo)) {
            $fileName = $this->logo->store('vendor-logos');
            $vendor->vendor_image = $fileName;
            $vendor->save();
        }

        foreach ($this->menus->filter(fn($item) => $item->isSelected) as $menu) {
            $vendor->products()->updateOrCreate(['name' => $menu->name], [
                'description' => $menu->description ?? "dummy description",
                'product_image' => $menu->image,
                'price' => $menu->price,
                'category_id' => $menu->category_id,
                'is_stamp' => $menu->is_stamp,
            ]);
        }

        foreach ($this->options->filter(fn($item) => $item->isSelected) as $option) {
            $vendor->productOptions()->updateOrCreate(['name' => $option->name], [
                'description' => $option->description,
                'image' => $option->image,
                'price' => $option->price,
                'category_id' => $option->category_id,
                'options' => $option->options,
            ]);
        }

        return redirect()->route('vendor.show', $vendor->id);
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
}
