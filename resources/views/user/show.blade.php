@extends('layout.logined')

@section('title')
    {{ __("user.show.title") }} {{ $user->get_name() }}
@endsection

@section('content')
    {{ __("user.show.name") }}: {{ $user->get_name() }} <br>

    @can("view_password", $user)
        {{ __('user.show.password') }}: {{ $user->password }}
    @endcan

@endsection
