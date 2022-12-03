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
        <img src="/" alt="User avatar" class="profile__data__general__item profile__data__general__avatar">

    </div>
    <div class="main__form__content">
        <form enctype="multipart/form-data" action="/user/{{$user->id}}/save" method="POST" class="main__signup-form__content__form">
            @csrf
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
            <div class="main__form__content__form__item">
                <label class="label label-input" for="country">Страна</label>
                <select name="country[]" id="country" class="form-input">
                    <option value="0" disabled>Выберите страну</option>
                    @php 
                    $countries = Country::all();
                    $userCity = City::find($user->city_id);
                    $userCountry = is_null($userCity) ? null : Country::find($userCity->country_id);
                    @endphp 
                    @if(is_null($userCity))
                        @foreach ($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    @else 
                        @foreach ($countries as $country)
                            @if($userCountry->id == $country->id)
                            <option selected value="{{$country->id}}">{{$country->name}}</option>
                            @else 
                            <option selected value="{{$country->id}}">{{$country->name}}</option>
                            @endif
                        @endforeach
                    @endif 
                </select>
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="city">Город</label>
                <select name="city[]" id="city" class="form-input">
                    <option value="0" disabled>Выберите город</option>
                    @php 
                    $cities = null;
                    if(!is_null($userCity))
                        $cities = City::where('country_id', '=', $userCountry->id)->get();
                    else
                        $cities = City::where('country_id', '=', 1)->get();
                    @endphp

                    @if(is_null($userCity))
                        @foreach ($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    @else 
                        @foreach ($cities as $city)
                            @if($userCity->id == $city->id)
                            <option selected value="{{$city->id}}">{{$city->name}}</option>
                            @else 
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="about">О себе</label>
                <textarea required maxlength="400" name="about" id="about" cols="30" rows="10" class="form-input">
                    {{$user->about}}
                </textarea>
            </div>
            @if($user->role_id == Role::where('name', '=', 'specialist')->get()[0]->id)
            <div class="main__form__content__form__item">
                <label class="label label-input" for="skill">Навыки</label>
                <select multiple="multiple" name="skill[]" id="skill" class="form-input">
                    <option value="0" disabled>Выберите навык</option>
                    @php 
                    $skills = Skill::all();
                    @endphp 
                    @foreach($skills as $skill)
                    <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="spec">Специализации</label>
                <select multiple="multiple" name="spec[]" id="spec" class="form-input">
                    <option value="0" disabled>Выберите специализацию</option>
                    @php 
                    $specs = Specialization::all();
                    @endphp 
                    @foreach($specs as $spec)
                    <option value="{{$spec->id}}">{{$spec->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="portfolio">Портфолио</label>
                <textarea required maxlength="400" name="portfolio" id="portfolio" cols="30" rows="10" class="form-input">
                    {{$user->portfolio}}
                </textarea>
            </div>
            @endif

            <div class="main__form__content__form__item">
                <input type="submit" class="btn profile__edit__submit" value="Сохранить">
            </div>
        </form>
    </div>
</section>