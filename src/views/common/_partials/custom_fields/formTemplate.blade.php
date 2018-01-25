<div class="col-md-12">
    @include('mbshp::common._partials.custom_fields.fheader')
    <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-general" role="tab"
                   aria-controls="pills-general" aria-selected="true">General</a>
            </li>
            @if(count($data))
                @foreach($data as $key => $value)
                    @if($value['is_active'] && ! isset($value['tab']))
                        <li class="nav-item">
                            <a class="nav-link" id="pills-link-{{ $key }}" data-toggle="pill" href="#pills-{{ $key }}"
                               role="tab"
                               aria-controls="pills-{{ $key }}" aria-selected="true">{{ ucfirst(camel_case($key)) }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
            <li class="nav-item">
                <a class="nav-link" id="pills-other-tab" data-toggle="pill" href="#pills-other" role="tab"
                   aria-controls="pills-other" aria-selected="true">Others</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
                <div class="field-box">
                    {!! $fieldHtml !!}
                </div>
            </div>
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
                                    <select data-type="{!! $key !!}" class="form-control input-md select-option-type" id="select-{{ $key }}">
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
            <div class="tab-pane" id="pills-other" role="tabpanel" aria-labelledby="pills-other-tab">
                <div class="other-box">
                    @if(count($data))
                        @foreach($data as $key => $value)
                            @if($value['is_active'] && isset($value['tab']) && $value['tab'] == 'others')
                                @php
                                    $options = get_options_data($key,$slug)
                                @endphp
                                <fieldset class="bty-form-select" id="bty-input-id-16">
                                    <div class="bty-input-select-1">
                                        <select data-type="{!! $key !!}" class="form-control input-md select-option-type" id="select-{{ $key }}">
                                            <option selected="selected" value="">Select {!! strtoupper(str_replace('_',' ',$key)) !!}</option>
                                            @foreach($options as $k => $option)
                                                @if($option !== 1)
                                                    <option value="{!! $option !!}">{!! str_replace('_',' ',$option) !!}</option>
                                                @else
                                                    <option value="{!! $k !!}">{!! str_replace('_',' ',$k) !!}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </fieldset>
                                <div class="select-{{ $key }}">

                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('mbshp::common._partials.custom_fields.ffooter')
</div>
<script>
    $('body').on('change','.select-option-type',function () {
        var type = $(this).data('type');
        var value = $(this).val();
        if(value != '' && value != undefined){
            $.ajax({
                type: "post",
                datatype: "json",
                url: '{!! route('mbsp_settings_mb_get_option',$slug) !!}',
                data:{type: type,value: value},
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
