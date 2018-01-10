@extends('btybug::layouts.admin')
@section('content')
    <div class="main_lay_cont">

        <form class="bty-form-4" method="post" action="{{route('mbsp_plans_edit_save',$plan->id)}}">
            {{csrf_field()}}
            <h2>Create Plan</h2>
            <fieldset class="bty-form-text">
                <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>General</legend>
                <div>
                    <input class="bty-input-label-6" name="title" type="text" placeholder="Insert Title" value="{{$plan->title}}">
                    <label>Title?</label>
                </div>
                <div>
                    <input class="bty-input-label-6" name="price" type="number" min="1" placeholder="Insert Price" value="{{$plan->price}}" disabled="disabled">
                    <label>Price?</label>
                </div>
                <div>
                    <input class="bty-input-label-6" name="period" type="number" placeholder="Insert Period" value="{{$plan->period}}" disabled="disabled">
                    <label>Period?</label>
                </div>
            </fieldset>
            <fieldset class="bty-form-textarea">
                <textarea id="bio" placeholder="Description" name="description" class="bty-textarea-1">{{$plan->description}}</textarea>
            </fieldset>
            <fieldset class="bty-form-select">
                <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Period Type</legend>
                <div class="bty-input-select-3">
                    <select name="period_type" disabled="disabled">
                        <option {{$plan->period_type == 'day' ? 'selected' : ''}}>day</option>
                        <option {{$plan->period_type == 'week' ? 'selected' : ''}}>week</option>
                        <option {{$plan->period_type == 'month' ? 'selected' : ''}}>month</option>
                    </select>
                </div>
            </fieldset>
            <fieldset class="bty-form-text">
                <div>
                    <input class="bty-input-label-6" name="currency" type="text" placeholder="Insert Currency" value="{{$plan->currency}}">
                    <label>Currency?</label>
                </div>
                <fieldset class="bty-form-radio">
                    <legend><span><i class="fa fa-info" aria-hidden="true"></i></span>Is Active</legend>
                    <div>
                        <input name="is_active" value="1" type="radio" class="bty-input-radio-1"
                               id="bty-gender-form-61" {{$plan->is_active == 1 ? 'checked' : ''}}>
                        <label for="bty-gender-form-61">Yes</label>
                        <input name="is_active" value="0" type="radio" class="bty-input-radio-1"
                               id="bty-gender-form-62" {{$plan->is_active == 0 ? 'checked' : ''}}>
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