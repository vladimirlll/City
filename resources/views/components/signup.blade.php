<!-- Вход -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Vladilen CV</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Подключение CSS файла bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- Далее может идти подключение любого другого CSS файла сайта -->
  <link href="css/styles1.css" rel="stylesheet">
</head>

<body>
  <!-- Реализуем хэдер -->
  <div class="row " > <!--В строку -->
    <div class="col-md-2"></div>
    <div class="col"><!--Начиная с 3его столбца -->
      <nav class="nav navAdd" > <!--nav-класс бутстрапа; navAdd-реализованный класс -->
        <div class="container">
              <a class="navbar-brand navHeadAdd" href="/">Город</a> <!-- Название -->
              <ul class="nav justify-content-end"> <!-- Ссылки -->
                <li> <a class="nav-link dl"href="/#AboutPlatform">О платформе</a> </li><!--Контекстная ссылка  -->
                <li> <a class="nav-link dl" href="/#Kontakts">Контакты</a> </li><!-- Контекстная ссылка -->
                <li> <a class="nav-link dl"  href="/login">Войти</a> </li> <!--Окно Вход  -->
                <li> <a class="nav-link dl " href="/signup">Зарегистрироваться</a> </li><!--Окно Регистрация -->
              </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="form-container">
    <strong><h5 class="registration" >Регистрация</h5></strong>
    <form id="form" action="/register" method="POST">
      @csrf
      <label for="email" class="form-label boxtext">Электронная почта</label>
      <input name="email" type="email" class="form-control typecharacker" id="email" aria-describedby="emailHelp">
      <label for="password" class="form-label boxtext">Пароль</label>
      <input name="password" type="password" class="form-control typecharacker" id="password">
      <label for="password_again" class="form-label boxtext">Пароль ещё раз</label>
      <input name="password_again" type="password" class="form-control typecharacker" id="password_again">
      <label class="form-check-label" for="customer">Заказчик<br></label>
      <input name="role[customer]" type="radio" class="form-check-input" id="customer">
      <br>
      <label class="form-check-label" for="specialist">Специалист</label>
      <input name="role[specialist]" type="radio" class="form-check-input" id="specialist">
      <input class="btn-signup" name="go" type="submit" value="Зарегистрироваться">
      <p>Уже есть аккаунт? <a href="/login" style="color: #000;">Войти</a></p>
    </form>
    <p class="error" id="errorLog">
      @if($isAlreadySignUp)
      echo 'Пользователь с таким email уже зарегистрирован';
      @endif
    </p>
  </div>
  <script src="js/signup.js"></script>
</body>
</html>