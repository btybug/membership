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
                    @if($value['is_active'])
                        <li class="nav-item">
                            <a class="nav-link" id="pills-link-{{ $key }}" data-toggle="pill" href="#pills-{{ $key }}"
                               role="tab"
                               aria-controls="pills-{{ $key }}" aria-selected="true">{{ camel_case($key) }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
                <div class="field-box">
                    {!! $fieldHtml !!}
                </div>
            </div>
            @if(count($data))
                @foreach($data as $key => $value)
                    @if($value['is_active'])
                        <div class="tab-pane" id="pills-{{ $key }}" role="tabpanel"
                             aria-labelledby="pills-{{ $key }}-tab">
                            {!! $key !!}
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    @include('mbshp::common._partials.custom_fields.ffooter')


</div>
