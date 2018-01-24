@extends('btybug::layouts.mTabs',['index'=>'cars_pages'])
<!-- Nav tabs -->
@section('tab')
    {!! Form::model($data) !!}
    <div class="col-md-6">
        <div class="form-horizontal">
            <fieldset>
                @foreach($options as $option)
                    <!-- Multiple Checkboxes -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="checkboxes">{!! strtoupper($option['name']) !!}</label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label for="{{ $option['name'] }}">
                                        <input type="hidden" name="{{ $option['name'] }}[is_active]" id="{{ $option['name'] }}" value="0">
                                        {!! Form::checkbox($option['name']."[is_active]",1,$data[$option['name']]['is_active']??false,['id'=>$option['name'],'data-role' => 'parent']) !!}
                                        Allow {!! strtoupper($option['name']) !!}
                                    </label>
                                </div>
                            </div>
                        </div>
                @endforeach
            </fieldset>
        </div>
    </div>
    <div class="col-md-6">
        @foreach($options as $option)
            <div class="form-horizontal {{ $option['name'] }}  @if( !isset($data[$option['name']]['is_active']) || $data[$option['name']]['is_active']!=1 ) hidden  @endif">
                <fieldset>
                    <!-- Multiple Checkboxes -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="checkboxes">Payment Options</label>
                        <div class="col-md-4">
                            @php
                                $fn = $option['options_function'];
                            @endphp
                            @if(is_callable($fn))
                                @php
                                    $list = $fn();
                                @endphp
                                @foreach($list as $item)
                                    <div class="checkbox">
                                        <label for="checkboxes-{!! $item['slug'] !!}">
                                            <input type="checkbox" name="{!! $option['name'] !!}[options][{!! $item['slug'] !!}]"
                                                   @if(isset($data[$option['name']]['options'][$item['slug']])) checked @endif
                                                   id="checkboxes-{!! $item['slug'] !!}" value="1">
                                            {!! $item['name'] !!}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </fieldset>
            </div>
        @endforeach
    </div>
    {!! Form::close() !!}
@stop
@section('CSS')
@stop
@section('JS')
    <script>
        $(function () {

            $('form').on('change','input[type=checkbox]', function () {
                optionSave(this);
            });
            function optionSave(item) {
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
                        var className =  $(item).attr('id');

                        if (!data.error) {
                            if($(item).attr('data-role') =='parent'){
                                if($(item).is(":checked")){
                                    $('.' + className).removeClass('hidden');
                                }else{
                                    $('.' + className).addClass('hidden');
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@stop
