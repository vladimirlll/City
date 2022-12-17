<?php

namespace App\View\Components\header\nav;

use App\Models\User;
use Illuminate\View\Component;

class LoggedInNav extends Component
{
    public User $user;
    //public $linkText;
    //public $dropedLinks;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $someuser)
    {
        //
        $this->user = $someuser;
        $this->linkText = "";
        if(empty($this->user->name)) $this->linkText .= $this->user->email;
        else
        {
            $this->linkText .= $this->user->getOutName();
        }

        $this->dropedLinks =
        [
            '/user/' . $this->user->id => 'Личный кабинет',
            '/user/' . $this->user->id . '/notifications' => 'Оповещения',
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
        return view('components.header.nav.logged-in-nav', 
        ['linkText' => $this->linkText, 'dropedLinks' => $this->dropedLinks]); 
    }
}
