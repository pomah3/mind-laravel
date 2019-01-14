<div>
    {{ __('question.question') }}: {{ $question->question }} <br>
    {{ __('question.from') }}: @component('layout.user', ["user" => $question->asker])@endcomponent
</div>
