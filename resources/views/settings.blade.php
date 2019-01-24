@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <h2>Поменять пароль</h2>

    @if (isset($status))
        @if ($status == "wrong_password")
            @alert(["type"=>"danger"])
                Неправильный пароль!
            @endalert
        @elseif ($status == "successful")
            @alert(["type" => "success"])
                Успешно!
            @endalert
        @endif
    @endif

    @if ($errors->any())
        @alert(["type"=>"danger"])
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endalert
    @endif

    <form action="/settings/change_password" method="POST">
        @csrf

        Старый пароль: <input type="password" name="old_password"><br>
        Новый пароль: <input type="password" name="new_password"><br>
        Подтверждение пароля: <input type="password" name="new_password_confirmation"><br>

        <input type="submit">

    </form>
@endsection
