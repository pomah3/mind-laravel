@extends('layout.logined')

@section('title')
    {{ __("changelog.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <ul>
            @foreach ($versions as $version)
                <li>
                    @php
                        $url = URL::route("larecipe.show", [
                            "version" => $version, "page" => "changelog"
                        ]);
                    @endphp

                    <a href="{{ $url }}">
                        @if ($current == $version)
                            <b>{{ $version }}</b>
                        @else
                            {{ $version }}
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
