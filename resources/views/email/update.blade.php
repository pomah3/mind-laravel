@extends("email.components.base")

@section("content")

@component("email.components.h1")
    <b>Mind обновился!</b>
@endcomponent

@component("email.components.h2")
    <b>Что в новой версии:</b>
@endcomponent

@component("email.components.p")
    <ul>
        @foreach ($news as $new)
            <li>{{ $new }}</li>
        @endforeach
    </ul>
@endcomponent

@component("email.components.p")
    Приятного пользования! <br>
    <b>Команда Mind</b>
@endcomponent

@endsection
