@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <ul>
        @foreach ($users as $user)
            <li>
                @user(["user" => $user])
            </li>
        @endforeach
    </ul>
@endsection
