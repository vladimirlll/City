<?php

namespace App\View\Components\user\main\profile;

use Illuminate\View\Component;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\Review;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    public User $user;
    public $userCityStr;
    public $userCountryStr;
    public $roleAndAgeStr;
    public $maxMark;
    public $avatarSrc;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $roleName = $this->user->getRoleName();
        $age = empty($this->user->age) ? "" : $this->user->age;

        // Формирование строки возраста
        $ageStr = "";
        if(!empty($age))
        {
            if($age % 10 == 1) $ageStr = $age . " год";
            else if($age % 10 == 2 || $age % 10 == 3 || $age % 10 == 4) $ageStr = $age . " года";
            else $ageStr = $age . " лет";
        }

        $this->roleAndAgeStr = $roleName;
        if(!empty($age)) $this->roleAndAgeStr .= $ageStr;

        $this->userCityStr = empty($this->user->city_id) ? "" : City::find($this->user->city_id)->name;
        $this->userCountryStr = empty($this->user->city_id) ? "" : Country::find(City::find($this->user->city_id)->country_id)->name;

        $this->maxMark = Review::MAX_MARK;

        if(Storage::exists('/public/images/users/avatars/' . $this->user->id))
            $this->avatarSrc = Storage::url('images/users/avatars/' . $this->user->id);
        else 
            $this->avatarSrc = Storage::url('images/users/avatars/default_avatar.jpg');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.main.profile.profile');
    }
}
