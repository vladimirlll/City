<?php

namespace App\View\Components\Header\Nav;

use Illuminate\View\Component;

class Link extends Component
{
    // url ссылки
    public $link;

    // текст ссылки
    public $linkText;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $linkText)
    {
        $this->link = $link;
        $this->linkText = $linkText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.nav.link');
    }
}
