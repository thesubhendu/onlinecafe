<?php

namespace App\Http\Livewire\VendorOnboarding;

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
    public $daysInWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

    public function mount()
    {
        $this->makeOpeningHoursOptions();
        $this->initializeOpeningHours();
    }

    public function render()
    {
        return view('livewire.vendor-onboarding.shop-setup');
    }

    private function initializeOpeningHours()
    {
        foreach ($this->daysInWeek as $day) {
            $this->form['opening_hours'][$day]['from'] = '';
            $this->form['opening_hours'][$day]['to']   = '';
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
        $referenceTimeFrom = $this->form['opening_hours']['Mon']['from'];
        $referenceTimeTo   = $this->form['opening_hours']['Mon']['to'];

        foreach ($this->daysInWeek as $day) {
            if ($day != 'Mon') {
                $this->form['opening_hours'][$day]['from'] = $referenceTimeFrom;
                $this->form['opening_hours'][$day]['to']   = $referenceTimeTo;
            }
        }
    }

    public function submit()
    {
        $this->validate([
            'form.shop_name' => 'required',
        ]);

        $shop = auth()->user()->shop()->first();

        if (empty($shop)) {
            //register business first
            return redirect()->route('register-business.create');
        }

        $shop->update([
            'shop_name'     => $this->form['shop_name'],
            'description'   => $this->form['description'],
            'opening_hours' => json_encode($this->form['opening_hours']),
        ]);

        if ( ! empty($this->logo)) {
            $fileName           = $this->logo->store('vendor-logos');
            $shop->vendor_image = $fileName;
            $shop->save();
        }

        return redirect()->route('vendor.show', $shop->id);
    }
}
