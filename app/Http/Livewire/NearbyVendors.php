<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class NearbyVendors extends Component
{

    public $nearbyShops;

    public $lat;
    public $lon;

    public function mount()
    {
        $userLocation = geoip();

        if (empty($userLocation->lat)) {
            $userLocation = geoip('51.158.22.211'); //put some default location
        }
        $this->nearbyShops = $this->getNearByShops($userLocation->lat, $userLocation->lon);
    }

    protected function getNearByShops($lat, $lon)
    {
        return (new Vendor())->nearbyShops($lat, $lon);
    }

    public function updatedLat()
    {
        $this->nearbyShops = $this->getNearByShops($this->lat, $this->lon);
    }

    public function render()
    {
        return view('livewire.nearby-vendors');
    }
}
