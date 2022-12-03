@php 
$user = Auth::user();

@endphp

<section class="menu">
    <x-user.main.menu.menu-item class="menu__item menu__item-active" link="#">Профиль</x-user.main.menu.menu-item>
    @if ($id == $user->id)
    <x-user.main.menu.menu-item class="menu__item" link="#">Консультации</x-user.main.menu.menu-item>
    <x-user.main.menu.menu-item class="menu__item" link="#">Безопасность</x-user.main.menu.menu-item>
    @endif
</section>