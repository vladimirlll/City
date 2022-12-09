@php 
use App\Models\Role;
@endphp
<section class="profile__action">
    @if ($user->id == Auth::user()->id)
        <a href="/user/{{$user->id}}/edit" class="my-btn profile__action__btn">
            <span class="profile__action__btn__text">Редактировать профиль</span>
        </a>
    @else 
        <a href="/user/{{Auth::user()->id}}/review/to/{{$user->id}}" class="my-btn profile__action__btn">
            <span class="profile__action__btn__text">Оставить отзыв</span>
        </a>
        @if ($user->role_id == Role::where('name', '=', 'specialist')->get()[0]->id)
            <a href="/user/{{Auth::user()->id}}/send/to/{{$user->id}}" class="my-btn profile__action__btn">
                <span class="profile__action__btn__text">Оставить заявку на связь</span>
            </a>
        @endif 
    @endif
</section>