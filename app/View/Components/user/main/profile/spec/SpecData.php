<?php

namespace App\View\Components\user\main\profile\spec;

use Illuminate\View\Component;
use App\Models\Skill;
use App\Models\User;
use App\Models\Role;
use App\Models\Skill_User;

class SpecData extends Component
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
        return view('components.user.main.profile.spec.spec-data');
    }
}
