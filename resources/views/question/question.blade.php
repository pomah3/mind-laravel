<div>
    {{ __('question.question') }}: {{ $question->question }} <br>
    {{ __('question.from') }}: @component('layout.user', ["user" => $question->asker])@endcomponent
    @can("delete", $question)
        <button class="question-remove" question-id="{{ $question->id }}">&times;</button>
    @endcan

    @if ($question->answered_at != null)
        <div>
            <div>
                {{ $question->answer }}
            </div>
            @component('layout.user', ["user" => $question->answerer])@endcomponent
        </div>
    @endif

    @can("answer", $question)
        <textarea class="question-answer-text"></textarea>
        <button class="question-answer" question-id="{{ $question->id }}">{{ __('answer.answer') }}</button>
    @endcan
</div>
