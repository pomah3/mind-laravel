@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <div class="container">
        <p> {!! $scenario->get_output(Auth::user()) !!} </p>

        @php
            $url = action("ScenarioController@answer", ["id" => $scenario->id]);
        @endphp
        <form action="{{ $url }}" method="POST">
            @csrf
            @foreach ($scenario->get_input() as $input)
                {!! $input->get_html() !!} <br>
            @endforeach

            <input type="hidden" name="stage" value="{{ $scenario->get_stage() }}">

            @if (!$scenario->is_finished())
                <input type="submit">
            @endif
        </form>
    </div>
@endsection
