@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="info">
        Имя: {{ $user->get_name() }}
        @if ($user->type === "student")
            Баланс: баланс<br>
            Класс: класс<br>
            Классрук: классрук<br>
            Воспит: воспит<br>
        @endif
    </div>
    <div class="timetable">
        Расписание
    </div>
    <div class="notifications">

    </div>
@endsection
