@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <div class="container">
        @if (session("status"))
            @if (session("status") == "expired")
                @alert(["type"=>"warning"])
                    Эту стадию уже отправил кто-то другой
                @endalert
            @endif
        @endif

        <ul>
            @foreach ($scenarios as $scenario)
                <li>
                    @php
                        $url = action("ScenarioController@show", ["id"=> $scenario->id]);
                    @endphp

                    <a href="{{ $url }}">
                        {{ $scenario->get_title() }} #{{ $scenario->id }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
