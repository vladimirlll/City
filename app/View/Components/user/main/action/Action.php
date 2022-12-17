<?php

namespace App\View\Components\user\main\action;

use App\Models\Auth;
use App\Models\Specialist;
use App\Models\User;
use Illuminate\View\Component;

class Action extends Component
{
    public User $user;
    public $me;
    public User $another;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->me = null;
        $this->user = $user;
        $this->another = $user;
        if(Auth::check()) $this->me = Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if(!is_null($this->me))
        {
            if($this->another->id == $this->me->id) return view('components.user.main.action.my-page-actions', ['me' => $this->me]);
            else
            {
                if($this->user instanceof Specialist) return view('components.user.main.action.not-my-page-can-review-and-send-apply', 
                ['me' => $this->me, 'another' => $this->another]);
                else return view('components.user.main.action.not-my-page-can-review-action', 
                ['me' => $this->me, 'another' => $this->another]);
            }
        }
    }
}
