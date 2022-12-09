<?php

namespace App\View\Components\user\edit\main\profile;

use App\Models\Specialization;
use App\Models\Specialization_User;
use App\Models\User;
use Illuminate\View\Component;

class Specializations extends Component
{
    public $specs;
    public $userSpecs;
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
        $this->specs = Specialization::all();
        $this->userSpecs = Specialization_User::where('specialist_id', '=', $user->id)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.edit.main.profile.specializations');
    }
}
