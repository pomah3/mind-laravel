
@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <h1>{{ $poll->title}}</h1>
    <p>
        {{ $poll->content }}
    </p>

    <ul>
        @foreach ($poll->get_variants() as $id => $v)
            <li variant-id="{{$id}}">
                {{ $v["value"] }}: {{ $v["count"] }}
            </li>
        @endforeach
    </ul>
@endsection
