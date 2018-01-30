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
            {!! Form::close() !!}

            <div class="col-md-12">
                <div class="content">
                    <div class="col-md-12">
                        <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                                    class="fa fa-plus"> Insert New Tab</i></button>
                        <ul class="nav nav-tabs tab-items" id="myTab" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" data-toggle="tab" role="tab" aria-selected="true" href="#General" aria-controls="General" aria-expanded="true">General</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="formTabContent">
                            <div class="tab-pane fade active in" role="tabpanel" aria-labelledby="tab-General" id="General">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2>Preview Area</h2>

            <div class="modal fade bd-example-modal-lg" id="tab-manage-modal" tabindex="-1" role="dialog"
                 aria-labelledby="myLargeModalLabel"
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
            function tabsGenerate(json) {
                var li = $('<li/>', {class: "nav-item"});
                var deleteI = $('<button/>', {class: "fa fa-trash", "style": "color:#9A2720"});
                var a = $('<a/>', {
                    class: "nav-link",
                    "data-toggle": "tab",
                    role: "tab",
                    "aria-selected": "true"
                });
                var div = $('<div/>', {
                    class: "tab-pane fade",
                    role: "tabpanel",
                    "aria-labelledby": "profile-tab"
                });
                $('#formTabContent').empty();
                $('.tab-items').empty();
                $.each(json, function (k, v) {
                    var tab = a.clone();
                    var del = deleteI.clone();
                    del.attr('data-id', k);

                    tab.text(v.name);
                    tab.attr('href', '#' + v.name);
                    tab.attr('aria-controls', v.name);
                    var item = li.clone();
                    item.append(del);
                    item.append(tab);

                    var divContent = div.clone();
                    divContent.attr('aria-labelledby', 'tab-' + v.name);
                    divContent.attr('id', v.name);
                    divContent.text(v.name);
                    $('#formTabContent').append(divContent);
                    $('.tab-items').append(item)

                })

            }


            var jsonString = $('#tabs-json-area').text();
            var jsonData = JSON.parse(jsonString);
            tabsGenerate(jsonData);
            var tabJson = {name: null, data: {}}
            $('#save-tab-changes').on('click', function () {
                var newTab = (objectifyForm($('#tab-options')));
                var copyData = tabJson;
                copyData.name = newTab.name;
                copyData.data = [{'type': 'unit', 'value': 'price_calculate.default'}];
                jsonData.push(copyData);
                updateTabs(jsonData);
                $('#tab-manage-modal').modal('hide');
                $('#tabs-json-area').text(JSON.stringify(jsonData));


            });

//data-id
            $('.tab-items').on('click', 'button[data-id]', function () {
                var id = $(this).attr('data-id');
                deleteTab(id);
            })

            function deleteTab(id) {
                jsonString = $('#tabs-json-area').text();
                jsonData = JSON.parse(jsonString);
                jsonData.splice(id)
                $('#tabs-json-area').text(JSON.stringify(jsonData));
                updateTabs(jsonData);
                tabsGenerate(jsonData);
            }

            function updateTabs(data) {
                $.ajax({
                    url: "{!! route('form_edit_tab_generate',$slug) !!}",
                    data: {data: data},
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (!data.error) {
                            $('.preview-area').html(data.html);

                            jsonString = $('#tabs-json-area').text();
                            jsonData = JSON.parse(jsonString);
                            tabsGenerate(jsonData);
                        }
                    },
                    type: 'POST'
                });
            }

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