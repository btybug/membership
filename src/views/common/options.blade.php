@extends('btybug::layouts.mTabs',['index'=>'cars_pages'])
<!-- Nav tabs -->
@section('tab')
    {!! Form::model($data) !!}
    <div class="col-md-6">
        <div class="form-horizontal">
            <fieldset>
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="checkboxes">Payments</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label for="allow_price">

                                <input type="hidden" name="allow_price" id="allow_price" value="0">
                                {!! Form::checkbox('allow_price',1,$data['allow_price']??false,['id'=>'allow_price']) !!}
                                Allow price
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-horizontal options  @if( !isset($data['allow_price']) || $data['allow_price']!=1 ) hidden  @endif">
            <fieldset>
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="checkboxes">Payment Options</label>
                    <div class="col-md-4">
                        @foreach($options as $option)
                        <div class="checkbox">
                            <label for="checkboxes-{!! $option['slug'] !!}">
                                <input type="checkbox" name="options[{!! $option['slug'] !!}]" @if($option['checked']) checked @endif id="checkboxes-{!! $option['slug'] !!}" value="1">
                                {!! $option['name'] !!}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

            </fieldset>
        </div>
    </div>
    {!! Form::close() !!}
@stop
@section('CSS')
@stop
@section('JS')
    <script>
        $(function () {

            $('form').on('change','input[type=checkbox]', function () {
                optionSave();
            });
            function optionSave() {
                var data=$('form').serialize();
                $.ajax({
                    type: "post",
                    datatype: "json",
                    url: '{!! route('mbsp_settings_mb_save_options',$slug) !!}',
                    data:data,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {
                        if (!data.error && data.flag) {
                            $('.options').removeClass('hidden');
                        } else {
                            $('.options').addClass('hidden');
                        }
                    }
                });
            }
        });
    </script>
@stop
