@php 

use App\Models\Country;
use App\Models\City;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Specialization;
use App\Models\Skill_User;
use App\Models\Specialization_User;

@endphp 
<section class="profile__data">
    <div class="profile__data__general">
        <h2 class="profile__data__general__item">Фото</h2>
        <img src="{{$user->getAvatarSrc()}}" alt="User avatar" class="profile__data__general__item profile__data__general__avatar">

    </div>
    <div class="main__form__content">
        <form enctype="multipart/form-data" action="/user/{{$user->id}}/save" method="POST" class="main__signup-form__content__form">
            @csrf
            <div class="main__form__content__form__item">
                <label class="label label-input" for="useravatar">Изменить фото</label>
                <input name="useravatar" type="file" class="form-input main__form__content__form__avatar" id="useravatar">
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="name">Имя</label>
                <input name="name" value="{{$user->name}}" type="text" class="form-input main__form__content__form__name" id="name">
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="surname">Фамилия</label>
                <input name="surname" value="{{$user->surname}}" type="text" class="form-input main__form__content__form__surname" id="surname">
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="patronymic">Отчество</label>
                <input name="patronymic" value="{{$user->patronymic}}" type="text" class="form-input main__form__content__form__patronymic" id="patronymic">
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="bday">Дата рождения</label>
                <input value="{{$user->birth_date}}" name="bday" type="date" class="form-input main__form__content__form__bday" id="bday">
            </div>
            <livewire:user.edit.main.profile.city-country :user="$user"/>
            <div class="form-group main__form__content__form__item">
                <label class="label label-input" for="about">О себе</label>
                <textarea required maxlength="400" name="about" id="about" rows="3" class="form-control">{{$user->about}}</textarea>
            </div>
            @if($user->role_id == Role::where('name', '=', 'specialist')->get()[0]->id)
                <x-user.edit.main.profile.Skills :user="$user" />
                <x-user.edit.main.profile.Specializations :user="$user" />
                
                <div class="form-group main__form__content__form__item">
                    <label class="label label-input" for="portfolio">Портфолио</label>
                    <textarea class="form-control" required maxlength="400" name="portfolio" id="portfolio" rows="3">{{$user->portfolio}}</textarea>
                </div>
                {{--<div class="main__form__content__form__item not-centered">
                    <label class="label label-input" for="portfolio">Портфолио</label>
                    <textarea required maxlength="400" name="portfolio" id="portfolio" class="form-input portfolio-text">
                        {{$user->portfolio}}
                    </textarea>
                </div>--}}
            @endif
            <div class="main__form__content__form__item">
                <input type="submit" class="my-btn profile__edit__submit" value="Сохранить">
            </div>
        </form>
    </div>
</section>