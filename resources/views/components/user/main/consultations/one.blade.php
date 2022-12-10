@php 

use App\Model\ApplyStatuses;

@endphp

<section class="main__form">
    <div class="section-title title-container main__form__title">
        <h1 class="title__text main__form__title__text">Принятие заявки</h1>
    </div>
    <div class="main__form__content">
        <form action="/consultation/apply/{{$consult->getId()}}" method="POST" class="main__platform-form__content__form">
            @csrf
            <div class="main__form__content__form__item">
                <label class="label label-input" for="platform">Платформа</label>
                <select name="platform" class="selectpicker" aria-label="size 3 select example" data-live-search="true" title="Выберите платформу для связи" data-width="100%">
                    <option data-tokens="ZOOM" value="2">ZOOM</option>
                </select>
            </div>
            <div class="main__form__content__form__item">
                <label class="label label-input" for="platform">Время</label>
                <input class="form-input" type="datetime-local" name="time" id="time">
                <!--<select name="platform" class="selectpicker" aria-label="size 3 select example" data-live-search="true" title="Выберите платформу для связи" data-width="100%">
                    <option data-tokens="ZOOM" value="1">ZOOM</option>
                    <option data-tokens="Discord" value="2">Discord</option>
                </select>
                -->
            </div>
            <div class="main__form__content__form__item">
                <input type="submit" class="main__form__content__form__submit" value="Назначить встречу">
            </div>
        </form>
    </div>
</section>