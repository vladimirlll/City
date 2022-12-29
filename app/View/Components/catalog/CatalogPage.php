<?php

namespace App\View\Components\catalog;

use Illuminate\View\Component;

class CatalogPage extends Component
{
    public $specialists;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($specialists)
    {
        //
        $this->specialists = $specialists;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.catalog.catalog-page');
    }
}
