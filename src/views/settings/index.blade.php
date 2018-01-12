@extends('btybug::layouts.mTabs',['index'=>'mb_settings'])
<!-- Nav tabs -->
@section('tab')
    <div class="main_lay_cont">
    <div class="col-md-5">
        {!! Form::open(['url'=>route('mbsp_settings_save_pricing_page')]) !!}
        <div class="bty-panel-collapse">

            <div>
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true">
                    <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                    <span class="title">Pricing page settings</span>
                </a>
            </div>
            <div id="collapseOne" class="collapse in" aria-expanded="true" style="">
                <div class="content">
                    {!! BBbutton2('unit','pricing','products','Select pricing unit') !!}
                </div>
            </div>
            <div class="col-md-3">
                <button type="submit" class="bty-btn bty-btn-save"><span>Save</span></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    </div>
    @include('resources::assests.magicModal')
@stop
@section('CSS')
@stop
@section('JS')
    {!! HTML::script("public/js/UiElements/bb_styles.js?v.5") !!}
@stop
