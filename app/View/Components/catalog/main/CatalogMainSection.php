<?php

namespace App\View\Components\catalog\main;

use Illuminate\View\Component;

class CatalogMainSection extends Component
{
    public $specialists;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($specialists)
    {
        $this->specialists = $specialists;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.catalog.main.catalog-main-section');
    }
}
