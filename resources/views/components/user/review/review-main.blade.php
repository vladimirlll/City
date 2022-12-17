<main class="main">
    <section class="main__form">
        <div class="section-title title-container main__form__title">
            <h1 class="title__text main__form__title__text">Отзыв о пользователе {{$another->getOutName()}}</h1>
        </div>
        <div class="main__form__content">
            <form action="/review_save/{{$apply->id}}/from/{{$me->id}}/to/{{$another->id}}" method="POST" class="main__platform-form__content__form">                @csrf
                <div class="main__form__content__form__item">
                    <label class="label label-input" for="mark">Оценка общения</label>
                    <select name="mark" class="selectpicker" aria-label="size 3 select example" data-live-search="true" title="Выберите оценку" data-width="100%">
                        @for($i = $minRate; $i <= $maxRate; $i++)
                            @if($i == $myRate)
                                <option selected data-tokens="$i" value="{{$i}}">{{$i}}</option>
                            @else 
                                <option data-tokens="$i" value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    </select>
                </div>
                <div class="main__form__content__form__item">
                    <label class="label label-input" for="comment">Комментарий</label>
                    <textarea maxlength="250" name="comment" id="comment" rows="3" class="form-control">{{$myComment}}</textarea>
                </div>
                <div class="main__form__content__form__item">
                    <input type="submit" class="ellipticalbtn" value="Оставить отзыв">
                </div>
            </form>
        </div>
    </section>
</main>