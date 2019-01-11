@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="info">
        Имя: {{ $user->get_name() }} <br>
        @if ($user->type === "student")
            Баланс: {{ App\Transaction::balance($user) }}<br>
            Класс: {{ $user->student()->get_group() }}<br>
        @endif
    </div>
    <div class="timetable">
        Расписание
    </div>
    <div class="notifications">

    </div>
@endsection
