@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    <div class="container container-points">
        <h2>Мероприятия</h2>
        @can('create', App\Event::class)
            <a href="/events/create" class="add-event">+</a>
        @endcan

        @foreach ($events as $event)
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
        @endforeach
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
