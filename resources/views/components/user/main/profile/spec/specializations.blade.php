@php 

use App\Models\Specialization_User;
use App\Models\Specialization;

@endphp 

@if (!empty($specializationsOfUserConnectors))
@php

$specializations = [];
$specializationsStr = "";

foreach($specializationsOfUserConnectors as $connector)
{
    $spec = Specialization::find($connector->specialization_id);
    $specializations[] = $spec->name;
}

$specializationsStr = implode(',', $specializations);

@endphp 
<hr>
<div class="profile__data__spec__item specializations">
    <h3 class="profile__data__spec__item__title">Специализации</h3>
    <p class="specializations__text">
        {{$specializationsStr}}
    </p>
</div>

@endif 
