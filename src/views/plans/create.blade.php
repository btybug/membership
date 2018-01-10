@extends('btybug::layouts.admin')
@section('content')
    <div class="main_lay_cont">

        <form action="" class="bty-form-4" method="post" action="{{route('mbsp_plans_create_save')}}">
            {{csrf_field()}}
            <h2>Create Plan</h2>
            <fieldset class="bty-form-text">
                <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>General</legend>
                <div>
                    <input class="bty-input-label-6" name="title" type="text" placeholder="Insert Title" value="{{old('title')}}">
                    <label>Title?</label>
                </div>
                <div>
                    <input class="bty-input-label-6" name="price" type="number" min="1" placeholder="Insert Price" value="{{old('price')}}">
                    <label>Price?</label>
                </div>
                <div>
                    <input class="bty-input-label-6" name="period" type="number" placeholder="Insert Period" value="{{old('period')}}">
                    <label>Period?</label>
                </div>
            </fieldset>
            <fieldset class="bty-form-textarea">
                <textarea id="bio" placeholder="Description" name="description" class="bty-textarea-1">{{old('description')}}</textarea>
            </fieldset>
            <fieldset class="bty-form-select">
                <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Period Type</legend>
                <div class="bty-input-select-3">
                    <select name="period_type" {{old('period_type')}}>
                        <option>day</option>
                        <option>week</option>
                        <option>month</option>
                    </select>
                </div>
            </fieldset>
            <fieldset class="bty-form-text">
                <div>
                    <input class="bty-input-label-6" name="currency" type="text" placeholder="Insert Currency" value="{{old('currency')}}">
                    <label>Currency?</label>
                </div>
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