@extends( 'btybug::layouts.admin' )
@section( 'content' )
    <div class="row">
        {!! Form::model($form,['class' => 'form-horizontal']) !!}

        <div class="col-md-12 m-t-20 m-b-20">
            <div class="bty-panel-collapse bty-panel-cl-blue">
                <div>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                       href="#formBuilderCollapse" aria-expanded="true">
                        <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        <span class="title">Permissions</span>
                    </a>
                </div>
                <div id="formBuilderCollapse" class="collapse" aria-expanded="true" style="">
                        <div class="content">
                            <div class="panel-body general-menu-settings">
                                <div class="bb-menu-form">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <i class="fa fa-universal-access" aria-hidden="true"></i><span
                                                    class="labls">Form access</span>
                                            <div class="radio">
                                                <label for="radios-0">
                                                    {!! Form::radio('form_access',0,null,['class' => 'access-radio']) !!}
                                                    Public
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radios-1">
                                                    {!! Form::radio('form_access',1,null,['class' => 'access-radio']) !!}
                                                    Roles
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radios-1">
                                                    {!! Form::radio('form_access',2,null,['class' => 'access-radio']) !!}
                                                    Loged in
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 roles-box {!! ($form->form_access == 1) ? "show" : "hide" !!}">
                                            <label class="text-primary">How Page display for different visitors
                                                types?</label>

                                            <p>
                                                <a href="javascript:" class="btn btn-xs btn-danger bb-bulk-roles"
                                                   data-bulk="hide">Hide for all</a>
                                                <a href="javascript:" class="btn btn-xs btn-success bb-bulk-roles"
                                                   data-bulk="show">Show for all</a>
                                                <a href="javascript:" class="btn btn-xs btn-primary bb-bulk-roles"
                                                   data-bulk="members">Show for members</a>
                                            </p>

                                            <div class="form-group has-feedback">
                                                <label>Filter roles</label>
                                                <input type="text" class="form-control" id="bb-role-filter"
                                                       placeholder="Type search keyword">
                                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                            </div>

                                            <ul class="list-group bb-roles-list">
                                                @foreach($roles as $role)
                                                    <li class="list-group-item" data-role="guests" data-title="Guests"
                                                        data-display="show">
                                                        <span class="bb-role-title">{!! $role['name'] !!}</span>

                                                        <a href="javascript:"
                                                           class="pull-right text-info bb-what-to-show">
                                                            <i class="fa fa-chevron-right"></i>
                                                        </a>

                                                        <div class="pull-right">
                                                            <input type="checkbox" class="bb-switch bb-role-toggle"
                                                                   @if(in_array($role['id'],$formRoles))
                                                                   checked
                                                                   @endif
                                                                   name="roles[{!!$role['slug']!!}]">
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        {{--<div class="col-md-4">--}}
                                            {{--<div class="what-to-show-panel hide" data-for="guests">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<label>What to show for "Guests" role?</label>--}}
                                                    {{--<select name="guests_show" class="form-control input-sm">--}}
                                                        {{--<option value="hide">Hide Only</option>--}}
                                                        {{--<option value="unit">Render Unit</option>--}}
                                                        {{--<option value="menu">Render another menu</option>--}}
                                                    {{--</select>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="unit">--}}
                                                    {{--<label>Select unit</label>--}}
                                                    {{--<button class="btn btn-primary form-control">BB Button for units--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="menu">--}}
                                                    {{--<label>Select menu</label>--}}
                                                    {{--<button class="btn btn-info form-control">BB Button for menus--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="what-to-show-panel hide" data-for="normal-user">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<label>What to show for "Normal User" role?</label>--}}
                                                    {{--<select name="normal-user_show" class="form-control input-sm">--}}
                                                        {{--<option value="hide">Hide Only</option>--}}
                                                        {{--<option value="unit">Render Unit</option>--}}
                                                        {{--<option value="menu">Render another menu</option>--}}
                                                    {{--</select>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="unit">--}}
                                                    {{--<label>Select unit</label>--}}
                                                    {{--<button class="btn btn-primary form-control">BB Button for units--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="menu">--}}
                                                    {{--<label>Select menu</label>--}}
                                                    {{--<button class="btn btn-info form-control">BB Button for menus--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="what-to-show-panel hide" data-for="pro-user">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<label>What to show for "Pro User" role?</label>--}}
                                                    {{--<select name="pro-user_show" class="form-control input-sm">--}}
                                                        {{--<option value="hide">Hide Only</option>--}}
                                                        {{--<option value="unit">Render Unit</option>--}}
                                                        {{--<option value="menu">Render another menu</option>--}}
                                                    {{--</select>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="unit">--}}
                                                    {{--<label>Select unit</label>--}}
                                                    {{--<button class="btn btn-primary form-control">BB Button for units--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="menu">--}}
                                                    {{--<label>Select menu</label>--}}
                                                    {{--<button class="btn btn-info form-control">BB Button for menus--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="what-to-show-panel hide" data-for="editor">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<label>What to show for "Editor" role?</label>--}}
                                                    {{--<select name="editor_show" class="form-control input-sm">--}}
                                                        {{--<option value="hide">Hide Only</option>--}}
                                                        {{--<option value="unit">Render Unit</option>--}}
                                                        {{--<option value="menu">Render another menu</option>--}}
                                                    {{--</select>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="unit">--}}
                                                    {{--<label>Select unit</label>--}}
                                                    {{--<button class="btn btn-primary form-control">BB Button for units--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="menu">--}}
                                                    {{--<label>Select menu</label>--}}
                                                    {{--<button class="btn btn-info form-control">BB Button for menus--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="what-to-show-panel hide" data-for="contributor">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<label>What to show for "Contributor" role?</label>--}}
                                                    {{--<select name="contributor_show" class="form-control input-sm">--}}
                                                        {{--<option value="hide">Hide Only</option>--}}
                                                        {{--<option value="unit">Render Unit</option>--}}
                                                        {{--<option value="menu">Render another menu</option>--}}
                                                    {{--</select>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="unit">--}}
                                                    {{--<label>Select unit</label>--}}
                                                    {{--<button class="btn btn-primary form-control">BB Button for units--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}

                                                {{--<div class="form-group hide" data-render="menu">--}}
                                                    {{--<label>Select menu</label>--}}
                                                    {{--<button class="btn btn-info form-control">BB Button for menus--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>

                                    <div class="row m-l-0 m-r-0">
                                        <button type="submit" class="bty-btn bty-btn-save bty-btn-cl-black bty-btn-size-sm pull-right m-r-10" data-action="save-form"><span>Save</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 m-t-20 m-b-20">
            <div class="bty-panel-collapse bty-panel-cl-blue">
                <div>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                       href="#formSettingsGeneral" aria-expanded="true">
                        <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        <span class="title">General</span>
                    </a>
                </div>
                <div id="formSettingsGeneral" class="collapse in" aria-expanded="true" style="">
                    <div class="content">
                        <div class="form-group m-l-0 m-r-0">
                            <label for="success_message" class="col-sm-4 ">Success Message</label>
                            <div class="col-sm-8">
                                {!! Form::text('message',(isset($form->settings['message'])) ? $form->settings['message'] : null ,['class' =>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group m-l-0 m-r-0">
                            <label for="success_message" class="col-sm-4 ">Event/Trigger</label>
                            <div class="col-sm-8">
                                {!! Form::select('event',['' => 'Select Event'] + \Subscriber::getEvents(true), (isset($settings['event'])) ? $settings['event'] : null ,['class' =>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group m-l-0 m-r-0">
                            <label for="" class="col-sm-4">Redirect Page</label>
                            <div class="col-sm-8">
                                <select id="target" class="form-control" name="redirect_Page" title="Select Target">
                                    <option value="alert">BB get page</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-l-0 m-r-0">
                            <label for="" class="col-sm-4">Is Ajax</label>

                            <div class="col-sm-8">
                                <div class="customelement radio-inline">
                                    <input name="is_ajax" id="is_ajax_yes"
                                           <?php echo (isset($form->settings['is_ajax']) && $form->settings['is_ajax'] == 'yes') ? 'checked' : '' ?> value="yes"
                                           type="radio">
                                    <label for="is_ajax_yes">Yes</label>
                                </div>
                                <div class="customelement radio-inline">
                                    <input name="is_ajax" id="is_ajax_no"
                                           <?php echo (isset($form->settings['is_ajax']) && $form->settings['is_ajax'] == 'no') ? 'checked' : '' ?>
                                           value="no" type="radio"> <label for="is_ajax_no">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-l-0 m-r-0">
                            <button type="submit" class="bty-btn bty-btn-save bty-btn-cl-black bty-btn-size-sm pull-right m-r-10" data-action="save-form"><span>Save</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
    @include('resources::assests.magicModal')
@stop
@section( 'CSS' )
    {!! HTML::style('public/css/new-store.css') !!}
    {!! HTML::style('public/css/bootstrap/css/bootstrap-switch.min.css') !!}
    {!! HTML::style('public/css/font-awesome/css/fontawesome-iconpicker.min.css') !!}
    {!! HTML::style("public/js/select2/css/select2.css") !!}
@stop


@section( 'JS' )
    {!! HTML::script('public/js/jquery.mjs.nestedSortable.js') !!}
    {!! HTML::script('public/css/bootstrap/js/bootstrap-switch.min.js') !!}
    {!! HTML::script('public/css/font-awesome/js/fontawesome-iconpicker.min.js') !!}
    {!! HTML::script('public/js/menus.js') !!}
    {!! HTML::script('public/js/bty.js?v='.rand(1111,9999)) !!}
    {!! HTML::script("public/js/select2/js/select2.js") !!}
    <script>

        $(function () {
            $(".access-radio").click(function () {
                if ($(this).val() == 1) {
                    $(".roles-box").removeClass("hide").addClass("show");
                } else {
                    $(".roles-box").removeClass("show").addClass("hide");
                }
            });

            $('body').on('change', '.fields_type', function () {
                var table = $(this).val();

                $.ajax({
                    url: "/admin/console/structure/forms/get-available-fields-settings",
                    type: 'POST',
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    data: {table: table},
                    success: function (data) {
                        if (!data.error) {
                            $('.available-fields').html(data.html);
                        }
                    }
                })
            })


            $('[data-sortables="avalable"]').sortable({
                connectWith: '[data-sortables="usedfield"]',
                forcePlaceholderSize: true,
                forceHelperSize: true,
                tolerance: "pointer",
                placeholder: "ui-state-highlight  list-group-item",
                start: function (event, ui) {
                    //getlnt = $('.target  > [data-id]').length;
                    //$(ui.item).width($('.source li').width());
                }
            }).disableSelection();

            $('[data-sortables="usedfield"]').sortable({
                connectWith: '[data-sortables="avalable"]',
                forcePlaceholderSize: true,
                forceHelperSize: true,
                tolerance: "pointer",
                placeholder: "ui-state-highlight  list-group-item",
                start: function (event, ui) {
                    //getlnt = $('.target  > [data-id]').length;
                    //$(ui.item).width($('.source li').width());
                }
            }).disableSelection();

        })

    </script>
@stop