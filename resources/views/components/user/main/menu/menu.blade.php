<section class="menu">
    @if($activeSection == "Профиль") 
    <x-user.main.menu.menu-item class="menu__item menu__item-active" link="/user/{{$id}}">Профиль</x-user.main.menu.menu-item>
    @else 
    <x-user.main.menu.menu-item class="menu__item" link="/user/{{$id}}">Профиль</x-user.main.menu.menu-item>
    @endif
    @if ($authUser !== null && $id == $authUser->id)
        @if($activeSection == "Консультации") 
        <x-user.main.menu.menu-item class="menu__item menu__item-active" link="/user/{{$id}}/consultations">Консультации</x-user.main.menu.menu-item>
        @else 
        <x-user.main.menu.menu-item class="menu__item" link="/user/{{$id}}/consultations">Консультации</x-user.main.menu.menu-item>
        @endif
        @if($activeSection == "Безопасность") 
        <x-user.main.menu.menu-item class="menu__item menu__item-active" link="#">Безопасность</x-user.main.menu.menu-item>
        @else 
        <x-user.main.menu.menu-item class="menu__item" link="#">Безопасность</x-user.main.menu.menu-item>
        @endif
    @endif
</section>