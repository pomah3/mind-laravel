@extends('layout.logined')

@section('title')
    {{ __("user.show.title") {{ $user->get_name() }} }}
@endsection

@section('content')
    {{ __("user.show.name") }}: {{ $user->get_name() }}
@endsection
