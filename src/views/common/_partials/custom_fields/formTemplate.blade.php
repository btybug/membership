<div class="col-md-12">
    @include('mbshp::common._partials.custom_fields.fheader')
    <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @if(count($data))
                @foreach($data as $key => $value)
                    <li class="nav-item {{ ($loop->first) ? 'active' : null }}">
                        <a class="nav-link" id="pills-link-{{ $value['name'] }}" data-toggle="pill"
                           href="#pills-{{  $value['name'] }}"
                           role="tab"
                           aria-controls="pills-{{  $value['name'] }}" aria-selected="true">{{  $value['name'] }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="tab-content" id="pills-tabContent">
            {{--<div class="tab-pane active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">--}}
            {{--<div class="field-box">--}}
            {{--{!! $fieldHtml !!}--}}
            {{--</div>--}}
            {{--</div>--}}

            @if(count($data))
                @foreach($data as $key => $value)
                    <div class="tab-pane  {{ ($loop->first) ? 'active' : null }}" id="pills-{{ $value['name'] }}"
                         role="tabpanel"
                         aria-labelledby="pills-{{ $value['name'] }}-tab">
                        @if(isset($value['data']))
                            @foreach($value['data'] as $item)
                                @if($item['type'] == 'unit')
                                    {!! BBRenderUnits($item['value']) !!}
                                @else
                                    {!! $item['value'] !!}
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach
            @endif

            @if(count($data))
                @foreach($data as $key => $value)
                    @if($value['is_active'] && !isset($value['tab']))
                        <div class="tab-pane" id="pills-{{ $key }}" role="tabpanel"
                             aria-labelledby="pills-{{ $key }}-tab">
                            @php
                                $options = get_options_data($key,$slug)
                            @endphp
                            <fieldset class="bty-form-select" id="bty-input-id-16">
                                <div class="bty-input-select-1">
                                    <select data-type="{!! $key !!}" class="form-control input-md select-option-type"
                                            id="select-{{ $key }}">
                                        <option selected="selected" value="">Select {!! strtoupper($key) !!}</option>
                                        @foreach($options as $k => $option)
                                            <option value="{!! $k !!}">{!! str_replace('_',' ',$k) !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            <div class="select-{{ $key }}">

                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    @include('mbshp::common._partials.custom_fields.ffooter')
</div>
<script>
    $('body').on('change', '.select-option-type', function () {
        var type = $(this).data('type');
        var value = $(this).val();
        if (value != '' && value != undefined) {
            $.ajax({
                type: "post",
                datatype: "json",
                url: '{!! route('mbsp_settings_mb_get_option',$slug) !!}',
                data: {type: type, value: value},
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                },
                success: function (data) {
                    $('.select-' + type).html(data);
                }
            });
        }
    });
</script>
