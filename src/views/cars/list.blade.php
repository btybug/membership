@extends('btybug::layouts.admin')
@section('content')

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 main_container_11">
        <table id="users-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>Description</th>
                <th>Image</th>
                <th>Author</th>
                <th>Status</th>
                <th>Created date</th>
                <th>Actions</th>
            </thead>
        </table>
    </div>
    @include('resources::assests.magicModal')
@stop
@section('CSS')
@stop
@section('JS')
    <script>

        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('carsData') !!}',
                dom: 'Bfrtip',
                columnDefs: [
                    {
                        targets: 1,
                        className: 'noVis'
                    }
                ],
                buttons: [
                    {
                        extend: 'colvis',
                        columns: ':not(.noVis)'
                    },
                    {
                        text: 'Create New',
                        action: function (e, dt, node, config) {
                            window.location = '/admin/membership/cars/new-post'
                        }
                    },
                    {
                        text: 'Settings',
                        action: function (e, dt, node, config) {
                            window.location = '/admin/membership/cars/settings'
                        }
                    }
                ]
                , colReorder: {
                    realtime: false
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'description', name: 'description'},
                    {data: 'image', name: 'image'},
                    {data: 'author', name: 'author'},
                    {data: 'status', name: 'status'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop