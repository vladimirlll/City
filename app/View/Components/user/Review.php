<?php

namespace App\View\Components\user;

use App\Models\Apply;
use App\Models\User;
use Illuminate\View\Component;

class Review extends Component
{
    public $title;
    public User $me;
    public User $another;
    public Apply $apply;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, User $me, User $another, Apply $apply)
    {
        $this->title = $title;
        $this->me = $me;
        $this->another = $another;
        $this->apply = $apply;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.review');
    }
}
