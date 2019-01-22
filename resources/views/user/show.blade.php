@extends('layout.logined')

@section('title')
    {{ $user->get_name() }}
@endsection

@section('content')
    {{ __("user.show.name") }}: {{ $user->get_name() }} <br>

    @can("view_password", $user)
        {{ __('user.show.login') }}: {{ $user->id }} <br>
        {{ __('user.show.password') }}: {{ $user->password }} <br>
    @endcan

@endsection
