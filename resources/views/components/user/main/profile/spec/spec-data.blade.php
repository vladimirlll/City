@php 

use App\Models\Role;
use App\Models\Skill_User;
use App\Models\Specialization_User;

@endphp 

@if($user->role_id == Role::where('name', '=', 'specialist')->get()[0]->id)

@php 
$skillsOfUserConnectors = Skill_User::where('specialist_id', '=', $user->id)->get();
$specializationsOfUserConnectors = Specialization_User::where('specialist_id', '=', $user->id)->get();

@endphp

<div class="profile__data__spec">
    <x-user.main.profile.spec.skills :skillsOfUserConnectors="$skillsOfUserConnectors" />
    <x-user.main.profile.spec.specializations :specializationsOfUserConnectors="$specializationsOfUserConnectors"/>
    <x-user.main.profile.spec.portfolio :user="$user" />
</div>

@endif 