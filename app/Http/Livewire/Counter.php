<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public City $city;
    public Country $country;

    public function render()
    {
        return view('livewire.counter');

    }
}
