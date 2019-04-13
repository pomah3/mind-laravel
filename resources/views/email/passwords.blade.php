@extends("email.components.base")

@section("content")
    @component("email.components.h1")
        Пароли
    @endcomponent

    @component("email.components.p")
        Уважаемый админ, высылаю вам список пользователей и их паролей
    @endcomponent

@endsection
