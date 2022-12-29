<?php

namespace App\View\Components\home\main;

use App\Models\Roles;
use App\Models\Specialist;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Main extends Component
{
    public $bestSpecialists;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.main.main');
    }
}
