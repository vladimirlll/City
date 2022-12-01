<main>
    <x-home.main.functionalities/>
    @php 

    $usersFromDB = [1, 2, 3, 4, 5, 6];

    @endphp
    <x-home.main.bestspecialists.section :users=$usersFromDB />
    <x-home.main.about.section />
    <x-home.main.contacts.section />
</main>