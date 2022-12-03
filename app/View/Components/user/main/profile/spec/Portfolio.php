<?php

namespace App\View\Components\user\main\profile\spec;

use App\Models\User;
use Illuminate\View\Component;

class Portfolio extends Component
{
    public User $user;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
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
        return view('components.user.main.profile.spec.portfolio');
    }
}
