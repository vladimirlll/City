<?php

namespace App\View\Components\Header;

use App\Models\Auth;
use Illuminate\View\Component;

class HeaderWithChecking extends Component
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
        
        $authUser = Auth::user();
        if(is_null($authUser)) return view('components.header.header-not-logged-in');
        else return view('components.header.header', ['user' => $authUser]);
        
    }
}
