@extends('layout.logined')

@section('title')
    Документация
@endsection

@section('content')
    <div class="container">
        {!! $text !!}
    </div>
@endsection
