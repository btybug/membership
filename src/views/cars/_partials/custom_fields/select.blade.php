<fieldset class="bty-form-select" id="bty-input-id-{!! $field['id'] !!}">
    <div class="bty-input-select-1">
        {!! Form::select($field['table_name']."_".$field['column_name'],get_field_data($field['id']),null,['placeholder' => $field['placeholder'],'class' => 'form-control input-md']) !!}
    </div>
</fieldset>