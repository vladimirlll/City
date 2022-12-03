<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">  
    <title>Регистрация</title>
</head>
<body>
    <div class="container">
      <x-header.header/>
      @php 
      $signedUp = false;
      @endphp
      <x-signup.main.main :isAlreadySignUp=$signedUp/>
      <x-footer.footer />
    </div>
    <script src="js/signup.js"></script>
</body>
</html>