@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __('ask.show.title') }}
@endsection

@section('content')
    <form action="questions/store" method="POST">
        @csrf
        <textarea name="question"></textarea>
        <input type="submit" value="{{ __('question.ask') }}">
    </form>

    @foreach ($questions as $question)
        @component("question.question", ["question"=>$question])
        @endcomponent
    @endforeach

    @push("scripts")
        <script>
            $(".question-remove").click(function() {
                let id = $(this).attr("question-id");
                $.ajax({
                    method: "DELETE",
                    url: "/questions/" + id,
                })
                .done(function() {
                    $(this).parent().remove();
                });
            });
        </script>
    @endpush
@endsection
