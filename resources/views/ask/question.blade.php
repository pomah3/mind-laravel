<div>
    {{ __('question.question') }}: {{ $question->question }}
    {{ __('question.from') }}: @component('layout.user', ["user" => $question->user_from])
</div>
