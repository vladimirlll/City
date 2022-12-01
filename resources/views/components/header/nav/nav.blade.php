<nav class="nav">
    <x-header.nav.link link="/#about" linkText="О платформе" />
    <x-header.nav.link link="/#contacts" linkText="Контакты"/>
    @if(Auth::check())
    @php 
    $user = Auth::user();
    $linkText = "";
    if(empty($user->name)) $linkText .= $user->email;
    else $linkText .= $user->surname . " " . $user->name[0] . " " . $user->patronymic[0];
    @endphp
    <x-header.nav.link link="/" :linkText=$linkText/>
    @else
    <x-header.nav.link link="/login" linkText="Войти"/>
    <x-header.nav.link link="/signup" linkText="Зарегистрироваться"/>
    @endif
</nav>