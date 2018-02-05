@extends( 'btybug::layouts.admin' )
@section( 'content' )
    <div class="menuBuilder">
        <section>
            <div class="row " id="builderContain">
                <div class="col-xs-12 col-sm-6 previewAray">
                    <div class="classnamedetail">
                        <input name="title" type="text" class="form-control form-controlblack" value="classname"
                               id="classname" data-role="classname" required>
                    </div>

                    <div data-print="demehtml">
                        <div class="tabs-x " data-tabs="demo" data-class="setting">
                            <ul class="nav nav-tabs" role="tablist" id="myTab-7">

                            </ul>
                            <div class="tab-content" data-tabs="tab-content" id="myTabContent-7"
                                 data-conclass="setting">

                            </div>
                        </div>
                    </div>

                    <textarea name="json_data" class="form-control" data-export="json"
                              style="margin-top:100px;"></textarea>
                    <textarea name="less_data" class="form-control" data-export="css"></textarea>
                </div>
                <div class="col-xs-12 col-sm-6 formoptions">
                    <ul class="stepNav list-unstyled tabStepnav tabNavs clearfix" data-inset="nav">
                        <li class="active"><a href="#setting" aria-controls="setting" role="tab" data-toggle="tab"
                                              title="Step1" data-rolecss="setting" data-rolehtml="setting">Setting</a>
                        </li>
                        <li data-insetadd="addnav"><a href="#" title="Add New Tab" data-tabsactions="add"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a></li>
                    </ul>

                    <a href="#" class="btn btn-default btn-sm hide" id="icons">Edit</a> </form>
                    <div class="tab-content" data-inset="content">
                        <div role="tabpanel" class="tab-pane active" id="setting">

                            <div class="row formrow form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3" for="type"><span class="iconform arrowicon"></span> Type
                                    </label>
                                    <div class="col-sm-6">
                                        <select id="type" class="form-control customselect" data-style="btn-black"
                                                data-htmlclass="class" data-selector="type" data-css="type">
                                            <option value="tab-bordered">bordered</option>
                                            <option value="">Non bordered</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row formrow form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3" for="positions"><span class="iconform arrowicon"></span>
                                        Positions </label>
                                    <div class="col-sm-6">
                                        <select id="positions" class="form-control customselect" data-style="btn-black"
                                                data-htmlclass="class" data-selector="positions" data-css="positions">
                                            <option value="tabs-above" data-show="alignment">Tabs Above</option>
                                            <option value="tabs-below" data-show="alignment">Tabs Below</option>
                                            <option value="tabs-left" data-show="sideways">Tabs left</option>
                                            <option value="tabs-right" data-show="sideways">Tabs right</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row formrow form-horizontal">
                                <div class="form-group" data-panel-showpositions="alignment">
                                    <label class="col-sm-3" for="alignment"><span class="iconform arrowicon"></span>
                                        Alignment </label>
                                    <div class="col-sm-6">
                                        <select id="alignment" class="form-control customselect" data-style="btn-black"
                                                data-htmlclass="class" data-selector="alignment" data-css="alignment">
                                            <option value="">tab-align-left</option>
                                            <option value="tab-align-center">tab-align-center</option>
                                            <option value="tab-align-right">tab-align-right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group hide" data-panel-showpositions="sideways">
                                    <label class="col-sm-3" for="sideways "><span class="iconform arrowicon"></span>
                                        Sideways </label>
                                    <div class="col-sm-6">
                                        <select id="sideways" class="form-control customselect" data-style="btn-black"
                                                data-htmlclass="class" data-selector="sideways" data-css="sideways">
                                            <option value="tab-sideways">Yes</option>
                                            <option value="">no</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row formrow form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3" for="navclass"><span class="iconform arrowicon"></span>Tab
                                        class </label>
                                    <div class="col-sm-6">
                                        <select id="navclass" class="form-control customselect" data-style="btn-black"
                                                data-htmlclass="navclass" data-selector="containerclass"
                                                data-css="containerclass">
                                            <option value="panelheading-blue">panelheading-blue</option>
                                            <option value="panelbody-blue">panelbody-blue</option>
                                            <option value="panelfooter-blue">panelfooter-blue</option>
                                            <option value="panelheading-yellow">panelheading-yellow</option>
                                            <option value="panelbody-yellow">panelbody-yellow</option>
                                            <option value="panelfooter-yellow">panelfooter-yellow</option>
                                            <option value="panelheading-english">panelheading-english</option>
                                            <option value="panelbody-english">panelbody-english</option>
                                            <option value="panelfooter-english">panelfooter-english</option>
                                            <option value="panelheading-cyan">panelheading-cyan</option>
                                            <option value="panelbody-cyan">panelbody-cyan</option>
                                            <option value="panelfooter-cyan">panelfooter-cyan</option>
                                            <option value="panelheading-violet">panelheading-violet</option>
                                            <option value="panelbody-violet">panelbody-violet</option>
                                            <option value="panelfooter-violet">panelfooter-violet</option>
                                            <option value="panelheading-green">panelheading-green</option>
                                            <option value="panelbody-green">panelbody-green</option>
                                            <option value="panelfooter-green">panelfooter-green</option>
                                            <option value="panelheading-orange">panelheading-orange</option>
                                            <option value="panelbody-orange">panelbody-orange</option>
                                            <option value="panelfooter-orange">panelfooter-orange</option>
                                            <option value="menucontainer">menucontainer</option>
                                            <option value="menu-childe-item-cont">menu-childe-item-cont</option>
                                            <option value="menu-button">menu-button</option>
                                            <option value="container3">container3</option>
                                            <option value="container3hover">container3 hover</option>
                                            <option value="mycontainer">mycontainer</option>
                                            <option value="buttonContainer">buttonContainer</option>
                                            <option value="panelContainer">panelContainer</option>
                                            <option value="menucontainer">menu container</option>
                                            <option value="newcontainer">New Container</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="#" class="iconform editicon" data-editpopup="container"></a>
                                        <a href="#" class="iconform viewicon" data-viewpopup="container"></a>
                                        <a href="#" class="iconform addicon" data-addpopup="container"></a>
                                    </div>
                                </div>

                            </div>

                            <div class="row formrow form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3" for="containerclass"><span
                                                class="iconform arrowicon"></span>Container class </label>
                                    <div class="col-sm-6">
                                        <select id="containerclass" class="form-control customselect"
                                                data-style="btn-black" data-htmlclass="conclass"
                                                data-selector="containerclass" data-css="containerclass">
                                            <option value="panelheading-blue">panelheading-blue</option>
                                            <option value="panelbody-blue">panelbody-blue</option>
                                            <option value="panelfooter-blue">panelfooter-blue</option>
                                            <option value="panelheading-yellow">panelheading-yellow</option>
                                            <option value="panelbody-yellow">panelbody-yellow</option>
                                            <option value="panelfooter-yellow">panelfooter-yellow</option>
                                            <option value="panelheading-english">panelheading-english</option>
                                            <option value="panelbody-english">panelbody-english</option>
                                            <option value="panelfooter-english">panelfooter-english</option>
                                            <option value="panelheading-cyan">panelheading-cyan</option>
                                            <option value="panelbody-cyan">panelbody-cyan</option>
                                            <option value="panelfooter-cyan">panelfooter-cyan</option>
                                            <option value="panelheading-violet">panelheading-violet</option>
                                            <option value="panelbody-violet">panelbody-violet</option>
                                            <option value="panelfooter-violet">panelfooter-violet</option>
                                            <option value="panelheading-green">panelheading-green</option>
                                            <option value="panelbody-green">panelbody-green</option>
                                            <option value="panelfooter-green">panelfooter-green</option>
                                            <option value="panelheading-orange">panelheading-orange</option>
                                            <option value="panelbody-orange">panelbody-orange</option>
                                            <option value="panelfooter-orange">panelfooter-orange</option>
                                            <option value="menucontainer">menucontainer</option>
                                            <option value="menu-childe-item-cont">menu-childe-item-cont</option>
                                            <option value="menu-button">menu-button</option>
                                            <option value="container3">container3</option>
                                            <option value="container3hover">container3 hover</option>
                                            <option value="mycontainer">mycontainer</option>
                                            <option value="buttonContainer">buttonContainer</option>
                                            <option value="panelContainer">panelContainer</option>
                                            <option value="menucontainer">menu container</option>
                                            <option value="newcontainer">New Container</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="#" class="iconform editicon" data-editpopup="container"></a>
                                        <a href="#" class="iconform viewicon" data-viewpopup="container"></a>
                                        <a href="#" class="iconform addicon" data-addpopup="container"></a>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>


                </div>
            </div>
        </section>
    </div>
    <select class="hide" data-tabsappend="dropmenu">

    </select>


    {{--<div class="row">--}}

    {{--<h2>Edit Form</h2>--}}
    {{--<div class="col-md-12">--}}
    {{--{!! Form::model($form,['id'=>'fields-list','url' => url(route('mbsp_save_form',$slug))]) !!}--}}
    {{--{!! Form::hidden('id',$form->id) !!}--}}
    {{--<div class="bty-panel-collapse 	bty-panel-cl-tomato">--}}
    {{--<div>--}}
    {{--<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#general"--}}
    {{--aria-expanded="true">--}}
    {{--<span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>--}}
    {{--<span class="title">General</span>--}}
    {{--<button class="bty-btn bty-btn-save bty-btn-cl-black bty-btn-size-sm pull-right m-r-10"--}}
    {{--data-action="save-form"><span>Save</span></button>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div id="general" class="collapse in" aria-expanded="true" style="">--}}
    {{--<div class="content">--}}
    {{--<div class="col-md-12 m-b-15">--}}
    {{--<div class="col-md-6">--}}
    {{--<div class="col-md-4">--}}
    {{--<span class="bty-hover-17 bty-f-s-20">Form name</span>--}}
    {{--</div>--}}
    {{--<div class="col-md-8">--}}
    {{--{!! Form::text('name',null,['placeholder' => 'What is your Form name ?','class' => 'bty-input-label-2 m-t-0']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bty-panel-collapse 	bty-panel-cl-tomato m-t-20">--}}
    {{--<div>--}}
    {{--<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#availableFields"--}}
    {{--aria-expanded="true">--}}
    {{--<span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>--}}
    {{--<span class="title">Available Fields</span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div id="availableFields" class="collapse in" aria-expanded="true" style="">--}}
    {{--<div class="content">--}}
    {{--<div class="text-center">--}}
    {{--@if(count($fields))--}}
    {{--@foreach($fields as $field)--}}
    {{--<div class="col-md-2">--}}
    {{--<p>--}}
    {{--<input type="checkbox" data-id="{!! $field->id !!}"--}}
    {{--data-table="{!! $form->fields_type !!}"--}}
    {{--value="{!! $field->column_name !!}"--}}
    {{--name="fields_json[{!! $field->id !!}]"--}}
    {{--{!! (! in_array($field->slug,$existingFields)) ?: "checked"  !!}--}}
    {{--class="bty-input-checkbox-2 select-field"--}}
    {{--id="bty-cbox-{{ $field->id }}">--}}
    {{--<label for="bty-cbox-{{ $field->id }}">{{ $field->name }}</label>--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--@else--}}
    {{--No Columns Available--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bty-panel-collapse 	bty-panel-cl-tomato m-t-20">--}}
    {{--<div>--}}
    {{--<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#settingsFields"--}}
    {{--aria-expanded="true">--}}
    {{--<span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>--}}
    {{--<span class="title">Settings</span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div id="settingsFields" class="collapse in" aria-expanded="true" style="">--}}
    {{--<div class="content">--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="col-md-6">--}}
    {{--<div class="col-md-4">--}}
    {{--<span class="bty-hover-17 bty-f-s-20">Form title</span>--}}
    {{--</div>--}}
    {{--<div class="col-md-8">--}}
    {{--<input class="bty-input-label-2 m-t-0 form-title-settings"--}}
    {{--placeholder="What is your Form title ?"--}}
    {{--name="form_title" type="text" value="Create post">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--{!! Form::close() !!}--}}
    {{--<div class="bty-panel-collapse 	bty-panel-cl-tomato m-t-20" style="min-height: 370px">--}}
    {{--<div>--}}
    {{--<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#settingsFields"--}}
    {{--aria-expanded="true">--}}
    {{--<span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>--}}
    {{--<span class="title">Inset New Tab</span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div id="settingsFields" class="collapse in" aria-expanded="true" style="">--}}
    {{--<div class="content">--}}
    {{--<div class="col-md-12">--}}
    {{--<button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i--}}
    {{--class="fa fa-plus"> Insert New Tab</i></button>--}}
    {{--<ul class="nav nav-tabs tab-items" id="myTab" role="tablist">--}}

    {{--</ul>--}}


    {{--<div class="tab-content" id="formTabContent">--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<h2>Preview Area</h2>--}}
    {{--<button class="btn btn-info pull-right" data-toggle="modal" data-target=".bd-example-modal-lg"><i--}}
    {{--class="fa fa-plus"></i>Insert New Tab--}}
    {{--</button>--}}

    {{--<div class="modal fade bd-example-modal-lg" id="tab-manage-modal" tabindex="-1" role="dialog"--}}
    {{--aria-labelledby="myLargeModalLabel"--}}
    {{--aria-hidden="true">--}}
    {{--<div class="modal-dialog modal-lg">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<h5 class="modal-title">Modal title</h5>--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--<form id="tab-options" class="form-horizontal">--}}
    {{--<div class="form-group">--}}
    {{--<label class="col-md-4 control-label" for="name">Tab Name</label>--}}
    {{--<div class="col-md-4">--}}
    {{--<input id="name" name="name" type="text" placeholder="price"--}}
    {{--class="form-control input-md">--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}

    {{--<div class="modal-footer">--}}
    {{--<button type="button" id="save-tab-changes" class="btn btn-primary">Save changes</button>--}}
    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}


    {{--<div class="col-md-12 preview-area">--}}
    {{--{!! form_render(['id' => $form->id]) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<label class="col-md-4 control-label" for="textarea"></label>--}}
    {{--<div class="col-md-4">--}}
    {{--<textarea class="form-control" id="tabs-json-area" readonly name="textarea">[{"name":"General","data":{}},{"name":"Price","data":{}}]</textarea>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}



    {{--</div>--}}
@stop
@section( 'CSS' )
    <style>

    </style>
@stop

@section( 'JS' )
    <script type="template" data-tabsappend="nav">
        <li><a href="#tabsprevew{index}" data-toggle="tab" data-navclass="setting" data-class="{index}"><i
                        data-tabicon="enableIcon"></i><span data-tabtext="enabletext">{title}</span><span
                        class="caret"></span></a></li>
    </script>

    <script type="template" data-tabsappend="tabcontent">
        <div class="tab-pane" id="tabsprevew{index}" data-removetab="{index}">
            Tab content will Come here
        </div>
    </script>
    <script type="template" data-tabs="nav">
        <li><a href="#{index}" aria-controls="{index}" role="tab" data-toggle="tab" title="{index}"
               data-rolecss="{index}" data-rolehtml="{index}">{title}</a> <a class="deletebtn" data-key="{index}"
                                                                             data-tabsactions="delele"><i
                        class="fa fa-trash-o" aria-hidden="true"></i></a></li>
    </script>
    <script type="template" data-tabs="tabcontent">
        <div role="tabpanel" class="tab-pane" id="{index}">
            <div class="row formrow form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3" for="enabletext">
                        <div class="customelement">
                            <input type="checkbox" name="enabletext" id="enabletext" value="icon"
                                   data-cssenable="enabletext" data-getcontainer="enabletext"> <label> Inset
                                Text</label>
                        </div>
                    </label>
                    <div class="col-sm-3 hide" data-enable="enabletext">
                        <input class="form-control form-controlblack" name="enabletext" data-html="enabletext"
                               value="Tab text" placeholder="Insert Text">
                    </div>
                    <div class="col-sm-3 hide" data-enable="enabletexts">
                        <select id="panetextclass" class="form-control customselect" data-style="btn-black"
                                data-htmlclass="class" data-selector="textclass" data-css="textclass">

                            <option value="paneltext-blue">paneltext-blue</option>
                            <option value="paneltext-yellow">paneltext-yellow</option>
                            <option value="paneltext-english">paneltext-english</option>
                            <option value="paneltext-cyan">paneltext-cyan</option>
                            <option value="paneltext-violet">paneltext-violet</option>
                            <option value="paneltext-green">paneltext-green</option>
                            <option value="paneltext-orange">paneltext-orange</option>
                            <option value="menu-text">menu-text</option>
                            <option value="menu-text-button">menu-text-button</option>
                            <option value="text2">text2</option>
                            <option value="text3">text3</option>
                            <option value="text4">text4</option>
                            <option value="textblack">textblack</option>
                        </select>
                    </div>
                    <div class="col-sm-3 hide" data-enable="enabletext">
                        <a href="#" class="iconform editicon" data-editpopup="text"></a>
                        <a href="#" class="iconform viewicon" data-viewpopup="text"></a>
                        <a href="#" class="iconform addicon" data-addpopup="text"></a>
                    </div>
                </div>

            </div>
            <div class="row formrow form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3">
                        <div class="customelement">
                            <input type="checkbox" name="tabicon" id="enableIcon" value="icon"
                                   data-cssenable="enableIcon" data-htmltype="icon" data-getcontainer="enableIcon">
                            <label> Insert Icon</label>
                        </div>
                    </label>

                    <div class="col-sm-3 hide" data-enable="enableIcon">
                        <button type="button" class="btn btn-default btn-black" data-icon="iconbutton">Select Icon
                        </button>
                        <span class="iconView" data-iconview="enableIcon"><i class="fa fa-adjust"></i></span>
                        <input class="form-control form-controlblack hide geticonseting" name="enableIcon"
                               data-html="enableIcon" data-htmltype="icon" value="fa fa-adjust">


                    </div>
                    <div class="col-sm-3 hide" data-enable="enableIcon">
                        <select class="form-control customselect" data-selector="iconclass" data-css="class"
                                data-htmlclass="enableIcon" data-style="btn-black ">
                            <option value="icon-globeldark">Icon Globel Dark</option>
                            <option value="icon-globellight">Icon Globel Light</option>
                            <option value="blueCircleIcon">Blue Circle Icon</option>
                            <option value="whiteSquareIcon">White Square Icon</option>
                            <option value="grayRoundedIcon">grayRoundedIcon</option>
                            <option value="orangeCircleIcon">orangeCircleIcon</option>
                            <option value="blackRoundedIcon">blackRoundedIcon</option>
                            <option value="whiteRoundedIcon">whiteRoundedIcon</option>
                            <option value="whiteCircleIcon">whiteCircleIcon</option>
                            <option value="darkgrayCircleIcon">darkgrayCircleIcon</option>
                            <option value="blueWhiteSquareIcon">blueWhiteSquareIcon</option>
                            <option value="lightGrayCircleIcon">lightGrayCircleIcon</option>
                        </select>

                    </div>
                    <div class="col-sm-3 hide" data-enable="enableIcon">
                        <a href="#" class="iconform editicon" data-editpopup="text"></a>
                        <a href="#" class="iconform viewicon" data-viewpopup="text"></a>
                        <a href="#" class="iconform addicon" data-addpopup="text"></a>
                    </div>
                </div>

            </div>

            <div class="row formrow form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3"><span class="iconform arrowicon"></span> Tab Type</label>
                    <div class="col-sm-6">
                        <div class="radio-inline customelement">
                            <input type="radio" data-getcontainer="" data-csstype="dropdownmenu" value="none"
                                   checked="checked" name="tabtype{index}"> <label> Standard</label>
                        </div>
                        <div class="radio-inline customelement">
                            <input type="radio" data-getcontainer="dropdownenable" data-csstype="dropdownmenu"
                                   value="dropdownmenu" name="tabtype{index}"> <label> Drop Down </label>
                        </div>
                    </div>

                </div>
                <div class="collapse" data-showcontainer="dropdownenable">
                    <div class="form-group">
                        <label class="col-sm-3"><span class="iconform nowicon"></span> Select Item</label>
                        <div class="col-sm-6">
                            <select class="form-control customselect" multiple data-style="btn-black"
                                    data-htmlclass="dropdownmenu" data-selector="dropdownmenu" data-css="dropdownmenu">
                                {dropdownmenu}
                            </select>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row formrow form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3"><span class="iconform arrowicon"></span> Content</label>
                    <div class="col-sm-6">
                        <select class="form-control customselect" data-style="btn-black" data-htmlclass="content"
                                data-selector="contentType" data-css="contentType">
                            <option value="text">Text</option>
                            <option value="units">Units</option>
                            <option value="fields">Fields</option>
                            <option value="forms">Forms</option>
                            <option value="quote">Quote</option>
                            <option value="othercontent">Other Content</option>
                        </select>

                    </div>

                </div>

                <div class="form-group hide" data-panel-show="text">
                    <label class="col-sm-3"><span class="iconform nowicon"></span> Text</label>
                    <div class="col-sm-6">
                        <textarea class="form-control form-controlblack" name="middletext" id="middletext{index}"
                                  data-html="middletext" value="Header" placeholder="Insert Text"></textarea>
                    </div>
                </div>

                <div class="form-group hide" data-panel-show="othercontent">
                    <label class="col-sm-3"><span class="iconform nowicon"></span> Upload Content</label>
                    <div class="col-sm-6">
                        <input type="file" value="" data-show-preview="false" data-show-upload="false"
                               data-allowed-file-extensions='["html", "txt", "php", "js"]'
                               class="form-control form-controlblack file">
                    </div>
                </div>

                <div class="form-group hide" data-panel-show="units">
                    <ul class="boxMenuList">
                        <li data-id="1" data-name="widget 1">
                            <a href="#">
                                <img src="/public/img/admin-img.jpg">
                                <span>Unit 1</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="form-group hide" data-panel-show="fields">
                    <ul class="boxMenuList">
                        @if(count($fields))
                            @foreach($fields as $field)
                                <li data-id="{!! $field->id !!}" data-name="{!! $field->column_name !!}">
                                    <a href="#">
                                        <img src="/public/img/admin-img.jpg">
                                        <span>{{ $field->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            No Columns Available
                        @endif

                    </ul>
                </div>


                <div class="form-group hide" data-panel-show="forms">
                    <ul class="boxMenuList">


                        <li data-id="1" data-name="forms 1">
                            <a href="#">
                                <img src="/public/img/image-light-box.jpg">
                                <span>forms 2</span>
                            </a>
                        </li>
                        <li data-id="1" data-name="forms 1">
                            <a href="#">
                                <img src="/public/img/admin-img.jpg">
                                <span>forms 1</span>
                            </a>
                        </li>
                        <li data-id="1" data-name="forms 1">
                            <a href="#">
                                <img src="/public/img/images-img-3.jpg">
                                <span>forms 3</span>
                            </a>
                        </li>


                        <li data-id="1" data-name="forms 1">
                            <a href="#">
                                <img src="/public/img/image-light-box.jpg">
                                <span>forms 5</span>
                            </a>
                        </li>
                        <li data-id="1" data-name="forms 1">
                            <a href="#">
                                <img src="/public/img/images-img-3.jpg">
                                <span>forms 6</span>
                            </a>
                        </li>
                        <li data-id="1" data-name="forms 1">
                            <a href="#">
                                <img src="/public/img/admin-img.jpg">
                                <span>forms 4</span>
                            </a>
                        </li>

                    </ul>
                </div>


                <div class="form-group hide" data-panel-show="quote">
                    <ul class="boxMenuList">


                        <li data-id="1" data-name="quote 1">
                            <a href="#">
                                <img src="/public/img/images-img-3.jpg">
                                <span>quote 3</span>
                            </a>
                        </li>
                        <li data-id="1" data-name="quote 1">
                            <a href="#">
                                <img src="/public/img/image-light-box.jpg">
                                <span>quote 2</span>
                            </a>
                        </li>
                        <li data-id="1" data-name="quote 1">
                            <a href="#">
                                <img src="/public/img/admin-img.jpg">
                                <span>quote 1</span>
                            </a>
                        </li>


                        <li data-id="1" data-name="quote 1">
                            <a href="#">
                                <img src="/public/img/admin-img.jpg">
                                <span>quote 4</span>
                            </a>
                        </li>
                        <li data-id="1" data-name="quote 1">
                            <a href="#">
                                <img src="/public/img/image-light-box.jpg">
                                <span>quote 5</span>
                            </a>
                        </li>
                        <li data-id="1" data-name="quote 1">
                            <a href="#">
                                <img src="/public/img/images-img-3.jpg">
                                <span>quote 6</span>
                            </a>
                        </li>

                    </ul>
                </div>


            </div>
        </div>

    </script>
    <script>
        $(document).ready(function () {
            $('#studio-box').on('click', '.open-login', function (e) {
                e.stopPropagation();
                $("#dropdown-login").dropdown('toggle');
            });


            @if(isset($_GET['iframe']))
            $('#builderContain > .col-sm-6').last().removeClass('col-sm-6').addClass('col-sm-12');
            @endif
        });
    </script>
    {{--<script>--}}
    {{--$(function () {--}}
    {{--function tabsGenerate(json) {--}}
    {{--var li = $('<li/>', {class: "nav-item"});--}}
    {{--var deleteI = $('<button/>', {class: "fa fa-trash", "style": "color:#9A2720"});--}}
    {{--var a = $('<a/>', {--}}
    {{--class: "nav-link",--}}
    {{--"data-toggle": "tab",--}}
    {{--role: "tab",--}}
    {{--"aria-selected": "true"--}}
    {{--});--}}
    {{--var div = $('<div/>', {--}}
    {{--class: "tab-pane fade",--}}
    {{--role: "tabpanel",--}}
    {{--"aria-labelledby": "profile-tab"--}}
    {{--});--}}
    {{--$('#formTabContent').empty();--}}
    {{--$('.tab-items').empty();--}}
    {{--$.each(json, function (k, v) {--}}
    {{--var tab = a.clone();--}}
    {{--var del = deleteI.clone();--}}
    {{--del.attr('data-id', k);--}}

    {{--tab.text(v.name);--}}
    {{--tab.attr('href', '#' + v.name);--}}
    {{--tab.attr('aria-controls', v.name);--}}
    {{--var item = li.clone();--}}
    {{--item.append(del);--}}
    {{--item.append(tab);--}}

    {{--var divContent = div.clone();--}}
    {{--divContent.attr('aria-labelledby', 'tab-' + v.name);--}}
    {{--divContent.attr('id', v.name);--}}
    {{--divContent.text(v.name);--}}
    {{--$('#formTabContent').append(divContent);--}}
    {{--$('.tab-items').append(item)--}}

    {{--})--}}

    {{--}--}}


    {{--var jsonString = $('#tabs-json-area').text();--}}
    {{--var jsonData = JSON.parse(jsonString);--}}
    {{--tabsGenerate(jsonData);--}}
    {{--var tabJson = {name: null, data: {}}--}}
    {{--$('#save-tab-changes').on('click', function () {--}}
    {{--var newTab = (objectifyForm($('#tab-options')));--}}
    {{--var copyData = tabJson;--}}
    {{--copyData.name = newTab.name;--}}
    {{--copyData.data = [{'type': 'unit', 'value': 'price_calculate.default'}];--}}
    {{--jsonData.push(copyData);--}}
    {{--updateTabs(jsonData);--}}
    {{--$('#tab-manage-modal').modal('hide');--}}
    {{--$('#tabs-json-area').text(JSON.stringify(jsonData));--}}


    {{--});--}}

    {{--//data-id--}}
    {{--$('.tab-items').on('click', 'button[data-id]', function () {--}}
    {{--var id = $(this).attr('data-id');--}}
    {{--deleteTab(id);--}}
    {{--})--}}

    {{--function deleteTab(id) {--}}
    {{--jsonString = $('#tabs-json-area').text();--}}
    {{--jsonData = JSON.parse(jsonString);--}}
    {{--jsonData.splice(id)--}}
    {{--$('#tabs-json-area').text(JSON.stringify(jsonData));--}}
    {{--updateTabs(jsonData);--}}
    {{--tabsGenerate(jsonData);--}}
    {{--}--}}

    {{--function updateTabs(data) {--}}
    {{--$.ajax({--}}
    {{--url: "{!! route('form_edit_tab_generate',$slug) !!}",--}}
    {{--data: {data: data},--}}
    {{--headers: {--}}
    {{--'X-CSRF-TOKEN': $("input[name='_token']").val()--}}
    {{--},--}}
    {{--dataType: 'json',--}}
    {{--success: function (data) {--}}
    {{--if (!data.error) {--}}
    {{--$('.preview-area').html(data.html);--}}

    {{--jsonString = $('#tabs-json-area').text();--}}
    {{--jsonData = JSON.parse(jsonString);--}}
    {{--tabsGenerate(jsonData);--}}
    {{--}--}}
    {{--},--}}
    {{--type: 'POST'--}}
    {{--});--}}
    {{--}--}}

    {{--function objectifyForm(formArray) {//serialize data function--}}
    {{--var data = {};--}}
    {{--formArray.serializeArray().map(function (x) {--}}
    {{--data[x.name] = x.value;--}}
    {{--});--}}
    {{--data.data = {};--}}
    {{--return data;--}}
    {{--}--}}
    {{--});--}}

    {{--</script>--}}



    {{--<script>--}}
    {{--$("body").on('input', '.form-title-settings', function () {--}}
    {{--var val = $(this).val();--}}

    {{--$(".form-title").text(val);--}}
    {{--});--}}

    {{--$("body").on('change', '.select-field', function () {--}}
    {{--var checkbox = this;--}}
    {{--var field = $(checkbox).val();--}}
    {{--if (checkbox.checked) {--}}
    {{--var table = $(checkbox).data('table');--}}
    {{--$.ajax({--}}
    {{--url: "{!! route('mbsp_render_fields',$slug) !!}",--}}
    {{--data: {table: table, field: field},--}}
    {{--headers: {--}}
    {{--'X-CSRF-TOKEN': $("input[name='_token']").val()--}}
    {{--},--}}
    {{--dataType: 'json',--}}
    {{--success: function (data) {--}}
    {{--if (!data.error) {--}}
    {{--$(".field-box").append(data.html);--}}
    {{--}--}}
    {{--},--}}
    {{--type: 'POST'--}}
    {{--});--}}
    {{--// alert($(checkbox).val());--}}
    {{--} else {--}}

    {{--$("#bty-input-id-" + $(checkbox).data('id')).remove();--}}
    {{--}--}}
    {{--});--}}


    {{--$('button[data-action=save-form]').on('click', function () {--}}
    {{--var data = $('#fields-list').serialize();--}}
    {{--$.ajax({--}}
    {{--url: "{!! route('mbsp_save_form',$slug) !!}",--}}
    {{--data: data,--}}
    {{--headers: {--}}
    {{--'X-CSRF-TOKEN': $("input[name='_token']").val()--}}
    {{--},--}}
    {{--dataType: 'json',--}}
    {{--success: function (data) {--}}
    {{--if (!data.error) {--}}
    {{--window.location.href = "{!! route('blog_form_list',$slug) !!}";--}}
    {{--}--}}
    {{--},--}}
    {{--type: 'POST'--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
@stop
{!! BBstyle(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'css'.DS.'bootstrap-tabs-x.css')) !!}
{!! BBstyle(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'css'.DS.'bootstrap-select.min.css')) !!}
{!! BBstyle(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'css'.DS.'bootstrap-colorpicker.min.css')) !!}
{!! BBstyle(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'css'.DS.'jquery.mCustomScrollbar.css')) !!}
{!! BBstyle(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'css'.DS.'fileinput.min.css')) !!}
{!! BBstyle(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'css'.DS.'icon-buttons.css')) !!}
{!! BBstyle(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'css'.DS.'tab-studio.css')) !!}
{!! BBstyle(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'css'.DS.'styles.css')) !!}

{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'icon-plugin.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'tinymce.min.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'fileinput.min.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'jquery.mCustomScrollbar.min.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'bootstrap-tabs-x.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'bootstrap-select.min.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'bootstrap-colorpicker.min.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'less.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'bootbox.min.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'media-lightbox.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'class-tab-builder.js')) !!}
{!! BBscript(base_path('app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'public'.DS.'js'.DS.'main.js')) !!}