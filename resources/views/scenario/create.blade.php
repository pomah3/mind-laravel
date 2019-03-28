@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <div class="container">
        <form action="/scenarios" method="POST">
            @csrf
            @foreach ($scenario->get_input() as $input)
                {!! $input->get_html() !!} <br>
            @endforeach

            <input type="hidden" name="scenario" value="{{ $scenario->get_name() }}">

            <input type="submit">
        </form>
    </div>
@endsection
