<section class="profile__data">
    <div class="profile__data__general">
        <img src="{{$user->getAvatarSrc()}}" alt="User avatar" class="profile__data__general__item profile__data__general__avatar">
        <h2 class="profile__data__general__item profile__data__general__name">{{$user->getOutName()}}</h2>
        <div class="profile__data__general__item profile__data__general__secondary">
            <p class="profile__data__general__secondary__item profile__data__general__secondary__roleage">{{$roleAndAgeStr}}</p>
            @if (!empty($userCityStr))
            <p class="profile__data__general__secondary__item profile__data__general__secondary__location">{{$userCityStr}}, {{$userCountryStr}}</p>
            @endif
            <p class="profile__data__general__secondary__item profile__data__general__secondary__rating">
                <img class="icon icon-star" src="{{ asset('images/icons/icon-star.svg') }}" alt="star" style="width: 16px; height: 24px;">
                <span>
                    {{$user->getAvgMark()}}
                </span>
            </p>
        </div>
    </div>
    <div class="profile__data__about">
        <h2 class="profile__data__about__title">О себе</h2>
        <p class="profile__data__about__text">
            {{$user->about}}
        </p>
    </div>
    <x-user.main.profile.spec.spec-data :user="$user" />
    <x-review.all-reviews :userReviews="$user->reviews()" />
</section>