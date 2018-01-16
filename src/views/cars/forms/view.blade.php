@extends( 'btybug::layouts.admin' )
@section( 'content' )
    <div class="row">
      {!! form_render(['id' => $form->id]) !!}
    </div>
@stop
@section( 'CSS' )
@stop

@section( 'JS' )
@stop