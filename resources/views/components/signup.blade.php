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
  <form class="row">
  <br><br>
    <div class="col-md-4"> </div>
    <div class="col-md-2" style="text-align: center;" >
   <p ><strong> <h5 class="registration" >Регистрация</h5> </strong></p><br>
      <div class="mb-3"><!-- Логин -->
        <p for="exampleInputEmail1" class="form-label">
        <label for="exampleInputEmail1" class="form-label boxtext">Электронная почта</label>
        <input type="email" class="form-control typecharacker" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label boxtext">Пароль</label>
        <input type="password" class="form-control typecharacker" id="exampleInputPassword1 ">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label boxtext"> Пароль ещё раз</label>
        <input type="password" class="form-control typecharacker" id="exampleInputPassword1" ></div>
      <div class="mb-3 form-check" style="text-align: left;">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Заказчик<br></label>
        <br>
        <input type="checkbox" class="form-check-input" id="exampleCheck2">
        <label class="form-check-label" for="exampleCheck1">Специалист</label>
      </div>
      <button type="submit">Зарегистрироваться</button>
      <p>Уже есть аккаунт? <a href="/login" style="color: #000;">Войти</a></p>
    </div>
  </form>
</body>
</html>