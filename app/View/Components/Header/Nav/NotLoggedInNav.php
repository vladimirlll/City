<?php

namespace App\View\Components\Header\Nav;

use Illuminate\View\Component;

class NotLoggedInNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.nav.not-logged-in-nav');
    }
}
