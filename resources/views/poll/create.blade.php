@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    @can('create', App\Poll::class)
        <a href="/polls/create">Создать</a>
    @endcan

    <ul>
        @foreach ($polls as $poll)
            <li>
                <a href="/polls/{{ $poll->id }}">{{ $poll->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection
