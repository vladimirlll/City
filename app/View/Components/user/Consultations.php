<?php

namespace App\View\Components\user;

use App\Models\User;
use Illuminate\View\Component;

class Consultations extends Component
{
    public User $user;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user, $title)
    {
        //
        $this->user = $user;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.consultations');
    }
}
