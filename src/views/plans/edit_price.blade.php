@extends('btybug::layouts.mTabs',['index'=>'create_product','id'=>$id])
<!-- Nav tabs -->
@section('tab')
    {!! Form::model($plan,['class'=>'form-horizontal','url'=>route('mbsp_plans_edit_save',$plan->id)]) !!}

    <fieldset>

        <!-- Form Name -->
        <legend>Edit Plan Price {!! $plan->name !!}</legend>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="amount">Select Price Plans </label>
            <div class="col-md-4">
                {!! Form::select('amount',[null=>'No Price'],null,['class'=>'form-control','id'=>'amount']) !!}
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

@stop
@section('CSS')

@stop
@section('JS')

@stop