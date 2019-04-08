@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __('question.show.title') }}
@endsection

@section('content')
    <div class="container">
        <form action="questions/store" method="POST" class="form-40-marg-all">
            @csrf
            <textarea name="question" class="form-control" placeholder="{{ __('question.show.ask') }}"></textarea>
            <input type="submit" value="{{ __('main.submit.ask') }}" class="submit">
        </form>

        @foreach ($questions as $question)
            @component("question.question", ["question"=>$question])
            @endcomponent
        @endforeach
    </div>
    @push("scripts")
        <script>
            $(".question-remove").click(function() {
                let that = this;
                let id = $(that).attr("question-id");

                $.ajax({
                    method: "DELETE",
                    url: "/questions/" + id,
                })
                .done(function() {
                    $(that).parent().remove();
                });
            });
            $(".question-answer").click(function() {
                let that = this;

                let id = $(that).attr("question-id");
                let answer = $(that).parent().find(".question-answer-send-text").val();

                $.ajax({
                    method: "POST",
                    data: {
                        answer: answer
                    },
                    url: "/questions/answer/" + id,
                })
                .done(function() {
                    document.location.reload();
                })
                .fail(function(err) {
                    console.log(err);
                });
            });
        </script>
    @endpush
@endsection
