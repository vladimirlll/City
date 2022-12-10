<?php

namespace App\View\Components\user\main\consultations;

use App\Models\ApplyInfo;
use App\Models\User;
use Illuminate\View\Component;

class One extends Component
{
    public User $user;
    public ApplyInfo $consult;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user, ApplyInfo $consult)
    {
        //
        $this->user = $user;
        $this->consult = $consult;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.main.consultations.one');
    }
}
