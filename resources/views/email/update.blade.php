@extends("email.components.base")

@section("content")

@component("email.components.p")
    Наша команда разработчиков рада предоставить Вам новую версию Mind:
@endcomponent

@component("email.components.h1")
    {{ $version }}
@endcomponent

@component("email.components.p")
    @php
        $url = URL::route("larecipe.show", [
            "version" => $version, "page" => "changelog"
        ]);
    @endphp

    Со списком изменений вы можете ознакомится <a href="{{ $url }}">по ссылке</a>
@endcomponent

@component("email.components.p")
    Приятного пользования! <br>
    <b>Команда Mind</b>
@endcomponent

@endsection
