<section class="consultations">
    <div class="section-title title-container main__form__title">
        <h1 class="title__text main__form__title__text">Консультации</h1>
    </div>
    <div class="content">
        <div class="tabs">
            <nav class="tabs__items">
                <a href="#active" class="link tabs__item">Активные</a>
                <a href="#ended" class="link tabs__item">Завершенные</a>
                @if($user->role()->name != 'customer')
                    <a href="#sended" class="link tabs__item">Заявки на консультации</a>
                @endif
            </nav>
            <div class="tabs__body">
                <div id="active" class="tabs__block">
                    @foreach($activeConsults as $consult)
                    
                        <div class="consultations__item">
                            <div target="_blank" href="index.html" class="link consultations__item__info">
                                
                                <a target="_blank" href="index.html" class="link consultations__item__info__customer">Заказчик: {{$consult->getCustomer()->surname}} {{$consult->getCustomer()->name[0]}}. {{$consult->getCustomer()->patronymic[0]}}.</a>
                                <a target="_blank" href="index.html" class="link consultations__item__info__specialist">Специалист: {{$consult->getSpecialist()->surname}} {{$consult->getSpecialist()->name[0]}}. {{$consult->getSpecialist()->patronymic[0]}}.</a>
                                <p class="consultations__item__info__platform">Платформа: {{$consult->getPlatform()->name}}</p>
                                <p class="consultations__item__info__time">Время связи: {{$consult->getDateTime()}}</p>
                            </div>
                            <div class="consultations__item__actions">
                                <a href="{{$consult->getLink()}}" class="my-btn consultations__item__detailed">Ссылка на консультацию</a>
                                <a href="/consultation/end/{{$consult->getId()}}" class="my-btn consultations__item__detailed">Завершить общение</a>
                                
                                
                            </div>
                        </div>

                    @endforeach
                </div>
                <div id="ended" class="tabs__block">
                    @foreach($endedConsults as $consult)
                        
                        <div class="consultations__item">
                            <div target="_blank" href="index.html" class="link consultations__item__info">
                                
                                <a target="_blank" href="index.html" class="link consultations__item__info__customer">Заказчик: {{$consult->getCustomer()->surname}} {{$consult->getCustomer()->name[0]}}. {{$consult->getCustomer()->patronymic[0]}}.</a>
                                <a target="_blank" href="index.html" class="link consultations__item__info__specialist">Специалист: {{$consult->getSpecialist()->surname}} {{$consult->getSpecialist()->name[0]}}. {{$consult->getSpecialist()->patronymic[0]}}.</a>
                                <p class="consultations__item__info__platform">Платформа: {{$consult->getPlatform->name}}</p>
                                <p class="consultations__item__info__time">Время связи: {{$consult->getDateTime()}}</p>
                            </div>
                        </div>

                    @endforeach
                </div>
                @if($user->role()->name != 'customer')
                    <div id="sended" class="tabs__block">
                        @foreach($applies as $consult)
                            
                            <div class="consultations__item">
                                <div target="_blank" href="index.html" class="link consultations__item__info">
                                    
                                    <a target="_blank" href="index.html" class="link consultations__item__info__customer">Заказчик: {{$consult->getCustomer()->surname}} {{$consult->getCustomer()->name[0]}}. {{$consult->getCustomer()->patronymic[0]}}.</a>
                                    <a target="_blank" href="index.html" class="link consultations__item__info__specialist">Специалист: {{$consult->getSpecialist()->surname}} {{$consult->getSpecialist()->name[0]}}. {{$consult->getSpecialist()->patronymic[0]}}.</a>
                                </div>
                                <div class="consultations__item__actions">
                                    <a href="/user/{{$user->id}}/consultation/{{$consult->getId()}}" class="my-btn consultations__item__detailed">Согласиться на консультацию</a>
                                    <a href="/consultation/end/{{$consult->getId()}}" class="my-btn consultations__item__detailed">Отменить заявку</a>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>