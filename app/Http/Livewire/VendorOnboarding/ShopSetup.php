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
        'menus.*.price'        => 'required',
        'options.*.isSelected' => 'boolean',
        'options.*.price'      => 'required|decimal',
    ];
    public $logo;
    public $form = [
        'shop_name',
        'description',
        'opening_hours',
    ];
    public $openingHoursOptions = [];
    public $daysInWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    public $menus;
    public $options;

    public function mount()
    {
        $this->makeOpeningHoursOptions();
        $this->initializeOpeningHours();
        $this->menus = AllProduct::all()->map(function ($product) {
            $product->isSelected = true;

            return $product;
        });

        $this->options = ProductOption::all()->map(function ($option) {
            $option->isSelected = true;

            return $option;
        });
    }

    public function render()
    {
        return view('livewire.vendor-onboarding.shop-setup');
    }

    private function initializeOpeningHours()
    {
        foreach ($this->daysInWeek as $day) {
            $this->form['opening_hours'][$day]['from']      = '';
            $this->form['opening_hours'][$day]['to']        = '';
            $this->form['opening_hours'][$day]['is_active'] = true;
        }
    }

    protected function makeOpeningHoursOptions()
    {
        $baseTime = Carbon::parse('today at 12 AM');

        while ($baseTime->notEqualTo(Carbon::parse('today 11:45 PM'))) {
            $baseTime                    = $baseTime->addMinutes(15);
            $this->openingHoursOptions[] = $baseTime->format('h:i A');
        }
    }

    public function applyTimesToAllDays()
    {
        $referenceTimeFrom = $this->form['opening_hours']['Monday']['from'];
        $referenceTimeTo   = $this->form['opening_hours']['Monday']['to'];

        foreach ($this->daysInWeek as $day) {
            if ($day != 'Monday') {
                $this->form['opening_hours'][$day]['from'] = $referenceTimeFrom;
                $this->form['opening_hours'][$day]['to']   = $referenceTimeTo;
            }
        }
    }

    public function submit()
    {
        $this->validate([
            'form.shop_name'     => 'required',
            'form.opening_hours' => 'required',
        ]);

        $vendor = auth()->user()->shop()->first();

        if (empty($vendor)) {
            //register business first
            return redirect()->route('register-business.create');
        }

        $vendor->update([
            'shop_name'     => $this->form['shop_name'],
            'description'   => $this->form['description'] ?? '',
            'opening_hours' => $this->formatOpeningHours($this->form['opening_hours']),
        ]);

        if ( ! empty($this->logo)) {
            $fileName             = $this->logo->store('vendor-logos');
            $vendor->vendor_image = $fileName;
            $vendor->save();
        }

        foreach ($this->menus->filter(fn($item) => $item->isSelected) as $menu) {
            $vendor->products()->create([
                'name'          => $menu->name,
                'description'   => $menu->description ?? "dummy description",
                'product_image' => $menu->image,
                'price'         => $menu->price,
                'category_id'   => $menu->category_id,
            ]);
        }

        foreach ($this->options->filter(fn($item) => $item->isSelected) as $option) {
            $vendor->productOptions()->create([
                'name'        => $option->name,
                'description' => $option->description,
                'image'       => $option->image,
                'price'       => $option->price,
                'category_id' => $option->category_id,
            ]);
        }

        return redirect()->route('vendor.show', $vendor->id);
    }

    private function formatOpeningHours(array $opening_hours)
    {
        return collect($opening_hours)->map(function ($item, $key) use ($opening_hours) {
            $formatted         = $opening_hours[$key];
            $formatted['from'] = Carbon::parse($item['from'])->format('H:i');
            $formatted['to']   = Carbon::parse($item['to'])->format('H:i');

            return $formatted;
        });
    }
}
