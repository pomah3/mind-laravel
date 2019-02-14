@extends('layout.logined')

@section('title')
    Голосования
@endsection

@section('content')

    <div class="container container-points">
        <h2>Голосования</h2>
        @can('create', App\Poll::class)
            <a href="/polls/create" class="add-poll">+</a>
        @endcan

        <ol class="ol">
            @forelse ($polls as $poll)
                <li class="not-list-style poll-elem">
                    <a href="/polls/{{ $poll->id }}">{{ $poll->title }}</a>
                    @can("delete", $poll)
                        <button poll-id="{{ $poll->id }}" class="poll-delete">&times;</button>
                    @endcan
                    <div class="banner-label">Доступно до: <span>{{ $poll->till_date->format("d.m.Y") }}</span></div>
                </li>
            @empty
                <div class="not-found">
                    Нет доступных голосований
                </div>
            @endforelse
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
