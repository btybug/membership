@extends('btybug::layouts.mTabs',['index'=>'cars_pages'])
<!-- Nav tabs -->
@section('tab')
    <div class="form-horizontal">
        <fieldset>
            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes">Fields</label>
                <div class="col-md-4">
                    @foreach($columns as $column)
                    <div class="checkbox">
                        <label for="allow_price">
                            {!! Form::checkbox($column->Field,1,false,['id'=>$column->Field]) !!}
                           {!! $column->Field !!}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </fieldset>
    </div>
@stop
@section('CSS')
@stop
@section('JS')
@stop
