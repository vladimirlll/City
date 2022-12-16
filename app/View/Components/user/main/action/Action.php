<?php

namespace App\View\Components\user\main\action;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Action extends Component
{
    public User $user;
    public User $me;
    public User $another;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
        $this->another = $user;
        $this->me = Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        /*if($this->another->id == Auth::user()->id) return view('components.user.main.action.my-page-actions');
        else
        {
            if()
        }

        @else 
            @if ($user->)
            <a href="/user/{{Auth::user()->id}}/review/to/{{$user->id}}" class="my-btn profile__action__btn">
                <span class="profile__action__btn__text">Оставить отзыв</span>
            </a>
            @if ($user->role_id == Role::where('name', '=', 'specialist')->get()[0]->id)
                <a href="/user/{{Auth::user()->id}}/send/to/{{$user->id}}" class="my-btn profile__action__btn">
                    <span class="profile__action__btn__text">Оставить заявку на связь</span>
                </a>
            @endif 
        @endif
        */
        return view('components.user.main.action.action');
    }
}
