<nav class="nav">
    <x-header.nav.link link="/#about" linkText="О платформе" />
    <x-header.nav.link link="/#contacts" linkText="Контакты"/>
    @if(Auth::check())
    @php 
    $user = Auth::user();
    $linkText = "";
    if(empty($user->name)) $linkText .= $user->email;
    else $linkText .= $user->surname . " " . $user->name[0] . " " . $user->patronymic[0];

    $dropedLinks =
    [
        '/user/' . $user->id => 'Личный кабинет',
        '/user/' . $user->id . '/notifications' => 'Оповещения',
        '/logout' => 'Выйти',
    ];

    @endphp
    {{--<x-header.nav.link link="/" :linkText=$linkText/>--}}
    <x-header.nav.drop-down-link :linkText=$linkText :dropedLinks=$dropedLinks />
    @else
    <x-header.nav.link link="/login" linkText="Войти"/>
    <x-header.nav.link link="/signup" linkText="Зарегистрироваться"/>
    @endif
</nav>