@extends('btybug::layouts.admin')
@section('content')
    <div class="col-md-8">
        [form slug=edit_{{$slug}} data-id={{ $post->id }} edit=id]
    </div>
@stop
@section('CSS')
@stop
@section('JS')
@stop