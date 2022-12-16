<main class="main">
    <div class="profile__wrapper">
        @php 
        $id = $user->id;
        @endphp 
        <x-user.main.menu.menu :id="$id" activeSection="Консультации"/>
        <x-user.main.consultations.All :user="$user"/>
        <x-user.main.action.action :user="$user"/>
    </div>
</main>