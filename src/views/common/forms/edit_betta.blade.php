@extends( 'btybug::layouts.admin' )
@section( 'content' )
    <div class="row">
        <h2>Edit Form</h2>
        <div class="col-md-12">
            {!! Form::model($form,['id'=>'fields-list','url' => url(route('mbsp_save_form',$slug))]) !!}
            {!! Form::hidden('id',$form->id) !!}

                        <div class="col-md-12 m-b-15">

                                <div class="col-md-2">
                                    <span class="bty-hover-17 bty-f-s-20">Form name</span>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::text('name',null,['placeholder' => 'What is your Form name ?','class' => 'bty-input-label-2 m-t-0']) !!}
                                </div>
                                <div class="col-mg-6">
                                    <div class="btn-group btn-group-lg">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Tabs</button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal0">Items</button>
                                        <button type="button" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                        </div>
                    </div>
            {!! Form::close() !!}

            {{--<div class="col-md-12">--}}
                {{--<div class="content">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i--}}
                                    {{--class="fa fa-plus"> Insert New Tab</i></button>--}}
                        {{--<ul class="nav nav-tabs tab-items" id="myTab" role="tablist">--}}
                            {{--<li class="nav-item active">--}}
                                {{--<a class="nav-link" data-toggle="tab" role="tab" aria-selected="true" href="#General"--}}
                                   {{--aria-controls="General" aria-expanded="true">General</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<div class="tab-content" id="formTabContent">--}}
                            {{--<div class="tab-pane fade active in" role="tabpanel" aria-labelledby="tab-General"--}}
                                 {{--id="General">--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


                        {{--<div class="col-md-12">--}}
                            {{--<button class="bty-btn bty-btn-add" data-toggle="modal" data-target=".bd-example-modal-lg"><span>Insert New Tab</span></button>--}}
                            {{--<ul class="nav nav-tabs tab-items" id="myTab" role="tablist">--}}
                                {{--<li class="nav-item active">--}}
                                    {{--<a class="nav-link" data-toggle="tab" role="tab" aria-selected="true" href="#General"--}}
                                       {{--aria-controls="General" aria-expanded="true">General</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--<div class="tab-content" id="formTabContent">--}}
                                {{--<div class="tab-pane fade active in" role="tabpanel" aria-labelledby="tab-General"--}}
                                     {{--id="General">--}}

                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}






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
    <div class="tab-content-settings-to-clone hidden">
        <div class="col-md-4">
            <div class="form-horizontal">
                <div class="form-group">
                    <select class="form-control partials-change">
                        <option value="0">Select Option</option>
                        <option value="fields">Field</option>
                        <option value="units">Unit</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-8 partials-area">

        </div>
    </div>


    <div class="container demo">


        {{--<div class="text-center">--}}
            {{--<button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal">--}}
                {{--Left Sidebar Modal--}}
            {{--</button>--}}

            {{--<button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2">--}}
                {{--Right Sidebar Modal--}}
            {{--</button>--}}
        {{--</div>--}}

        <!-- Modal -->
        <div class="modal right fade" id="myModal0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Right Sidebar</h4>
                    </div>

                    <div class="modal-body">

                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->

        <!-- Modal -->
        <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
                    </div>

                    <div class="modal-body">
                        <div class="col-md-12">
                            <button class="bty-btn bty-btn-add" data-toggle="modal" data-target=".bd-example-modal-lg"><span>Insert New Tab</span></button>
                            <ul class="nav nav-tabs tab-items" id="myTab" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link" data-toggle="tab" role="tab" aria-selected="true" href="#General"
                                       aria-controls="General" aria-expanded="true">General</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="formTabContent">
                                <div class="tab-pane fade active in" role="tabpanel" aria-labelledby="tab-General"
                                     id="General">

                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->


    </div><!-- container -->


@stop
@section( 'CSS' )
    <style>


        .modal.left .modal-dialog,
        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            width: 320px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.left .modal-content,
        .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.left .modal-body,
        .modal.right .modal-body {
            padding: 15px 15px 80px;
        }

        /*Left*/
        .modal.left.fade .modal-dialog{
            left: -320px;
            -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
            -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
        }

        .modal.left.fade.in .modal-dialog{
            left: 0;
        }

        /*Right*/
        .modal.right.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.right.fade.in .modal-dialog {
            right: 0;
        }

        /* ----- MODAL STYLE ----- */
        .modal-content {
            border-radius: 0;
            border: none;
        }

        .modal-header {
            border-bottom-color: #EEEEEE;
            background-color: #FAFAFA;
        }

        /* ----- v CAN BE DELETED v ----- */


        .demo {
            padding-top: 60px;
            padding-bottom: 110px;
        }

        .btn-demo {
            margin: 15px;
            padding: 10px 15px;
            border-radius: 0;
            font-size: 16px;
            background-color: #FFFFFF;
        }

        .btn-demo:focus {
            outline: 0;
        }

        .demo-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 15px;
            background-color: #212121;
            text-align: center;
        }

        .demo-footer > a {
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            color: #fff;
        }










        .tab-form-list .tab-items{
            margin-top: 15px;
        }
        .tab-form-list .tab-items .nav-item{
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            flex-direction: row-reverse;
            margin-right: 10px;
        }
        .tab-form-list .tab-items .nav-item button{
            padding: 5px;
            background-color: #d65048;
            color: white !important;
            border: none;
            border-radius: 0 5px 5px 0;
        }
        .tab-form-list .tab-items .nav-item .nav-link{
            background-color: #499bc7;
            color: white;
            margin: 0;
            border-radius: 0;
        }
        .tab-form-list .tab-items .nav-item .nav-link:hover,.tab-form-list .tab-items .nav-item .nav-link:active{
            background-color: #337ab7 !important;
            border-color: #3685af;
            transition: 0.5s ease;
        }
        .tab-form-list .tab-items .nav-item button:hover{
            transition: 0.5s ease;
            background-color: #ab403a !important;
        }
        .tab-form-list .tab-content{
            margin-top: 10px;
        }
        .tab-form-list .tab-content .partials-change{
            background-color: #499bc74a;
            outline: none;
            padding: 10px 8px;
            height: auto;
        }
    </style>
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
                    type:'POST',
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
                        }else{
                            alert(data.message);                        }
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