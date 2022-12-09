<?php

namespace App\View\Components\user\edit\main\profile;

use App\Models\Skill;
use App\Models\Skill_User;
use App\Models\User;
use Illuminate\View\Component;

class Skills extends Component
{
    public $skills;
    public $userSkills;
    public User $user;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
        $this->skills = Skill::all();
        $this->userSkills = Skill_User::where('specialist_id', '=', $user->id)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.edit.main.profile.skills');
    }
}
