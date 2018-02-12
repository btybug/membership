@extends('btybug::layouts.admin')
@section('content')
    <div class="col-md-12">
        [form slug=create_{{$slug}} data-id={{ $post->id }} edit=id]
    </div>
@stop
@section('CSS')
@stop
@section('JS')
@stop