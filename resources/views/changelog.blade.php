@extends('layout.logined')

@section('title')
    {{ __("changelog.title") }}
@endsection

@section('content')
    <div class="container container-points">
        @foreach ($versions as $version)
            <div>
                <h1>{{ $version["name"] }}</h1>
                <p>{{ $version["description"] }}</p>
                <p>
                    {{ $version["list_sentence"] }}:

                    @if (isset($version["news"][0]))
                        <ul>
                            @foreach ($version["news"] as $new)
                                <li>{{ $new }}</li>
                            @endforeach
                        </ul>
                    @else
                        @foreach ($version["news"] as $title => $content)
                            <h3>{{ $title }}</h3>
                            <p>{{ $content }}</p>
                        @endforeach
                    @endif
                </p>
            </div>
        @endforeach
    </div>
@endsection
