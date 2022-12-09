<div class="main__form__content__form__item">
    <label class="label label-input" for="skill">Навыки</label>
    <select name="skill[]" id="skill" class="selectpicker" multiple aria-label="size 3 select example" data-live-search="true" title="Выберите навыки" data-width="100%">
        @foreach($skills as $skill)
            @if(
                $userSkills->contains(function($value, $key) use($skill)
                {
                    return $value->skill_id == $skill->id;
                })
                )
                <option selected data-tokens="{{$skill->name}}" value="{{$skill->id}}">{{$skill->name}}</option>
            @else 
                <option data-tokens="{{$skill->name}}" value="{{$skill->id}}">{{$skill->name}}</option>
            @endif
        @endforeach
    </select>
</div>