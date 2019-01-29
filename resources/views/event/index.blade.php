@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    @can('create', App\Event::class)
        <a href="/events/create">создать</a>
    @endcan

    @foreach ($events as $event)
        <div class="event">
            <h1>{{ $event->title }}</h1>
            author: @user(["user" => $event->author]) <br>
            from_date: {{ $event->from_date }}
            till_date: {{ $event->till_date }}
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

@endsection
