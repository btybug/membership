@extends('btybug::layouts.mTabs',['index'=>'mb_settings'])
<!-- Nav tabs -->
@section('tab')
    <div class="main_lay_cont">
    <div class="col-md-5">
       
    </div>
    </div>
    @include('resources::assests.magicModal')
@stop
@section('CSS')
@stop
@section('JS')
    {!! HTML::script("public/js/UiElements/bb_styles.js?v.5") !!}
@stop
