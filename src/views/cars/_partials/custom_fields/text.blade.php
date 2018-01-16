<fieldset class="bty-form-text" id="bty-input-id-{!! $field['id'] !!}">
    <div>
        {!! Form::text($field['table_name']."_".$field['column_name'],null,['class' => 'bty-input-label-5','placeholder' => $field['placeholder']]) !!}
        <label>{!! $field['label'] !!}</label>
    </div>
</fieldset>

