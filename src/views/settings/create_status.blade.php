@extends('btybug::layouts.admin')
@section('content')
    <div class="main_lay_cont">
        {!! Form::model($model) !!}
            <h2> {!! ($model) ? "Edit" : "Create" !!} Status</h2>
            <div class="form-group">
                <div class="col-md-3">
                    Status Title
                </div>
                <div class="col-md-9">
                    {!! Form::text('title',null,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    Status Description
                </div>
                <div class="col-md-9">
                    {!! Form::textarea('description',null,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    Status Icon
                </div>
                <div class="col-md-9">
                    {!! Form::text('icon',null,['class' => 'form-control icp']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@stop
@section('CSS')
    {!! HTML::style('public/css/bootstrap/css/bootstrap-switch.min.css') !!}
    {!! HTML::style('public/css/font-awesome/css/fontawesome-iconpicker.min.css') !!}
@stop
@section('JS')
    {!! HTML::script('public/css/font-awesome/js/fontawesome-iconpicker.min.js') !!}
    <script>
        $('.icp').iconpicker();
    </script>
@stop