@php 

use App\Models\Role;
use App\Models\City;
use App\Models\Country;

$name = empty($user->name) ? $user->email : $user->name;
$roleName = Role::find($user->role_id)->name == 'specialist' ? 'Специалист' : 'Заказчик';
$age = empty($user->age) ? "" : $user->age;

$ageStr = "";
if(!empty($age))
{
    if($age % 10 == 1) $ageStr = $age . " год";
    else if($age % 10 == 2 || $age % 10 == 3 || $age % 10 == 4) $ageStr = $age . " года";
    else $ageStr = $age . " лет";
}

$roleAndAgeStr = $roleName;
if(!empty($age)) $roleAndAgeStr .= $ageStr;

$city = empty($user->city_id) ? "" : City::find($user->city_id)->name;
$country = empty($user->city_id) ? "" : Country::find(City::find($user->city_id)->country_id)->name;

@endphp

<section class="profile__data">
    <div class="profile__data__general">
        <img src="/" alt="User avatar" class="profile__data__general__item profile__data__general__avatar">
        <h2 class="profile__data__general__item profile__data__general__name">{{$name}}</h2>
        <div class="profile__data__general__item profile__data__general__secondary">
            <p class="profile__data__general__secondary__item profile__data__general__secondary__roleage">{{$roleAndAgeStr}}</p>
            @if (!empty($city))
            <p class="profile__data__general__secondary__item profile__data__general__secondary__location">{{$city}}, {{$country}}</p>
            @endif
            <p class="profile__data__general__secondary__item profile__data__general__secondary__rating">4.65</p>
        </div>
    </div>
    <div class="profile__data__about">
        <h2 class="profile__data__about__title">О себе</h2>
        <p class="profile__data__about__text">
            {{$user->about}}
        </p>
    </div>
    <x-user.main.profile.spec.spec-data :user="$user" />
</section>