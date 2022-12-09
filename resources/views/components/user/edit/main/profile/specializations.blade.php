<div class="main__form__content__form__item">
    <label class="label label-input" for="spec">Специализации</label>
    <select multiple name="spec[]" id="spec" class="selectpicker" aria-label="size 3 select example" data-live-search="true" title="Выберите специализации" data-width="100%">
        @foreach($specs as $spec)
            @if(
                $userSpecs->contains(function($value, $key) use($spec)
                {
                    return $value->specialization_id == $spec->id;
                })
                )
                <option selected data-tokens="{{$spec->name}}" value="{{$spec->id}}">{{$spec->name}}</option>
            @else 
                <option data-tokens="{{$spec->name}}" value="{{$spec->id}}">{{$spec->name}}</option>
            @endif
        @endforeach
    </select>
</div>