@extends("email.components.base")

@section("content")
    @component("email.components.h1")
        Почта подтверждена!
    @endcomponent

    @component("email.components.p")
        Данные для входа:
        <ul>
            <li>
                Логин: {{ $user->email }} <br>
            </li>
            <li>
                Пароль: {{ $user->password }}
            </li>
        </ul>
    @endcomponent

@endsection
