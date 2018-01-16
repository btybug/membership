@extends('btybug::layouts.admin')
@section('content')
    <div class="col-md-10">
        <a href="{!! route('mbsp_plans_create') !!}" class="btn btn-default btn-success pull-left" tabindex="0" aria-controls="fields-table"><span>Create New</span></a>
        <a href="{!! route('mbsp_settings_mb_options') !!}" class="btn  btn-warning pull-right" tabindex="0" aria-controls="fields-table"><span>Settings</span></a>
        <table id="fields-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Plan Id</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Interval</th>
                <th>Interval Count</th>
                <th>Live mode</th>
                <th>Statement Descriptor</th>
                <th>Is Active</th>
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
                    }
                ],

                ajax: '{!! route('mbsp_plans_lists') !!}',
                columns: [
                    {data: 'id', name: 'id',},
                    {data: 'plan_id', name: 'plan_id',},
                    {data: 'name', name: 'name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'currency', name: 'currency'},
                    {data: 'interval', name: 'interval'},
                    {data: 'interval_count', name: 'interval_count'},
                    {data: 'livemode', name: 'livemode'},
                    {data: 'statement_descriptor', name: 'statement_descriptor'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created', name: 'created'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop
