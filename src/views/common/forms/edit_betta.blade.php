@extends( 'btybug::layouts.admin' )
@section( 'content' )
    <div class="row">
        <h2>Edit Form</h2>
        <div class="col-md-12">
            {!! Form::model($form,['id'=>'fields-list','url' => url(route('mbsp_save_form',$slug))]) !!}
            {!! Form::hidden('id',$form->id) !!}
            <div class="bty-panel-collapse 	bty-panel-cl-tomato">
                <div>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#general"
                       aria-expanded="true">
                        <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        <span class="title">General</span>
                        <button class="bty-btn bty-btn-save bty-btn-cl-black bty-btn-size-sm pull-right m-r-10"
                                data-action="save-form"><span>Save</span></button>
                    </a>
                </div>
                <div id="general" class="collapse in" aria-expanded="true" style="">
                    <div class="content">
                        <div class="col-md-12 m-b-15">
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <span class="bty-hover-17 bty-f-s-20">Form name</span>
                                </div>
                                <div class="col-md-8">
                                    {!! Form::text('name',null,['placeholder' => 'What is your Form name ?','class' => 'bty-input-label-2 m-t-0']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bty-panel-collapse 	bty-panel-cl-tomato m-t-20">
                <div>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#availableFields"
                       aria-expanded="true">
                        <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        <span class="title">Available Fields</span>
                    </a>
                </div>
                <div id="availableFields" class="collapse in" aria-expanded="true" style="">
                    <div class="content">
                        <div class="text-center">
                            @if(count($fields))
                                @foreach($fields as $field)
                                    <div class="col-md-2">
                                        <p>
                                            <input type="checkbox" data-id="{!! $field->id !!}"
                                                   data-table="{!! $form->fields_type !!}"
                                                   value="{!! $field->column_name !!}"
                                                   name="fields_json[{!! $field->id !!}]"
                                                   {!! (! in_array($field->slug,$existingFields)) ?: "checked"  !!}
                                                   class="bty-input-checkbox-2 select-field"
                                                   id="bty-cbox-{{ $field->id }}">
                                            <label for="bty-cbox-{{ $field->id }}">{{ $field->name }}</label>
                                        </p>
                                    </div>
                                @endforeach
                            @else
                                No Columns Available
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="bty-panel-collapse 	bty-panel-cl-tomato m-t-20">
                <div>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#settingsFields"
                       aria-expanded="true">
                        <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        <span class="title">Settings</span>
                    </a>
                </div>
                <div id="settingsFields" class="collapse in" aria-expanded="true" style="">
                    <div class="content">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <span class="bty-hover-17 bty-f-s-20">Form title</span>
                                </div>
                                <div class="col-md-8">
                                    <input class="bty-input-label-2 m-t-0 form-title-settings"
                                           placeholder="What is your Form title ?"
                                           name="form_title" type="text" value="Create post">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

            <h2>Preview Area</h2>
            <button class="btn btn-info pull-right" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                        class="fa fa-plus"></i>Insert New Tab
            </button>

            <div class="modal fade bd-example-modal-lg" id="tab-manage-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="tab-options" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Tab Name</label>
                                    <div class="col-md-4">
                                        <input id="name" name="name" type="text" placeholder="price"
                                               class="form-control input-md">

                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" id="save-tab-changes" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 preview-area">
                {!! form_render(['id' => $form->id]) !!}
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textarea"></label>
                <div class="col-md-4">
                    <textarea class="form-control" id="tabs-json-area" readonly name="textarea">[{"name":"General","data":{}},{"name":"Price","data":{}}]</textarea>
                </div>
            </div>
        </div>
    </div>
@stop
@section( 'CSS' )
@stop

@section( 'JS' )
    <script>
        $(function () {
            var jsonString = $('#tabs-json-area').text();
            var jsonData = JSON.parse(jsonString);

            var tabJson = {name: null, data: {}}
        $('#save-tab-changes').on('click', function () {
            var newTab = (objectifyForm($('#tab-options')));
            var copyData = tabJson;
            copyData.name = newTab.name;
            jsonData.push(copyData);
            $('#tabs-json-area').text(JSON.stringify(jsonData));
        });

        function objectifyForm(formArray) {//serialize data function
            var data = {};
            formArray.serializeArray().map(function (x) {
                data[x.name] = x.value;
            });
            data.data = {};
            return data;
        }
        });

    </script>



    <script>
        $("body").on('input', '.form-title-settings', function () {
            var val = $(this).val();

            $(".form-title").text(val);
        });

        $("body").on('change', '.select-field', function () {
            var checkbox = this;
            var field = $(checkbox).val();
            if (checkbox.checked) {
                var table = $(checkbox).data('table');
                $.ajax({
                    url: "{!! route('mbsp_render_fields',$slug) !!}",
                    data: {table: table, field: field},
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (!data.error) {
                            $(".field-box").append(data.html);
                        }
                    },
                    type: 'POST'
                });
                // alert($(checkbox).val());
            } else {

                $("#bty-input-id-" + $(checkbox).data('id')).remove();
            }
        });


        $('button[data-action=save-form]').on('click', function () {
            var data = $('#fields-list').serialize();
            $.ajax({
                url: "{!! route('mbsp_save_form',$slug) !!}",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                },
                dataType: 'json',
                success: function (data) {
                    if (!data.error) {
                        window.location.href = "{!! route('blog_form_list',$slug) !!}";
                    }
                },
                type: 'POST'
            });
        });
    </script>
@stop