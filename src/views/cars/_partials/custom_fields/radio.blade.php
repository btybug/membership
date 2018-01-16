<fieldset class="bty-form-radio" id="bty-input-id-{!! $field['id'] !!}">
    <div>
        <div>
            <label>{!! $field['label'] !!}</label>
        </div>
        <div>
            @if(count(get_field_data($field['id'])))
                @foreach(get_field_data($field['id']) as $key => $item)
                    <input name="{!! $field['table_name']."_".$field['column_name'] !!}"  value="{{ $key }}" type="radio" class="bty-input-radio-1" id="bty-gender-form-{{ $key }}">
                    <label for="bty-gender-form-{{$key}}">{{$item}}</label>
                @endforeach
            @endif
        </div>
        <div class="bty-tooltip"><i class="fa fa-question" aria-hidden="true"></i>
            <span>Tooltip text</span>
        </div>
    </div>
</fieldset>