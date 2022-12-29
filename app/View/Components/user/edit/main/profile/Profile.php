<?php

namespace App\View\Components\user\edit\main\profile;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Profile extends Component
{
    public User $user;
    public $avatarSrc;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
        if(Storage::exists('/public/images/users/avatars/' . $this->user->id))
            $this->avatarSrc = Storage::url('images/users/avatars/' . $this->user->id);
        else 
            $this->avatarSrc = Storage::url('images/users/avatars/default_avatar.jpg');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.edit.main.profile.profile');
    }
}
