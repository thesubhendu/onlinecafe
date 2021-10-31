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

    public $logo;
    public $form = [
        'shop_name',
        'description',
        'opening_hours',
    ];
    public $openingHoursOptions = [];
    public $daysInWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    public $menus;
    public $menuOptions;

    public function mount()
    {
        $this->makeOpeningHoursOptions();
        $this->initializeOpeningHours();
        $this->menus       = AllProduct::all();
        $this->menuOptions = ProductOption::all();
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
            'form.description'   => 'required',
            'form.opening_hours' => 'required',
        ]);

        $shop = auth()->user()->shop()->first();

        if (empty($shop)) {
            //register business first
            return redirect()->route('register-business.create');
        }

        $shop->update([
            'shop_name'     => $this->form['shop_name'],
            'description'   => $this->form['description'],
            'opening_hours' => $this->formatOpeningHours($this->form['opening_hours']),
        ]);

        if ( ! empty($this->logo)) {
            $fileName           = $this->logo->store('vendor-logos');
            $shop->vendor_image = $fileName;
            $shop->save();
        }

        return redirect()->route('vendor.show', $shop->id);
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
