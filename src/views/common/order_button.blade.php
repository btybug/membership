@extends('btybug::layouts.mTabs',['index'=>'cars_pages'])
<!-- Nav tabs -->
@section('tab')
    {!! Form::open() !!}
    {!! Form::hidden('slug',$slug) !!}
    <div class="form-horizontal">
        <fieldset>
            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes">Fields</label>
                <div class="col-md-4">
                    @foreach($columns as $column)
                        <div class="checkbox">
                            <label for="allow_price">
                                {!! Form::checkbox($column->Field,1,isset($settings[$column->Field]),['id'=>$column->Field]) !!}
                                {!! $column->Field !!}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </fieldset>
    </div>
    {!! Form::close() !!}
@stop
@section('CSS')
@stop
@section('JS')
    <script>
        $(function () {

            $('form').on('change', 'input[type=checkbox]', function () {
                optionSave();
            });

            function optionSave() {
                var data = $('form').serialize();
                $.ajax({
                    type: "post",
                    datatype: "json",
                    url: '{!! route('mbsp_save_order_button',$slug) !!}',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {

                    }
                });
            }
        });
    </script>
@stop
