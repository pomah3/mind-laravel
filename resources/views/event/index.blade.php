@extends('layout.logined')

@section('title')
    Мероприятия
@endsection

@section('content')
    <div class="container container-points">
        <h2>Мероприятия</h2>
        @can('create', App\Event::class)
            <a href="/events/create" class="add-event">+</a>
        @endcan

        @forelse ($events as $event)
            <div class="event">
                <h1>{{ $event->title }}</h1>
                <button class="event-remove" event-id="{{ $event->id }}">remove</button>
                author: @user(["user" => $event->author]) <br>
                from_date: {{ $event->from_date }} <br>
                till_date: {{ $event->till_date }} <br>
                <div class="event-description">
                    {{ $event->description }}
                </div>

                <ul>
                    @foreach ($event->users as $user)
                        <li>
                            @user(["user"=>$user])
                        </li>
                    @endforeach
                </ul>
            </div>
        @empty
            <div class="not-found">
                Нет активных мероприятий
            </div>
        @endforelse
    </div>
    @push('scripts')
        <script>
            $(".event-remove").click(function() {
                let that = this;
                let id = $(that).attr("event-id");
                $.ajax({
                    "method": "DELETE",
                    "url": "/events/" + id
                }).done(function() {
                    $(that).parent().remove();
                })
            })
        </script>
    @endpush

@endsection
