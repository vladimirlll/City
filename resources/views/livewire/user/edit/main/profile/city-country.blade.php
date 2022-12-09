@php 
use App\Models\City;
@endphp

<div>
    <div class="main__form__content__form__item">
        <label class="label label-input" for="country">Страна</label>
        <select wire:change="changeCountry" wire:model="countryId" name="country[]" id="country" class="form-input">
            @if(is_null($country))
                {{-- У пользователя не выбрана стран, просто выводим все страны --}}
                <option selected value="0" disabled>Выберите страну</option>
                @foreach ($countries as $countryItem)
                    <option value="{{$countryItem->id}}">{{$countryItem->name}}</option>
                @endforeach
            @else 
                {{-- У пользователя выбрана страна, выводим все страны с выбранной страной пользователя --}}
                <option value="0" disabled>Выберите страну</option>
                @foreach ($countries as $countryItem)
                    @if($country->id == $countryItem->id)
                        <option selected value="{{$countryItem->id}}">{{$countryItem->name}}</option>
                    @else 
                        <option value="{{$countryItem->id}}">{{$countryItem->name}}</option>
                    @endif 
                @endforeach
            @endif
        </select>
    </div>
    <div class="main__form__content__form__item">
        <label class="label label-input" for="city">Город</label>
        <select name="city[]" id="city" class="form-input">
            @if($countryId == 0)
                {{-- Страна не была выбрана --}}
                <option selected value="0" disabled>Выберите город</option>
            @else 
                {{-- У юзера есть свой город или страна выбрана через select --}}
                @if($city != null && $city->country_id == $countryId)
                    {{-- У юзера уже есть свой город --}}
                    @foreach($cities as $cityItem)
                        @if($cityItem->id == $city->id)
                            <option selected value="{{$cityItem->id}}">{{$cityItem->name}}</option>
                        @else 
                            <option value="{{$cityItem->id}}">{{$cityItem->name}}</option>
                        @endif
                    @endforeach
                @else 
                    {{--
                         У юзера нет свое города, но страна выбрана через select,
                         поэтому просто выводим все города этой страны
                    --}}
                    <option selected value="0" disabled>Выберите город</option>
                    @foreach($cities as $cityItem)
                        <option value="{{$cityItem->id}}">{{$cityItem->name}}</option>
                    @endforeach
                @endif 
            @endif 
        </select>
    </div>
</div>