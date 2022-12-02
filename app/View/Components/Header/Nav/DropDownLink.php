<?php

namespace App\View\Components\header\nav;

use App\View\Components\Header\Nav\Link;
use Illuminate\View\Component;

class DropDownLink extends Link
{
    public $dropedLinks = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($linkText, $dropedLinks = [])
    {
        //
        parent::__construct('#', $linkText);
        $this->dropedLinks = $dropedLinks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.nav.drop-down-link');
    }
}
