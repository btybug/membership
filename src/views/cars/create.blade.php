@extends('btybug::layouts.admin')

@section('content')
    <div class="col-md-8">
        {!! form_render(get_active_form()) !!}
    </div>
@stop
@section('CSS')
@stop
@section('JS')
    {!! HTML::script('/js/tinymice/tinymce.min.js') !!}
    <script>
//        tinymce.init({
//            selector: '#post-desc', // change this value according to your HTML
//            height: 200,
//            theme: 'modern',
//            plugins: [
//                'advlist anchor autolink autoresize autosave bbcode charmap code codesample colorpicker contextmenu directionality emoticons fullpage fullscreen hr image imagetools importcss insertdatetime legacyoutput link lists media nonbreaking noneditable pagebreak paste preview print save searchreplace spellchecker tabfocus table template textcolor textpattern visualblocks visualchars wordcount shortcodes',
//            ],
//            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
//            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help shortcodes',
//            image_advtab: true
//        });
    </script>
@stop