/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/signup.js ***!
  \********************************/
function validateEmail(email) {
  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  return reg.test(email);
}

function validatePassword(password) {
  if (password.length < 6) return false;
  return true;
}
function logSubmit(event) {
  var email = document.getElementById('email').value;
  var errorLog = document.getElementById('errorLog');
  if(!validateEmail(email))
  {
      errorLog.textContent = 'Проверьте правильность email!';
      event.preventDefault();
  }
  else
  {
      var password = document.getElementById('password').value;
      if (!validatePassword(password)) {
        errorLog.textContent = 'В пароле должно быть минимум 6 символов!';
        event.preventDefault();
      } else {
        var password_again = document.getElementById('password_again').value;
        if (password != password_again) {
          errorLog.textContent = 'Пароли не совпадают!';
          event.preventDefault();
        }
      }
  }
}
var form = document.getElementById('form');
form.addEventListener('submit', logSubmit);
/******/ })()
;