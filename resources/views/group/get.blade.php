@extends('layout.logined')

@section('title')
    Группа {{ $group }}
@endsection

@section('content')
    @component('group.table', [
        "balance" => $balance,
        "group" => $group,
        "users" => $users
    ])
    @endcomponent
@endsection
