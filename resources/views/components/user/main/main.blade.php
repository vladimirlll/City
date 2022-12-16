<main class="main">
    <div class="profile__wrapper">
        @php 
        $id = $user->id;
        @endphp 
        <x-user.main.menu.menu :id="$id" activeSection="Профиль"/>
        <x-user.main.profile.profile :user="$user"/>
        <x-user.main.action.action :user="$user"/>
    </div>
</main>