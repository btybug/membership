@extends('btybug::layouts.mTabs',['index'=>'cars_pages'])
<!-- Nav tabs -->
@section('tab')
    <div class="col-md-6">
        <div class="form-horizontal">
            <fieldset>
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="checkboxes">Payments</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label for="allow_price">
                                <input type="checkbox" name="allow_price" id="allow_price" value="1">
                                Allow price
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-horizontal options hidden">
            <fieldset>
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="checkboxes">Payment Options</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label for="checkboxes-0">
                                <input type="checkbox" name="simple_price" id="checkboxes-0" value="1">
                               Simple Price
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="checkboxes-1">
                                <input type="checkbox" name="checkboxes" id="checkboxes-1" value="2">
                                Quantiti based price
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="checkboxes-2">
                                <input type="checkbox" name="attribute" id="checkboxes-3" value="2">
                                Attribute based price
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="checkboxes-2">
                                <input type="checkbox" name="attribute" id="checkboxes-4" value="2">
                                ..........
                            </label>
                        </div>
                    </div>
                </div>

            </fieldset>
        </div>
    </div>
@stop
@section('CSS')
@stop
@section('JS')
    <script>
        $(function () {
            $('#allow_price').on('change', function () {

                if (this.checked) {
                    $('.options').removeClass('hidden')
                } else {
                    $('.options').addClass('hidden')
                }
            })
        })
    </script>
@stop
