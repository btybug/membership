@extends('btybug::layouts.admin')
@section('content')
    <div class="col-md-10">
        <table id="fields-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Icon</th>
                <th>Plan ID</th>
                <th>Description</th>
                <th>Is Active</th>
                <th>Created</th>
                <th>Updated</th>
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
                    }, {
                        text: 'Create New',
                        className: 'btn btn-success',
                        action: function (e, dt, node, config) {
                            window.location.replace("{!! route('mbsp_new_membership') !!}");
                        }
                    }
                ],

                ajax: '{!! route('mbsp_mb_types_lists') !!}',
                columns: [
                    {data: 'id', name: 'id',},
                    {data: 'title', name: 'title'},
                    {data: 'icon', name: 'icon'},
                    {data: 'plan_id', name: 'plan_id'},
                    {data: 'description', name: 'description'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop
