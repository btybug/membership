@extends('btybug::layouts.admin')
@section('content')
    <div class="main_lay_cont">
        {!! Form::model($model,['class'=>'bty-form-4']) !!}
        @if($model)
            {!! Form::hidden('id',$model->id) !!}
        @endif
        <h2>Create Membership Type</h2>
        <fieldset class="bty-form-text">
            <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>General</legend>
            <div>
                {!! Form::text('title',old('title'),['class'=>'bty-input-label-6','placeholder'=>'Insert Title']) !!}
                <label>Title?</label>
            </div>
            <div>
                {!! Form::text('icon',old('icon'),['class'=>'bty-input-label-6','placeholder'=>'Insert class']) !!}
                <label>Icon?</label>
            </div>
        </fieldset>
        <fieldset class="bty-form-textarea">
            {!! Form::textarea('description',old('description'),['class'=>'bty-textarea-1','placeholder'=>'Description']) !!}
        </fieldset>
        <fieldset class="bty-form-text">
            <fieldset class="bty-form-radio">
                <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Is Active</legend>
                <div>
                    {!! Form::radio('is_active',1,true,['class'=>'bty-input-radio-1','id'=>'bty-gender-form-61']) !!}
                    <label for="bty-gender-form-61">Yes</label>
                    {!! Form::radio('is_active',0,false,['class'=>'bty-input-radio-1','id'=>'bty-gender-form-62']) !!}
                    <label for="bty-gender-form-62">No</label>
                </div>
            </fieldset>
        </fieldset>

        <button class="bty-btn bty-btn-save"><span>Save</span></button>
        {!! Form::close() !!}
    </div>
@stop
@section('CSS')

@stop
@section('JS')

@stop