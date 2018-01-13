@extends('btybug::layouts.mTabs',['index'=>'create_product','id'=>$id])
<!-- Nav tabs -->
@section('tab')
    {!! Form::model($plan,['class'=>'form-horizontal','url'=>route('mbsp_plans_edit_save',$plan->id)]) !!}

        <fieldset>

            <!-- Form Name -->
            <legend>Edit Plan {!! $plan->name !!}</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="plan_id">Plan ID</label>
                <div class="col-md-4">
                    {!! Form::text('plan_id',null,['class'=>'form-control input-md','placeholder'=>'my-plan','id'=>'plan_id']) !!}
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="plan_name">Plan Name</label>
                <div class="col-md-4">
                    {!! Form::text('name',null,['class'=>'form-control input-md','placeholder'=>'my-plan','id'=>'plan_name']) !!}
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="plan_amount">Plan Amount</label>
                <div class="col-md-4">
                    {!! Form::number('plan_amount',null,['class'=>'form-control input-md','placeholder'=>'my-plan','id'=>'plan_amount']) !!}
                </div>
            </div>
            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="currency">Currency</label>
                <div class="col-md-4">
                    {!! Form::select('currency',['usd'=>'USD','eur'=>'EUR','amd'=>'AMD'],null,['class'=>'form-control','id'=>'currency']) !!}

                </div>
            </div>
            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="interval">Interval</label>
                <div class="col-md-4">
                    {!! Form::select('interval',['day'=>'daily','month'=>'monthly','year'=>'yearly','week','weekly'],null,['class'=>'form-control','id'=>'interval']) !!}
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="interval_count">Interval Count</label>
                <div class="col-md-4">
                    {!! Form::number('interval_count',1,['class'=>'form-control input-md','placeholder'=>'1','id'=>'interval_count']) !!}
                </div>
            </div>

            <!-- Textarea -->
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
            <input type="submit" id="singlebutton"  class="btn btn-primary">Save</input>
        </div>
    </div>
        </fieldset>
{!! Form::close() !!}

@stop
@section('CSS')

@stop
@section('JS')

@stop