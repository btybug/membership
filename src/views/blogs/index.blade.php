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

    <div class="modal modal-info fade" id="blog-modal" datatable="" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Blog</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body p0">
                    <div class="row form-box">
                        {!! Form::open(['url'=>route('mbsp_blog_create')]) !!}
                        <div class="col-md-12">
                            <div class="form-horizontal mt15 p15">
                                <div class="">
                                    <div class="form-group">
                                        <label for="sport_name" class="col-sm-2 control-label">Titl</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('title',null,['class'=>'form-control','id'=>'blog_name','placeholder'=>'Cars,Mobiles ...']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save-changes">Save changes</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@section('CSS')
    {!! Html::style('public/js/DataTables/Buttons-1.5.1/js/buttons.bootstrap.js') !!}
@stop
@section('JS')
    {!! Html::script('public/js/DataTables/datatables.js') !!}
    <script>
        $(function () {
            var blogs = $('#blogs-table').DataTable({
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
                        className: 'btn btn-primary add-new'
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

            $(document).ready(function () {
                $("body").on('click','.save-changes',function () {
                    var form = $(".form-box form");
                    $.ajax({
                        data: form.serialize(),
                        type: 'POST',
                        url:  form.attr('action'),
                        headers: {
                            'X-CSRF-TOKEN': $("input[name='_token']").val()
                        },
                        datatype: 'json',
                        cache: false,
                        success: function (data) {
                            if(! data.error){
                                blogs.ajax.reload();
                                $("#form-modal").modal('hide');
                            }else{
                                // alert(data.message);
                            }
                        }
                    });
                });

                $("body").on('click','.add-new',function () {
                    $("#blog-modal").modal();
                });
            });
        });
    </script>
@stop
