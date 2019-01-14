<div>
    {{ __('question.question') }}: {{ $question->question }} <br>
    {{ __('question.from') }}: @component('layout.user', ["user" => $question->asker])@endcomponent
    @can("delete", $question)
        <button class="question-remove" question-id="{{ $question->id }}">&times;</button>
    @endcan
</div>
