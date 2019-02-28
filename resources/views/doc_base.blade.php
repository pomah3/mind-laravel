@extends('layout.logined')

@section('title')
    {{ __('main.doc_base.title') }}
@endsection

@section('content')
    <div class="container">
        {!! $text !!}
    </div>
@endsection
