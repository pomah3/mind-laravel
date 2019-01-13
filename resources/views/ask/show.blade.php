@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __('ask.show.title') }}
@endsection

@section('content')
    @foreach ($questions as $question)
        @component("question.question", ["question"=>$question])
        @endcomponent
    @endforeach
@endsection
