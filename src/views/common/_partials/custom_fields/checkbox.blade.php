<fieldset class="bty-form-checkbox" id="bty-input-id-{!! $field['id'] !!}">
    <div>
        <div>
            <label>{!! $field['label'] !!}</label>
        </div>
        <div>
            <div>
                @if(count(get_field_data($field['id'])))
                    @foreach(get_field_data($field['id']) as $key => $item)
                        <p>
                            <input name="{!! $field['table_name']."_".$field['column_name'] !!}" value="{{ $key }}" type="checkbox" class="bty-input-checkbox-2" id="bty-cbox-{{ $key }}">
                            <label for="bty-cbox-{{ $key }}">{{ $item }}</label>
                        </p>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="bty-tooltip"><i class="fa fa-question" aria-hidden="true"></i>
            <span>Tooltip text</span>
        </div>
    </div>
</fieldset>