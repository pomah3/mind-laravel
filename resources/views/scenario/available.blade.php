@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <div class="container">
        <ul>
            @foreach ($scenarios as $scenario)
                <li>
                    <a href="/scenarios/create?scenario={{ $scenario->get_name() }}">
                        {{ $scenario->get_title() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
