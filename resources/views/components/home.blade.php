<!-- Главная страница -->
<!doctype html>
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

<body >
<br>
<!-- Реализуем хэдер -->
  <div class="row "> <!--В строку -->
    <div class="col-md-2"></div><!--отступ 2 столбца -->
    <div class="col"><!--Начиная с 3его столбца -->
      <nav class="nav navAdd" > <!--nav-класс бутстрапа; navAdd-реализованный класс -->
        <div class="container">
              <a class="navbar-brand navHeadAdd" href="/">Город</a> <!-- Название -->
              <ul class="nav justify-content-end"> <!-- Ссылки -->
                <li> <a class="nav-link dl"href="#AboutPlatform">О платформе</a> </li><!--Контекстная ссылка  -->
                <li> <a class="nav-link dl" href="#Kontakts">Контакты</a> </li><!-- Контекстная ссылка -->
                <li> <a class="nav-link dl"  href="/login">Войти</a> </li> <!--Окно Вход  -->
                <li> <a class="nav-link dl " href="/signup">Зарегистрироваться</a> </li><!--Окно Регистрация -->
              </ul>
        </div>
      </nav>
    </div>
  </div>

  <br>
  <div class="container" style="text-align: center;">
    <div class="row">
      <div class="col-md-2"></div><!--Отступ 2 столбца  --> <!--Визульно окно содержит 12 столбцов  -->
      <div class="col-md-10"><!-- С 3его столбца --> <!--Страница визуально разделена на строки   -->
        <div class="row"><!-- строка с предложениями создания объявления и пойска специалиста  -->
          <div class="box character1"><!-- Создание объявления --> <!-- классы реализованы в файле styles1.css  -->
            <br><br><br><br><br><br> Разместите объявление всего <br>за 3 минуты!<br><br>
            <button class="btn btn_darkHait"><!-- классы реализованы в файле styles1.css  -->
              <a class="nav-link active"  href="профиль специалиста.html"><!-- классы реализованы в бутстрапе  -->
                <p>Создать объявление</p>
              </a>
             </button>
          </div>
          <div class="box ColorDreenWhait character1"><!-- Поиск специалиста  -->
            <br><br><br>  <br><br><br> Найдите лучшего специалиста<br> для своей задачи<br><br>
            <button class="btn btn_haitDark"><!-- классы реализованы в файле styles1.css  -->
              <a class="nav-link active" href="/"><!-- классы реализованы в бутстрапе  -->
                <p>Посмотреть объявления</p>
              </a>
            </button>
          </div>
        </div>
        <div class="row col-md-10 bestProfi character1"><!-- Строка по идее должна содержать аватарки лучших специалистов  -->
          <!-- первые 2ва класса реализованы в бутстрапе 3яя и 4ая в файле styles1.css  -->
             <p> <br>Лучшие специалисты </p>
        </div>
        <div class="row col-md-10"><!-- строка сведении о платформе  -->
            <a name="AboutPlatform"></a> 
            <p class="NamePunkt text-center"> <br> О платформе</p>
            <p class="AboutPlp">Платформа Город - быстрый и высокоэффективный сервис поиска подходящих специалистов.<br>
              Сервис позволяет клиентам: <br> • Быстро находить качественного специалиста;<br>
              • Публиковать свои услуги в несколько кликов в одной из большого количества категорий;<br>
              • Оценить специалиста по сделанной услуге, оставить комментарий.</p>
        </div>
        <div class="row col-md-10"> <!-- строка контактов  -->
            <a name="Kontakts"></a> <p class="NamePunkt text-center"><br>Контакты</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>