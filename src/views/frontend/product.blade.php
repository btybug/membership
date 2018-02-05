@extends('mbshp::frontend.layouts.app')
@section('content')
    <section>
        {!! BBRenderUnits($unit,['product'=>$product]) !!}
    </section>

@stop
@section('CSS')

@stop

@section('JS')

@stop
