@extends('btybug::layouts.admin')
@section('content')
    <div class="main_lay_cont">

        <form action="" class="bty-form-4">
            <h2>Create Plan</h2>
            <fieldset class="bty-form-text">
                <div>
                    <input class="bty-input-label-6" type="text" placeholder="Your name?">
                    <label>Name?</label>
                </div>
                <div>
                    <input class="bty-input-label-6" type="text" placeholder="Your email?">
                    <label>Email?</label>
                </div>
                <div>
                    <input class="bty-input-label-6" type="text" placeholder="Your Password?">
                    <label>Password?</label>
                </div>

            </fieldset>
            <button class="bty-btn bty-btn-save"><span>Save</span></button>
        </form>

    </div>
@stop
@section('CSS')

@stop
@section('JS')

@stop