@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="info">
        Имя: {{ $user->get_name() }} <br>
        @if ($user->type === "student")
            Баланс: {{ App\Transaction::get_balance($user) }}<br>
            Класс: {{ $user->student()->get_group() }}<br>
        @endif
    </div>
    <hr>
    <div class="notifications">
        @foreach ($user->notifications as $n)
            @component($n->data['view'], [
                "notification" => $n
            ])
            @endcomponent
        @endforeach
    </div>
@endsection
