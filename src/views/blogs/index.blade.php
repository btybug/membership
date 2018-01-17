@extends('btybug::layouts.mTabs',['index'=>'mb_settings'])
<!-- Nav tabs -->
@section('tab')
    <div class="col-md-10">
        <table id="blogs-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Created Date</th>
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
            $('#blogs-table').DataTable({
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

                ajax: '{!! route('mbsp_blogs') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'author_id', name: 'author_id'},
                    {data: 'description', name: 'description'},
                    {data: 'slug', name: 'slug'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop
