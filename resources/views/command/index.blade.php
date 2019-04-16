@extends('layout.logined')

@section('title')
    {{ __("changelog.title") }}
@endsection

@section('content')
    <div class="container container-points">
        @foreach ($commands as $command)
            <form action="" method="POST">
                @csrf
                <strong>{{ $command->getName() }}</strong>

                @foreach ($args($command) as $arg)
                    <input type="text" name="{{ $arg["name"] }}" placeholder="{{ $arg["desc"] }}">
                @endforeach

                <input type="hidden" name="_command" value="{{ $command->getName() }}">

                <input type="submit">
            </form>
        @endforeach
    </div>
@endsection
