<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class NearbyVendors extends Component
{

    public $nearbyShops = [];

    public $position = [];

    public function mount()
    {
//        $userLocation = geoip();
//        dd($userLocation);

//        if (empty($userLocation->lat)) {
//            $userLocation = geoip('51.158.22.211'); //put some default location
//        }
//        $this->nearbyShops = $this->getNearByShops($userLocation->lat, $userLocation->lon);
    }

    protected function getNearByShops($lat, $lon)
    {
        return (new Vendor())->nearbyShops($lat, $lon);
    }

    public function updatedPosition()
    {
        $this->nearbyShops = $this->getNearByShops($this->position[0], $this->position[1]);
    }

    public function render()
    {
        return view('livewire.nearby-vendors');
    }
}
