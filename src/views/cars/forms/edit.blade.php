@extends( 'btybug::layouts.admin' )
@section( 'content' )
    <div class="row">
        <h2>Edit Form</h2>
        <div class="col-md-12">
            {!! Form::model($form,['id'=>'fields-list']) !!}
            {!! Form::hidden('id',$form->id) !!}
            <div class="bty-panel-collapse 	bty-panel-cl-tomato">
                <div>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#general"
                       aria-expanded="true">
                        <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        <span class="title">General</span>
                        <button class="bty-btn bty-btn-save bty-btn-cl-black bty-btn-size-sm pull-right m-r-10" data-action="save-form"><span>Save</span></button>
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
                                    <input class="bty-input-label-2 m-t-0 form-title-settings" placeholder="What is your Form title ?"
                                           name="form_title" type="text" value="Create post">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

            <h2>Preview Area</h2>

            <div class="col-md-12 preview-area">
                {!! form_render(['id' => $form->id]) !!}
            </div>
        </div>
    </div>
@stop
@section( 'CSS' )
@stop

@section( 'JS' )
    {!! BBscript(plugins_path('vendor/btybug.hook/blog/src/public/scripts.js')) !!}
@stop