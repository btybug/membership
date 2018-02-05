@extends('btybug::layouts.admin')
@section('content')
    <div class="main_lay_cont">
        {!! Form::model($model,['class' => 'form-horizontal']) !!}
        <h2> {!! ($model) ? "Edit" : "Create" !!} Status</h2>
        <div class="form-group m-t-15">
            <div class="col-md-3">
                Status Title
            </div>
            <div class="col-md-9">
                {!! Form::text('title',null,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group m-t-15">
            <div class="col-md-3">
                Status Description
            </div>
            <div class="col-md-9">
                {!! Form::textarea('description',null,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group m-t-15">
            <div class="col-md-3">
                Status Icon
            </div>
            <div class="col-md-9">
                {!! Form::text('icon',null,['class' => 'form-control icp']) !!}
            </div>
        </div>

        @if(! $model || $model->type != 'core')
            <div class="form-group m-t-15">
                <div class="col-md-3">
                    block these pages
                </div>
                <div class="col-md-9">
                    <div class="col-md-12">
                        all site pages
                        except {!! Form::radio('json_data[block_type]',0,true,['class' => 'block_pages_radio']) !!}
                        only these
                        pages {!! Form::radio('json_data[block_type]',1,null,['class' => 'block_pages_radio']) !!}
                    </div>
                    <div class="col-md-12 m-t-15">
                        {!! Form::select('json_data[pages][]',get_frontend_pages_pluck(true),null,['class' => 'form-control front_pages','multiple' => true]) !!}
                    </div>
                </div>
            </div>
        @endif

        <div class="form-group m-t-15">
            <div class="col-md-12">
                {!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
@section('CSS')
    {!! HTML::style('public/css/bootstrap/css/bootstrap-switch.min.css') !!}
    {!! HTML::style('public/css/font-awesome/css/fontawesome-iconpicker.min.css') !!}
    {!! HTML::style('public/css/select2/select2.min.css') !!}

@stop
@section('JS')
    {!! HTML::script('public/css/font-awesome/js/fontawesome-iconpicker.min.js') !!}
    {!! HTML::script('public/js/select2/select2.full.min.js') !!}
    <script>
        $('.icp').iconpicker();
        $('.front_pages').select2();
        $('input.block_pages_radio').change(function () {
            $('.front_pages').select2("val", "");
        });
    </script>
@stop