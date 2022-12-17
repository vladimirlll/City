<main class="main">
    <section class="main__form">
        <div class="section-title title-container main__form__title">
            <h1 class="title__text main__form__title__text">Вход</h1>
        </div>
        <div class="main__form__content">
            <form action="/auth" method="POST" class="main__form__content__form">
                @csrf
                <div class="main__form__content__form__item">
                    <label class="label label-input" for="email">Электронная почта</label>
                    <input name="email" placeholder="Введите email" type="email" class="form-input main__form__content__form__email" id="email" value="{{ old('email') }}">
                </div>
                <div class="main__form__content__form__item">
                    <label class="label label-input" for="password">Пароль</label>
                    <input name="password" placeholder="Введите пароль" type="password" class="form-input main__form__content__form__password" id="password" value="{{ old('password') }}">
                </div>
                <div class="main__form__content__form__remember">
                    <input class="checkbox main__form__content__form__item__checkbox" type="checkbox" name="remember" id="remember">
                    <label class="label label-checkbox" for="specialist">Оставаться в системе</label>
                </div>
                <div class="main__form__content__form__item">
                    <input type="submit" class="ellipticalbtn " value="Войти">
                </div>
                <div class="main__form__content__form__item">
                    <p class="main__form__content__form__item__text">
                        Нет аккаунта? <a class="link main__form__content__form__item__text__to-login" href="/signup">Зарегистрируйтесь</a>
                    </p>
                </div>
            </form>
        </div>
    </section>
</main>