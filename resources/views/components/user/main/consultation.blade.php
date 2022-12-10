<main class="main">
    <div class="profile__wrapper">
        @php 
        $id = $user->id;
        @endphp 
        <x-user.main.consultations.One :user="$user" :consult="$consult"/>
    </div>
</main>