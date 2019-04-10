@extends("email.components.base")

@section("content")
    @component("email.components.h1")
        <b>Подтвердите почту!</b>
    @endcomponent

    @component("email.components.p")
        @php
            $url = URL::signedRoute("verify_email", ["user"=>$user, "email"=>$email]);
        @endphp

        {{ $user->get_name() }}, подтвердите свою почту по <a href="{{ $url }}">ссылке</a> и дождитесь ответного письма!
    @endcomponent

    @component("email.components.p")
        Приятного пользования! <br>
        <b>Команда Mind</b>
    @endcomponent
@endsection
