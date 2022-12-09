<?php

namespace App\Http\Livewire\User\Edit\Main\Profile;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Livewire\Component;

class CityCountry extends Component
{
    public $city = null;
    public $country = null;
    public $countryId = 0;
    public $countries;
    public $cities = null;

    public function mount(User $user)
    {
        $this->countries = Country::all();
        $this->city = City::find($user->city_id);
        if(!is_null($this->city)) 
        {
            $this->country = Country::find($this->city->country_id);
            $this->countryId = $this->country->id;
            $this->cities = City::where('country_id', '=', $this->country->id)->get();
        }
        else 
        {

        }
    }

    public function changeCountry()
    {
        //$this->countryId = 10;
        $this->country = Country::find($this->countryId);
        $this->cities = City::where('country_id', '=', $this->country->id)->get();
    }

    public function render()
    {
        return view('livewire.user.edit.main.profile.city-country');
    }
}
