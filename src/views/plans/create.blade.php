@extends('btybug::layouts.admin')
@section('content')
    <div class="main_lay_cont">

        <form action="" class="bty-form-4" method="post" action="{{route('mbsp_plans_create_save')}}">
            {{csrf_field()}}
            <h2>Create Plan</h2>
            <fieldset class="bty-form-text">
                <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>General</legend>
                <div>
                    <input class="bty-input-label-6" name="plan_id" type="text" placeholder="Insert a unique identifier"
                           value="{{old('plan_id')}}">
                    <label>ID?</label>
                </div>
                <div>
                    <input class="bty-input-label-6" name="name" type="text" placeholder="Insert Title"
                           value="{{old('name')}}">
                    <label>Name?</label>
                </div>

                <div>
                    <input class="bty-input-label-6" name="amount" type="number" min="1" placeholder="Insert Amount"
                           value="{{old('amount')}}">
                    <label>Amount?</label>
                </div>
                <div>
                    <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Currency</legend>
                    <div class="bty-input-select-3">
                        <select name="currency" {{old('currency')}}>
                            <option value="usd">USD</option>
                            <option value="eur">EUR</option>
                            <option value="amd">AMD</option>
                        </select>
                    </div>
                </div>


            </fieldset>
            <fieldset class="bty-form-textarea">
                <textarea id="bio" placeholder="Description" name="statement_descriptor"
                          class="bty-textarea-1">{{old('statement_descriptor')}}</textarea>
            </fieldset>
            <fieldset class="bty-form-text">
                <div>

                    <input class="bty-input-label-6" name="interval_count" type="number"
                           placeholder="Insert interval count" value="{{old('interval_count')}}">
                    <label>Interval Count?</label>
                </div>
                <div>
                    <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Interval</legend>
                    <div class="bty-input-select-3">
                        <select name="interval">
                            <option value="day">daily</option>
                            <option value="month">monthly</option>
                            <option value="year">yearly</option>
                            <option value="week">weekly</option>
                        </select>
                    </div>
                </div>
            </fieldset>


            <fieldset class="bty-form-text">
                <fieldset class="bty-form-radio">
                    <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Is Active</legend>
                    <div>
                        <input name="is_active" value="1" type="radio" class="bty-input-radio-1"
                               id="bty-gender-form-61" checked>
                        <label for="bty-gender-form-61">Yes</label>
                        <input name="is_active" value="0" type="radio" class="bty-input-radio-1"
                               id="bty-gender-form-62">
                        <label for="bty-gender-form-62">No</label>
                    </div>
                </fieldset>
            </fieldset>

            <button class="bty-btn bty-btn-save"><span>Save</span></button>
        </form>

    </div>
@stop
@section('CSS')

@stop
@section('JS')

@stop