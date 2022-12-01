<?php

namespace App\View\Components\home\main\bestspecialists\item;

use Illuminate\View\Component;

class Item extends Component
{
    public $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.main.bestspecialists.item.item');
    }
}
