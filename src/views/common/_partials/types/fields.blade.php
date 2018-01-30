<p>Fields</p>
@if(count($fields))
    @foreach($fields as $field)
        <div class="col-md-2">
            <p>
                <input type="checkbox" data-id="{!! $field->id !!}"
                       data-table="{!! $form->fields_type !!}"
                       value="{!! $field->column_name !!}"
                       name="fields_json[{!! $field->id !!}]"
                       {!! (! in_array($field->slug,$existingFields)) ?: "checked"  !!}
                       class="bty-input-checkbox-2 select-field"
                       id="bty-cbox-{{ $field->id }}">
                <label for="bty-cbox-{{ $field->id }}">{{ $field->name }}</label>
            </p>
        </div>
    @endforeach
@else
    No Columns Available
@endif