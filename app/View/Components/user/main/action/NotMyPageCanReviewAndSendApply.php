<?php

namespace App\View\Components\user\main\action;

use Illuminate\View\Component;

class NotMyPageCanReviewAndSendApply extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.main.action.not-my-page-can-review-and-send-apply');
    }
}