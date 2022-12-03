<?php

namespace App\View\Components\user\main\profile\spec;

use Illuminate\View\Component;
use App\Models\Skill;
use App\Models\User;
use App\Models\Role;
use App\Models\Skill_User;

class Skills extends Component
{
    public $skillsOfUserConnectors;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($skillsOfUserConnectors)
    {
        //
        $this->skillsOfUserConnectors = $skillsOfUserConnectors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.main.profile.spec.skills');
    }
}
