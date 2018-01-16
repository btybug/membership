@extends('btybug::layouts.mTabs',['index'=>'cars_pages'])
@section('tab')
    <div role="tabpanel" class="m-t-10" id="main">
        <div class="col-md-12 m-b-10">
            <a target="_blank" href="{!! route('form_builder_cars') !!}" class="bty-btn bty-btn-add bty-btn-size-md pull-right">New Form</a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 main_container_11">
            <table class="bty-table bty-table-hover bty-table-th-cl-beige" id="tpl-table">
                <thead>
                <tr class="">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Shortcode</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Created date</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @if(count($pluginForms))
                    @foreach($pluginForms as $pluginForm)
                        <tr>
                            <th>{!! $pluginForm->id !!}</th>
                            <th>{!! $pluginForm->name !!}</th>
                            <th>{!! $pluginForm->slug !!}</th>
                            <th>[form id={{ $pluginForm->id }}] or [form slug={{ $pluginForm->slug }}]</th>

                            <th>{{ $pluginForm->created_by }}</th>
                            <th>{!! ($pluginForm->blocked) ? "Blocked" : "Active" !!}</th>
                            <th>{{ BBgetDateFormat($pluginForm->created_at) }}</th>
                            <th>
                                <a href="{!! route('form_settings_cars',['id' => $pluginForm->id]) !!}" class="btn btn-warning"><i class="fa fa-cog"></i></a>
                                <a href="{!! route('form_view_cars',['id' => $pluginForm->id]) !!}" class="bty-btn-acction bt-view"></a>
                                <a href="{!! route('form_edit_cars',['id' => $pluginForm->id]) !!}" class="bty-btn-acction bt-edit"></a>
                            </th>
                        </tr>
                    @endforeach
                @endif
                @if(count($forms))
                    @foreach($forms as $form)
                        <tr>
                            <th>{!! $form->id !!}</th>
                            <th>{!! $form->name !!}</th>
                            <th>{!! $form->slug !!}</th>
                            <th>[form id={{ $form->id }}] or [form slug={{ $form->slug }}]</th>

                            <th>{{ $form->created_by }}</th>
                            <th>{!! ($form->blocked) ? "Blocked" : "Active" !!}</th>
                            <th>{{ BBgetDateFormat($form->created_at) }}</th>
                            <th>
                                <a href="{!! route('form_settings_cars',['id' => $form->id]) !!}" class="btn btn-warning"><i class="fa fa-cog"></i></a>
                                <a href="{!! route('form_edit_cars_builder_cars',['id' => $form->id]) !!}" class="bty-btn-acction bt-edit"></a>
                                <a href="" class="bty-btn-acction bt-delete"></a>
                            </th>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('resources::assests.magicModal')
@stop
@section('CSS')
@stop
@section('JS')
@stop