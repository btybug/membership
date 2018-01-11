@extends('btybug::layouts.mTabs',['index'=>'mb_settings'])
@section('tab')
    <div class="col-md-10">
        <table id="fields-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created</th>
                <th>Actions</th>
            </thead>
        </table>
    </div>
@stop
@section('CSS')
    {!! Html::style('public/js/DataTables/Buttons-1.5.1/js/buttons.bootstrap.js') !!}
@stop
@section('JS')
    {!! Html::script('public/js/DataTables/datatables.js') !!}
    <script>
        $(function () {
            $('#fields-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', {
                        text: 'Reload',
                        className: 'btn btn-info',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                ],

                ajax: '{!! route('mbsp_statuses') !!}',
                columns: [
                    {data: 'id', name: 'id',},
                    {data: 'slug', name: 'slug',},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'created', name: 'created'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop
