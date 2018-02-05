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
