<?php

namespace App\View\Components\header\nav;

use App\Models\User;
use Illuminate\View\Component;

class LoggedInNav extends Component
{
    public User $user;
    public $linkText;
    public $dropedLinks;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
        $this->linkText = "";
        if(empty($user->name)) $this->linkText .= $user->email;
        else
        {
            $this->linkText .= $user->getOutName();
        }

        $this->dropedLinks =
        [
            '/user/' . $user->id => 'Личный кабинет',
            '/user/' . $user->id . '/notifications' => 'Оповещения',
            '/logout' => 'Выйти',
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.nav.logged-in-nav');
    }
}
