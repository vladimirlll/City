@php 

use App\Models\Skill;
use App\Models\Skill_User;

@endphp 

<hr>
<div class="profile__data__spec__item skills">
    <h3 class="profile__data__spec__item__title">Навыки</h3>
    <div class="skills__items">
        @foreach ($skillsOfUserConnectors as $skillOfUserConnector)
        @php 
        $skill = Skill::find($skillOfUserConnector->skill_id);
        @endphp
        <div class="skills__item">{{$skill->name}}</div>
        @endforeach
    </div>
</div>