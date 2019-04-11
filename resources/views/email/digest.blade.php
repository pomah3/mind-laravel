@extends("email.components.base")

@php
    $headings = collect([
        "Отдыхайте пока можете, глупцы!",
        "Рабочая неделя близко...",
        "Как прошли выходные?",
        "Готовы исследовать неиследованное?",
        "Вы готовы, дети?!",
    ]);

    $here_is_list = collect([
        "Вот список мероприятий на близжайшую неделю в нашем любимом IT-Лицее КФУ",
        "Вот что вас ждёт в стенах нашего родного лицея",
        "А чтобы неделя не казалась скучной, администрация подготовила следующие мероприятия",
    ]);

    $good_day = collect([
        "Хорошей недели и лёгких уроков!",
        "Продуктивной вам недели, лицеисты!",
        "Успехов в олимпиадах и проектах!",
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
