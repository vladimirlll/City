<?php

namespace App\View\Components\user\main\profile;

use Illuminate\View\Component;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\Role;

class Profile extends Component
{
    public User $user;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
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
