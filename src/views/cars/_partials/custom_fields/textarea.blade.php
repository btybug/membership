<fieldset class="bty-form-textarea" id="bty-input-id-{!! $field['id'] !!}">
    {!! Form::textarea($field['table_name']."_".$field['column_name'],null,['class' => 'bty-textarea-1','placeholder' => $field['placeholder']]) !!}
</fieldset>