@extends('layout.logined')

@section('title')
    Все группы
@endsection

@section('content')
    @foreach ($groups as $group)
        @component("group.table", [
            "users" => $group["users"],
            "balance" => $group["balance"],
            "group" => $group["group"]
        ])
        @endcomponent
    @endforeach
@endsection
