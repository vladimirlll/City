<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class DefaultButton extends Component
{
    // Строка с ссылкой
    public $link;
    
    // Строка с имененем ссылки
    public $linkName;

    // Строка с классами для кнопки
    //public $classNames;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $linkName)
    {
        $this->link = $link;
        $this->linkName = $linkName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.default-button');
    }
}
