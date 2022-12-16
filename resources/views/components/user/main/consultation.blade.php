<main class="main">
    <div class="profile__wrapper">
        @php 
        $id = $user->id;
        @endphp 
        <x-user.main.menu.menu :id="$id" activeSection="Консультации"/>
        <x-user.main.consultations.One :user="$user" :consult="$consult"/>
        <x-user.main.action.action :user="$user"/>
    </div>
</main>