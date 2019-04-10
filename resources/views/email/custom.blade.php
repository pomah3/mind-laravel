@extends("email.components.base")

@section("content")
    @component("email.components.h1")
        {{ $subject }}
    @endcomponent

    @component("email.components.p")
        {{ $text }}
    @endcomponent
@endsection
