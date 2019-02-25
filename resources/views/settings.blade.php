@extends('layout.logined')

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="container">
        <div class="change">
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

            <form action="/settings/change_password" method="POST" class="form-80">
                @csrf

                <label for="old_password">Старый пароль:</label>
                <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Введите текущий пароль">
                <label for="new_password">Новый пароль:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Придумайте пароль">
                <label for="new_password_confirmation">Подтверждение пароля:</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Введите его ещё раз">

                <input type="submit" class="submit" value="Поменять пароль">

            </form>
        </div>
        <div class="change">
            <h2>Поменять почту</h2>

            <form action="/settings/change_email" method="POST" class="form-80">
                @csrf

                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Введите новую почту">

                <input type="submit" class="submit" value="Поменять почту">
            </form>
        </div>
    </div>
@endsection
