@extends("email.components.base")

@php
    $headings = collect([
        "Отдыхайте пока можете!",
        "Рабочая неделя близко...",
        "Как прошли выходные?",
        "Готовы исследовать неиследованное?",
        "Вы готовы?!",
    ]);

    $here_is_list = collect([
        "Вот список мероприятий на ближайшую неделю",
        "Вот что вас ждёт на следующей неделе",
        "Администрация подготовила следующие мероприятия",
    ]);

    $good_day = collect([
        "Хорошей недели!",
        "Продуктивной недели!",
        "У вас всё получится!",
    ]);

@endphp

@section("content")
    @component("email.components.h1")
        {{ $headings->random() }}
    @endcomponent

    @component("email.components.p")
        {{ $here_is_list->random() }}:

        <ul>
            @foreach ($events as $event)
                <li>
                    <a href="{{ $event->get_url() }}">
                        {{ $event->get_title() }}
                    </a>
                </li>
            @endforeach
        </ul>

    @endcomponent

    @component("email.components.p")
        {{ $good_day->random() }}
    @endcomponent

@endsection
