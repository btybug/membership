@extends('btybug::layouts.admin')
@section('content')
    <div class="col-md-10">
        <table id="fields-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Price</th>
                <th>Period</th>
                <th>Period Type</th>
                <th>Currency</th>
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
                            window.location.replace("{!! route('mbsp_plans_create') !!}");
                        }
                    }
                ],

                ajax: '{!! route('mbsp_plans_lists') !!}',
                columns: [
                    {data: 'id', name: 'id',},
                    {data: 'title', name: 'title'},
                    {data: 'price', name: 'price'},
                    {data: 'period', name: 'period'},
                    {data: 'period_type', name: 'period_type'},
                    {data: 'currency', name: 'currency'},
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
