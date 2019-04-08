@extends("email.base")

@section("content")
    {{ $user->get_name() }}, подтвердите свою почту
    Ссылка: <a href="{{ URL::signedRoute("verify_email", ["user"=>$user, "email"=>$user->email]) }}">клик</a>
@endsection
