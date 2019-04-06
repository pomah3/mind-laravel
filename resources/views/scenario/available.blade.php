@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <div class="container">
        <ul>
            @foreach ($scenarios as $scenario)
                <li>
                    @php
                        $url = action("ScenarioController@create_index", [
                            "scenario" => $scenario->get_name()
                        ]);
                    @endphp

                    <a href="{{ $url }}">
                        {{ $scenario->get_title() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
