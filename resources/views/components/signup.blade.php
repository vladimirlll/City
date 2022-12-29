<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">  
    <title>Test</title>
</head>
<body>
    <div class="container">
      <x-header.header-with-checking/>
      <main class="main">
          <section class="main__signup-form">
              <div class="section-title title-container main__signup-form__title">
                  <h1 class="title__text main__signup-form__title__text">Регистрация</h1>
              </div>
              <div class="main__signup-form__content">
                  <form action="/" method="POST" class="main__signup-form__content__form">
                      <div class="main__signup-form__content__form__item">
                          <label class="label label-input" for="email">Электронная почта</label>
                          <input placeholder="Введите email" type="email" class="form-input main__signup-form__content__form__email" id="email">
                      </div>
                      <div class="main__signup-form__content__form__item">
                          <label class="label label-input" for="password">Пароль</label>
                          <input placeholder="Введите пароль" type="password" class="form-input main__signup-form__content__form__password" id="password">
                      </div>
                      <div class="main__signup-form__content__form__item">
                          <label class="label label-input" for="password_again">Пароль еще раз</label>
                          <input placeholder="Введите пароль" type="password" class="form-input main__signup-form__content__form__password-again" id="password_again">
                      </div>
                      <div class="main__signup-form__content__form__roles">
                          <div class="main__signup-form__content__form__roles__item">
                              <input name="role[customer]" type="radio" class="main__signup-form__content__form__customer" id="customer">
                              <label class="label label-checkbox" for="customer">Заказчик<br></label>
                          </div>
                          <div class="main__signup-form__content__form__roles__item">
                              <input name="role[specialist]" type="radio" class="main__signup-form__content__form__specialist" id="specialist">
                              <label class="label label-checkbox" for="specialist">Специалист</label>
                          </div>
                      </div>
                      @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                      @endif
                      <div class="main__signup-form__content__form__item">
                          <input type="submit" class="main__signup-form__content__form__submit" value="Зарегистрироваться">
                      </div>
                      <div class="main__signup-form__content__form__item">
                          <p class="main__signup-form__content__form__item__text">
                              Уже есть аккаунт? <a class="link main__signup-form__content__form__item__text__to-login" href="/">Войти</a>
                          </p>
                      </div>
                  </form>
              </div>
          </section>
      </main>
      <x-footer.footer />
    </div>
</body>
</html>