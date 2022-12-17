<?php

namespace App\View\Components\Header\Nav;

use App\Models\Auth;
use App\Models\User;
use App\View\Components\header\nav\LoggedInNav;
use Illuminate\View\Component;

class Nav extends Component
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
        if(Auth::check() && Auth::user()->id == $this->user->id)
        {
            return (new LoggedInNav($this->user))->render();
        }
        else return (new NotLoggedInNav())->render();
    }
}
