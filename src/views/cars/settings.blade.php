@extends('btybug::layouts.mTabs',['index'=>'cars_pages'])
@section('tab')
    <div class="container-fluid">
        <h2>Blog Settings</h2>
        <div class="col-md-12">
            <div class="panel panelSettingData">
                <div class="panel-heading" role="tab" id="urlManager">
                    <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion"
                                               href="#urlManagerCol" aria-expanded="true" aria-controls="urlManagerCol">
                            <i
                                    class="glyphicon glyphicon-chevron-right"></i>Url Manager</a></h4>
                </div>
                <div id="urlManagerCol" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="urlManager">
                    <div class="panel-body">
                        {!! Form::model($settings,['url' => '/admin/blog/settings']) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="radios">Select type</label>
                            <div class="col-md-4">
                                <div class="radio">
                                    <label for="radios-0">
                                        {!! Form::radio('url_manager',"title",null,['id' => 'radios-0']) !!}
                                        With Title
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radios-1">
                                        {!! Form::radio('url_manager',"created_at",null,['id' => 'radios-1']) !!}
                                        With Date
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radios-2">
                                        {!! Form::radio('url_manager',"id",null,['id' => 'radios-2']) !!}
                                        With ID
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 m-b-10">
                                    <div class="col-sm-4 p-l-0">All posts Unit</div>
                                    {!! BBbutton2('unit','all_main_content','all_posts',(isset($all->template) && $all->template)?'Change':'Select',['class'=>'btn btn-default change-layout','model' =>(isset($all->template) && $all->template) ?$all->template : null]) !!}

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 m-b-10">
                                    <div class="col-sm-4 p-l-0">Single posts Unit</div>
                                    {!! BBbutton2('unit','single_main_content','single_post',(isset($single->template) && $single->template)?'Change':'Select',['class'=>'btn btn-default change-layout','model' =>(isset($single->template) && $single->template) ?$single->template : null]) !!}

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 m-b-10">
                                    <div class="col-sm-4 p-l-0">Select create form</div>
                                    {!! Form::select('posts_create_form',['Select Form'] + $createForms,null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 m-b-10">
                                    <div class="col-sm-4 p-l-0">Select edit form</div>
                                    {!! Form::select('posts_edit_form',['Select Form'] + $editForms,null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::submit("Save",['class' => 'btn settingBtn pull-right']) !!}
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panelSettingData">
                <div class="panel-heading" role="tab" id="formBuilder">
                    <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion"
                                               href="#formBuilderCollapse" aria-expanded="true"
                                               aria-controls="formBuilderCollapse">
                            <i class="glyphicon glyphicon-chevron-right"></i>Table Columns</a></h4>
                </div>
                <div id="formBuilderCollapse" class="panel-collapse collapse in" role="tabpanel"
                     aria-labelledby="formBuilder">
                    <div class="panel-body">
                    <div class="col-md-12 m-b-15">
                        <button type="button" id="add_colum" class="btn btn-info">Add Column</button>
                    </div>
                    {!! Form::open(['class'=>'form-horizontal columns-add-form hide']) !!}
                    <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="engine">Add after</label>
                            <div class="col-md-4">
                                {!! Form::select('after_column',$after_columns,null,['class'=>'form-control','id'=>'add_column']) !!}
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Column Name</th>
                                <th>DataType</th>
                                <th>Lenght/Values</th>
                                <th>Default</th>
                                <th>Null</th>
                                <th>Key Unique</th>
                                <th>Field</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="table_engine">

                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" id="submit_form">Create</button>
                        </div>
                        {!! Form::close() !!}


                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Column Name</th>
                                <th>DataType</th>
                                {{--<th>Create Form</th>--}}
                                <th>Is Null</th>
                                <th>Key</th>
                                <th>Default</th>
                                <th>Extra</th>
                                <th>Field</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($columns as $colum)
                                <tr>
                                    @foreach($colum as $k=>$v)
                                        <th>
                                            {!! $v !!}
                                        </th>
                                    @endforeach
                                    <th>
                                        @if(\Btybug\Console\Services\FieldService::checkField($table,$colum->Field))
                                            YES
                                        @else
                                            NO
                                        @endif
                                    </th>
                                    <th>
                                        @if(\Btybug\Console\Services\ColumnService::columnExists($table,$colum->Field))
                                            <a href="javascript:void(0)"
                                               class="btn btn-warning get-column-data" data-table="{{ $table }}"
                                               data-column="{{ $colum->Field }}"><i class="fa fa-pencil-square-o"
                                                                                    aria-hidden="true"></i></a>
                                            <a href="{!! url('admin/console/structure/tables/fields',[$table,$colum->Field]) !!}"
                                               class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="btn btn-primary get-column-data" data-table="{{ $table }}"
                                               data-column="{{ $colum->Field }}"><i class="fa fa-eye"
                                                                                    aria-hidden="true"></i></a>
                                        @endif

                                            @if(\Btybug\Console\Services\FieldService::checkField($table,$colum->Field))
                                                <a href="{!! route("edit_field",['id' => \Btybug\Console\Services\FieldService::getFieldID($table,$colum->Field)]) !!}"
                                                   class="btn btn-warning" ><i class="fa fa-pencil"
                                                                               aria-hidden="true"></i> Field</a>
                                            @endif
                                    </th>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @include('resources::assests.deleteModal')
    @include('resources::assests.magicModal')
    @include('btybug::_partials.mysql_error')
    @include('console::structure.developers._partials.columns_pop_up')

@stop
@section('CSS')

    <style>
        .panel-heading {
            z-index: 99999999
        }

        .panelSettingData {
            background-color: #85d8d7;
        }

        .panelSettingData .panel-heading {
            background-color: #1c1c1c;
        }

        .panelSettingData label {
            color: #000000;
        }

        .panelSettingData h4 a {
            color: #fff;
        }

        .panelSettingData h4 a:hover, .panelSettingData h4 a:focus {
            text-decoration: none;
        }

        .panelSettingData h4 a i {
            transition: all 0.3s;
            -moz-transition: all 0.3s;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            margin-right: 10px;
        }

        .panelSettingData h4 a[aria-expanded="true"] i {
            -ms-transform: rotate(90deg);
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        .settingBtn {
            background-color: #292929;
            color: #fff;
        }

        .settingBtn:hover, .settingBtn:focus {
            color: #fff;
        }

        .form-control {
            background-color: #000000 !important;
            border: none;
            color: #fff
        }
    </style>
@stop
@section('JS')
    {!! HTML::script("public/js/UiElements/bb_styles.js") !!}
    <script>
        $(document).ready(function () {

            $("body").on('click', '.get-column-data', function () {
                var table = $(this).data('table');
                var column = $(this).data('column');
                $.ajax({
                    type: 'POST',
                    url: '/admin/console/structure/tables/get-column',
                    datatype: 'json',
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    data: {table: table, column: column},
                    success: function (data) {
                        if(! data.error){
                            $("#column-pop-up .modal-body").html(data.html);
                            $("#column-pop-up").modal();
                        }else{
                            alert(data.message);
                        }
                    }
                });
            });

            $('.delete_table_column').on('click', function () {
                $('#delete_confirm').attr('href', $(this).attr('data-href'));
                $('.delete_modal .modal-body p').html('are you sure delete this column?');
                $('.delete_modal').modal();
            });

            var i = 1;
            $('#add_colum').on('click', function () {
                var form = $(".columns-add-form")
                if(form.hasClass('hide')){
                    form.removeClass("hide");
                    form.addClass("show");
                }
                var column = "<tr>" +
                    '<td> <input type="text" name="column[' + i + '][name]" class="form-control"></input></td>' +
                    '<td><select name="column[' + i + '][type]" class="form-control">@foreach($tbtypes as $k=>$v) <option value="{!! $k !!}">{!! $v !!}</option> @endforeach</select></td>' +
                    '<td> <input type="text" name="column[' + i + '][lenght]" class="form-control"></input></td>' +
                    '<td> <input type="text" name="column[' + i + '][default]" class="form-control"></input></td>' +
                    '<td><input type="checkbox" name="column[' + i + '][nullable]"/></td>' +
                    '<td><input type="checkbox" name="column[' + i + '][unique]"/></td>' +
                    '<td>NO<input value="no" type="radio" name="column[' + i + '][field]"/> YES<input value="yes" checked type="radio" name="column[' + i + '][field]"/></td>' +
                    '<td><span class="btn btn-warning delete_row"><i class="fa fa-trash" aria-hidden="true"></i></span></td>' +
                    "</tr>";
                $('#table_engine').append($(column));
                i++;
            });

            $('body').on('click', '.delete_row', function () {
                $(this).parent().parent().remove();
            });

            $('#submit_form').on('click', function () {
                var data = $('.columns-add-form').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/admin/console/structure/tables/add-column/posts',
                    headers: '{!! csrf_token() !!}',
                    datatype: 'json',
                    cache: false,
                    data: data,
                    success: function (data) {
                        if (data.error) {
                            if (data.arrm) {
                                $('#mysql .error_message').empty();
                                $.each(data.message, function (k, v) {
                                    var message = $('</p>');
                                    var p = message.clone().text(v);
                                    $('#mysql .error_message').append(p);
                                });
                                $('#mysql').modal('show');
                            } else {
                                $('#mysql .error_message').html(data.message);
                                $('#mysql').modal('show');
                            }
                        } else {
                            location.reload();
                        }
                    }
                });
            });


            $('body').on('click', '.edit-column-btn' ,function () {
                var data = $('#edit-column-form').serialize();
                var column = $(this).data('column');
                $.ajax({
                    type: 'POST',
                    url: '/admin/console/structure/tables/edit-column/posts/'+column,
                    headers: '{!! csrf_token() !!}',
                    datatype: 'json',
                    cache: false,
                    data: data,
                    success: function (data) {
                        if (data.error) {
                            if (data.arrm) {
                                $('#mysql .error_message').empty();
                                $.each(data.message, function (k, v) {
                                    var message = $('</p>');
                                    var p = message.clone().text(v);
                                    $('#mysql .error_message').append(p);
                                });
                                $("#column-pop-up").modal('hide');
                                $('#mysql').modal('show');
                            } else {
                                $('#mysql .error_message').html(data.message);
                                $("#column-pop-up").modal('hide');
                                $('#mysql').modal('show');
                            }
                        } else {
                            location.reload();
                        }
                    }
                });
            });
        })

    </script>
@stop