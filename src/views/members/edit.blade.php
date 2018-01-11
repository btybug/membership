@extends('btybug::layouts.admin')
@section('content')
    <div class="main_lay_cont">
        {!! Form::model($user,['class'=>'bty-form-4']) !!}
        @if($user)
            {!! Form::hidden('id',$user->id) !!}
        @endif
        <h2>Edit User Membership Type</h2>
        <fieldset class="bty-form-select">
            <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Select Membership</legend>
            <div class="bty-input-select-3">
                {!! Form::select('membership_type_id',$mb_types) !!}
            </div>
        </fieldset>
        <fieldset class="bty-form-select">
            <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>User Status</legend>
            <div class="bty-input-select-3">
                {!! Form::select('status_id',$mb_status) !!}
            </div>
        </fieldset>
        <button class="bty-btn bty-btn-save"><span>Save</span></button>
        {!! Form::close() !!}
    </div>
@stop
@section('CSS')

@stop
@section('JS')

@stop