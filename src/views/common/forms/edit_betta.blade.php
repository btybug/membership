@extends( 'btybug::layouts.admin' )

@section( 'CSS' )
    {!! BBstyle(plugins_path("vendor/sahak.avatar/membership/src/public/css/form-builder.css")) !!}
@stop

@section( 'JS' )
    {!! BBscript(plugins_path("vendor/sahak.avatar/membership/src/public/js/form-builder.js")) !!}
@stop

@section( 'content' )

    <!-- Form Builder -->
    {!! Form::model($form,['id'=>'fields-list','url' => url(route('mbsp_save_form',$slug))]) !!}
    {!! Form::hidden('id',$form->id) !!}
    <div class="bb-form-header">
        <div class="row">
            <div class="col-md-8">
                <label>Form name</label>
                {!! Form::text('name',null,['class' => 'form-name', 'placeholder' => 'Form Name']) !!}
            </div>
            <div class="col-md-4">
                <button type="submit" class="form-save pull-right"><span>Save</span></button>
                <button type="button" class="items-panel-trigger pull-right" data-toggle="modal"
                        data-target="#myModal0"><span>Fields</span></button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <h3>Preview Area</h3>

    <hr/>

    <div class="row">
        <div class="col-md-9">

            <div class="form-builder-tabs">

                <div class="tab-actions">
                    <a href="#" class="btn btn-default btn-sm add-form-tab">
                        <i class="fa fa-plus"></i> Add Tab
                    </a>
                    <a href="#" class="btn btn-danger btn-sm remove-tab" data-toggle="tooltip" data-placement="left" title="Delete active tab">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#general" id="home-tab" role="tab" data-toggle="tab">General</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active" role="tabpanel" id="general">
                        <div class="form-builder-area"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Fields</h3>
                </div>
                <div class="panel-body">
                    <div class="html-elements-list">
                        <div class="html-element-item draggable-element">
                            title
                            <div class="html-element-item-sample hidden">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="html-element-item draggable-element">
                            description
                            <div class="html-element-item-sample hidden">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Templates -->
    <script type="template" id="template-tab-nav">
        <li role="presentation">
            <a href="#{id}" role="tab" data-toggle="tab">Tab Title</a>
        </li>
    </script>

    <script type="template" id="template-tab-content">
        <div class="tab-pane in" role="tabpanel" id="{id}">
            <div class="form-builder-area"></div>
        </div>
    </script>
@stop
@section( 'JS' )

    <script>
        $(function () {
            function tabsGenerate(json) {
                var li = $('<li/>', {class: "nav-item"});
                var deleteI = $('<button/>', {class: "fa fa-trash", "style": "color:#9A2720"});
                var options = $('.tab-content-settings-to-clone');
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
                    var item = li.clone();
                    var divContent = div.clone();
                    var optionsClone = options.clone();
                    optionsClone.find('select').attr('data-id', k);
                    divContent.attr('data-id', k);
                    optionsClone.removeClass('hidden');
                    optionsClone.removeClass('tab-content-settings-to-clone');
                    optionsClone.addClass('tab-content-settings');
                    del.attr('data-id', k);
                    tab.text(v.name);
                    tab.attr('href', '#' + v.name);
                    tab.attr('aria-controls', v.name);
                    item.append(del);
                    item.append(tab);
                    divContent.attr('aria-labelledby', 'tab-' + v.name);
                    divContent.attr('id', v.name);
                    divContent.html(optionsClone);
                    $('#formTabContent').append(divContent);
                    $('.tab-items').append(item)

                });

            }

//get partial options view
            $('body').on('change', '.partials-change', function () {

                var data = {
                    'type': $(this).val(),
                    'data_id': $(this).attr('data-id'),
                    'options_form_id': $('input[name=id]').val()
                };
                $.ajax({
                    type: 'POST',
                    url: "{!! route('form_partial_options',$slug) !!}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (!data.error) {
                            var data_id = data.data_id;
                            $('body').find('div[data-id=' + data_id + ']').find('.partials-area').html(data.html);
                        } else {
                            alert(data.message);
                        }
                    }
                });
            });

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