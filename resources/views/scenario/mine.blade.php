@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <div class="container">
        <ul>
            @foreach ($scenarios as $scenario)
                <li>
                    <a href="/scenarios/{{ $scenario->id }}">
                        {{ $scenario->get_title() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
