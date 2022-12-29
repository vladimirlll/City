<?php

namespace App\View\Components\catalog\main;

use Illuminate\View\Component;

class CatalogItem extends Component
{
    public $specialist;
    public $specializationsStr;
    public $skills;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($specialist)
    {
        //
        $this->specialist = $specialist;
        $specializations = $this->specialist->getMySpecializations();
        $this->specializationsStr = $specializations->implode('name', ', ');
        $this->skills = $this->specialist->getMySkills();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.catalog.main.catalog-item');
    }
}
