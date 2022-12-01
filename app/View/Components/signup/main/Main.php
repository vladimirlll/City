<?php

namespace App\View\Components\signup\main;

use Illuminate\View\Component;

class Main extends Component
{
    public $isAlreadySignUp;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($isAlreadySignUp)
    {
        //
        $this->isAlreadySignUp = $isAlreadySignUp;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.signup.main.main');
    }
}
