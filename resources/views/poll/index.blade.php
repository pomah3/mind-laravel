@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')

    <div class="container container-points">
        <h2>Голосования</h2>
        @can('create', App\Poll::class)
            <a href="/polls/create" class="add-poll">+</a>
        @endcan

        <ol class="ol">
            @foreach ($polls as $poll)
                <li class="not-list-style poll-elem">
                    <a href="/polls/{{ $poll->id }}">{{ $poll->title }}</a>
                    @can("delete", $poll)
                    <button poll-id="{{ $poll->id }}" class="poll-delete">&times;</button>
                    @endcan
                </li>
            @endforeach
        </ol>

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
    </div>

@endsection
