<?php

namespace App\View\Components\user\main\profile\spec;

use Illuminate\View\Component;
use App\Models\Specialization_User;

class Specializations extends Component
{
    public $specializationsOfUserConnectors = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($specializationsOfUserConnectors)
    {
        //
        $this->specializationsOfUserConnectors = $specializationsOfUserConnectors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.main.profile.spec.specializations');
    }
}
