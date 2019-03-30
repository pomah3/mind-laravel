@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <div class="container">
        <p> {{ $scenario->get_output(Auth::user()) }} </p>

        <form action="/scenarios/{{ $scenario->id }}/answer" method="POST">
            @csrf
            @foreach ($scenario->get_input() as $input)
                {!! $input->get_html() !!} <br>
            @endforeach

            <input type="hidden" name="scenario" value="{{ $scenario->get_name() }}">

            @if (!$scenario->is_finished())
                <input type="submit">
            @endif
        </form>
    </div>
@endsection
