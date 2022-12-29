<div class="catalog__item">
    <div class="catalog__item__user">
        <h2 class="catalog__item__user__name">{{$specialist->getOutName()}}</h2>
        <p class="catalog__item__user__spec">Специализация: {{$specializationsStr}}</p>
        <p class="catalog__item__user__about">{{$specialist->about}}</p>
        <div class="skills__items">
            @foreach($skills as $skill)
            <div class="skills__item">{{$skill->name}}</div>
            @endforeach
        </div>
    </div>
    <div class="catalog__item__actions">
        <a href="/user/{{$specialist->id}}" class="my-btn">Перейти к специалисту</a>
    </div>
</div>