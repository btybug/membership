@extends('btybug::layouts.mTabs',['index'=>'create_product','id'=>$id])
<!-- Nav tabs -->
@section('tab')
    {!! Form::model($plan,['class'=>'bty-form-5','url'=>route('mbsp_plans_edit_save',$plan->id)]) !!}
    <h2 class="form-title">Create Post</h2>
    <div class="field-box">
        <fieldset class="bty-form-text" id="bty-input-id-11">
            <div>
                {!! Form::text('plan_id',null,['class'=>'bty-input-label-5','placeholder'=>'my-plan']) !!}
                <label>Plan ID</label>
            </div>
        </fieldset>
        <fieldset class="bty-form-text" id="bty-input-id-11">
            <div>
                {!! Form::text('name',null,['class'=>'bty-input-label-5','placeholder'=>'Pro+']) !!}
                <label>Plan Name</label>
            </div>
        </fieldset>
        <fieldset class="bty-form-text" id="bty-input-id-11">
            <div>
                {!! Form::text('amount',null,['class'=>'bty-input-label-5','placeholder'=>'my-plan']) !!}
                <label>Plan Amount</label>
            </div>
        </fieldset>
        <fieldset class="bty-form-text" id="bty-input-id-11">
            <div class="bty-input-select-5">
                {!! Form::select('currency',['usd'=>'USD','eur'=>'EUR','amd'=>'AMD']) !!}
                <label>Currency</label>
            </div>
        </fieldset>
        <fieldset class="bty-form-text">
            <div>
                {!! Form::number('interval_count',null,['class'=>'bty-input-label-5','placeholder'=>'1']) !!}
                <label>Interval Count?</label>
            </div>
            <div>
                <div class="bty-input-select-5">
                    {!! Form::select('interval',['day'=>'daily','month'=>'monthly','year'=>'yearly','week','weekly']) !!}
                </div>
                <lable>Interval</lable>

            </div>
        </fieldset>

        <fieldset class="bty-form-text" id="bty-input-id-11">
            <div>
                {!! Form::text('plan_id',null,['class'=>'bty-input-label-5','placeholder'=>'my-plan']) !!}
                <label>Plan ID</label>
            </div>
        </fieldset>

    </div>
    <fieldset class="bty-form-textarea" id="bty-input-id-10">
        {!! Form::textarea('statement_descriptor',null,['class'=>'bty-textarea-1']) !!}
        <label>Description</label>
    </fieldset>
        <fieldset class="bty-form-radio">
            <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Is Active</legend>
            <div>
                {!! Form::radio('is_active',1,1,['class']) !!}
                <input name="is_active" value="1" type="radio" class="bty-input-radio-1"
                       id="bty-gender-form-61" checked>
                <label for="bty-gender-form-61">Yes</label>
                <input name="is_active" value="0" type="radio" class="bty-input-radio-1"
                       id="bty-gender-form-62">
                <label for="bty-gender-form-62">No</label>
            </div>
        </fieldset>

    <button type="submit" class="bty-btn bty-btn-save"><span>Save</span></button>
    </div>
    {!! Form::close() !!}

@stop
@section('CSS')

@stop
@section('JS')

@stop