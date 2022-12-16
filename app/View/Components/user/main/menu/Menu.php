<?php

namespace App\View\Components\user\main\menu;

use Illuminate\View\Component;

class Menu extends Component
{
    public $id;
    public $activeSection;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $activeSection)
    {
        //
        $this->id = $id;
        $this->activeSection = $activeSection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.main.menu.menu');
    }
}
