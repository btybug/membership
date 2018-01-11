@extends('btybug::layouts.admin')
@section('content')
    <div class="col-md-10">
        <table id="fields-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Status</th>
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

                ajax: '{!! route('mbsp_members_lists') !!}',
                columns: [
                    {data: 'id', name: 'id',},
                    {data: 'username', name: 'username',},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'}
                ]
            });
        });
    </script>
@stop
