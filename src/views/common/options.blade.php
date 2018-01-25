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
                            <label class="col-md-4 control-label" for="checkboxes">{!! str_replace('_',' ',ucfirst($option['name'])) !!}</label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label for="{{ $option['name'] }}">
                                        <input type="hidden" name="{{ $option['name'] }}[is_active]" id="{{ $option['name'] }}" value="0">
                                        {!! Form::checkbox($option['name']."[is_active]",1,$data[$option['name']]['is_active']??false,['id'=>$option['name'],'data-role' => 'parent']) !!}
                                        Allow {!! str_replace('_',' ',ucfirst($option['name'])) !!}
                                        @if(isset($option['tab']))
                                            {!! Form::hidden($option['name']."[tab]",$option['tab']) !!}
                                        @endif
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
                        <label class="col-md-4 control-label" for="checkboxes">{!! str_replace('_',' ',ucfirst($option['name'])) !!} Options</label>
                        <div class="col-md-4">
                            @php
                                $fn = $option['options_function'];
                            @endphp
                            @if(is_callable($fn))
                                @php
                                    $list = $fn();
                                @endphp
                                @foreach($list as $item)
                                    @if(isset($item['type']) && $item['type'] == 'radio')
                                        <div class="radio">
                                            <label for="radios-{!! $item['slug'] !!}">
                                                <input type="radio" name="{!! $option['name'] !!}[options][{!! $item['group'] !!}]"
                                                       @if(isset($data[$option['name']]['options'][$item['group']])
                                                       && $data[$option['name']]['options'][$item['group']] == $item['slug']) checked @endif
                                                       id="radios-{!! $item['slug'] !!}" value="{!!  $item['slug'] !!}" >
                                                {!! $item['name'] !!} - {!! str_replace('_',' ',ucfirst($item['slug'])) !!}
                                            </label>
                                        </div>
                                    @else
                                        <div class="checkbox">
                                            <label for="checkboxes-{!! $item['slug'] !!}">
                                                <input type="checkbox" name="{!! $option['name'] !!}[options][{!! $item['slug'] !!}]"
                                                       @if(isset($data[$option['name']]['options'][$item['slug']])) checked @endif
                                                       id="checkboxes-{!! $item['slug'] !!}" value="1">
                                                {!! $item['name'] !!}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </fieldset>
            </div>
        @endforeach
    </div>
    {!! Form::close() !!}
    {{--<div class="col-md-12">--}}
    {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading" role="tab">--}}
            {{--<h4 class="panel-title">Tax & services</h4>--}}
        {{--</div>--}}
        {{--<div class="panel-body">--}}
        {{--<div class="form-horizontal">--}}

        {{--<!-- Multiple Radios -->--}}
            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label" for="radios">Insert Product Price</label>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="radio">--}}
                        {{--<label for="radios-0">--}}
                            {{--<input type="radio" name="radios" id="radios-0" value="1" checked="checked">--}}
                             {{--INCLUDE Tax--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="radio">--}}
                        {{--<label for="radios-1">--}}
                            {{--<input type="radio" name="radios" id="radios-1" value="2">--}}
                             {{--EXCLUDE Tax--}}
                        {{--</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<label class="col-md-4 control-label" for="radios">Display Product Price</label>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="radio">--}}
                        {{--<label for="radios-0">--}}
                            {{--<input type="radio" name="radios" id="radios-0" value="1" checked="checked">--}}
                             {{--include Tax--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="radio">--}}
                        {{--<label for="radios-1">--}}
                            {{--<input type="radio" name="radios" id="radios-1" value="2">--}}
                             {{--exclude Tax--}}
                        {{--</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--{!! Form::submit("Save",['class' => 'btn settingBtn pull-right']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@stop
@section('CSS')
@stop
@section('JS')
    <script>
        $(function () {

            $('form').on('change','input[type=checkbox],input[type=radio]', function () {
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
