@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    @component('group.table', [
        "balance" => $balance,
        "group" => $group,
        "users" => $users
    ])
    @endcomponent
@endsection
