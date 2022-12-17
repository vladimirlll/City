<main class="main">
    <section class="main__form">
        <div class="section-title title-container main__form__title">
            <h1 class="title__text main__form__title__text">Регистрация</h1>
        </div>
        <div class="main__form__content">
            <form action="/register" method="POST" class="main__form__content__form" id="form">
                @csrf
                <div class="main__form__content__form__item">
                    <label class="label label-input" for="email">Электронная почта</label>
                    <input name="email" placeholder="Введите email" type="email" class="form-input main__form__content__form__email" id="email" value="{{old('email')}}">
                </div>
                <div class="main__form__content__form__item">
                    <label class="label label-input" for="password">Пароль</label>
                    <input name="password" placeholder="Введите пароль" type="password" class="form-input main__form__content__form__password" id="password" value="{{old('password')}}">
                </div>
                <div class="main__form__content__form__item">
                    <label class="label label-input" for="password_again">Пароль еще раз</label>
                    <input placeholder="Введите пароль" type="password" class="form-input main__form__content__form__password-again" id="password_again" value="{{old('password_again')}}">
                </div>
                <div class="main__form__content__form__roles">
                    <div class="main__form__content__form__roles__item">
                        <input name="role" type="radio" class="main__form__content__form__customer" id="customer" value="customer">
                        <label class="label label-checkbox" for="customer">Заказчик<br></label>
                        <input name="role" type="radio" class="main__form__content__form__specialist" id="specialist" value="specialist">
                        <label class="label label-checkbox" for="specialist">Специалист</label>
                    </div>
                </div>
                <div class="main__form__content__form__item">
                    <input type="submit" class="ellipticalbtn" value="Зарегистрироваться">
                </div>
                <div class="main__form__content__form__item">
                    <p class="main__form__content__form__item__text">
                        Уже есть аккаунт? <a class="link main__form__content__form__item__text__to-login" href="/login">Войти</a>
                    </p>
                </div>
            </form>
            <p id="errorLog">
                @if($isAlreadySignUp)
                Пользователь с таким email уже зарегистрирован
                @endif
            </p>
        </div>
    </section>
</main>