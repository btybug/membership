@extends('btybug::layouts.mTabs',['index'=>'create_product'])
<!-- Nav tabs -->
@section('tab')
    <div class="main_lay_cont">
        {!! Form::open(['class'=>'form-horizontal','url'=>route('mbsp_plans_create_save')]) !!}

        <fieldset>

            <!-- Form Name -->
            <legend>Create Plan</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="plan_name">Plan Name</label>
                <div class="col-md-4">
                    {!! Form::text('name',null,['class'=>'form-control input-md','placeholder'=>'my-plan','id'=>'plan_name']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="feature_1">Feature 1</label>
                <div class="col-md-4">
                    {!! Form::text('feature_1',null,['class'=>'form-control input-md','placeholder'=>'','id'=>'feature_1']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="plan_name">Feature 2</label>
                <div class="col-md-4">
                    {!! Form::text('feature_2',null,['class'=>'form-control input-md','placeholder'=>'','id'=>'feature_2']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="image">Product Image</label>
                <div class="col-md-4">
                    {!! Form::file('image',null,['class'=>'form-control input-md','placeholder'=>'','id'=>'image']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="short_descriptor">Short Description</label>
                <div class="col-md-4">
                    {!! Form::textarea('short_descriptor',null,['class'=>'form-control','id'=>'short_descriptor']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="statement_descriptor">Description</label>
                <div class="col-md-4">
                    {!! Form::textarea('statement_descriptor',null,['class'=>'form-control','id'=>'statement_descriptor']) !!}
                </div>
            </div>

            <!-- Multiple Radios (inline) -->
            <div class="form-group">

                <label class="col-md-4 control-label" for="radios">Is Active</label>
                <div class="col-md-4">
                    <label class="radio-inline" for="radios-0">
                        {!! Form::radio('is_active',1,1,['id'=>'radio-0']) !!}
                        Yes
                    </label>
                    <label class="radio-inline" for="radios-1">
                        {!! Form::radio('is_active',0,1,['id'=>'radio-1']) !!}
                        No
                    </label>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <div class="col-md-4">
                    <input type="submit" id="singlebutton" class="btn btn-primary">
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}

    </div>
@stop
@section('CSS')

@stop
@section('JS')

@stop