@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    @can('create', App\Poll::class)
        <a href="/polls/create">Создать</a>
    @endcan

    <ul>
        @foreach ($polls as $poll)
            <li>
                <a href="/polls/{{ $poll->id }}">{{ $poll->title }}</a>
                @can("delete", $poll)
                <button poll-id="{{ $poll->id }}" class="poll-delete">&times;</button>
                @endcan
            </li>
        @endforeach
    </ul>

    @push('scripts')
        <script>
            $(".poll-delete").click(function() {
                let poll_id = $(this).attr("poll-id");
                $.ajax({
                    "method": "DELETE",
                    "url": "/polls/" + poll_id
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
