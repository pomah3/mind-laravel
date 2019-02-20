<div class="one-question">
    <div class="question-text"><p>{{ $question->question }}</p></div>
    <div class="from"><a class="userlink">@component('layout.user', ["user" => $question->asker])@endcomponent</a></div>
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
        <textarea class="question-answer-send-text" placeholder="Введите ответ"></textarea>
        <button class="question-answer" question-id="{{ $question->id }}">{{ __('question.answer') }}</button>
    @endcan
</div>
