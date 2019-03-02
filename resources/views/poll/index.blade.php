@extends('layout.logined')

@section('title')
    {{ __('poll.index.title') }}
@endsection

@section('content')

    <div class="container container-points">
        <h2>Голосования</h2>
        @can('create', App\Poll::class)
            <a href="/polls/create" class="add-poll">+</a>
        @endcan
        <div class="buttons">
            <div class="button-filter active-button" id="new-polls">Доступные</div>
            <div class="button-filter" id="old-polls">Прошедшие</div>
        </div>

        <div class="flex">
            @forelse ($polls as $poll)
                <div class="poll-elem {{ $poll->till_date <= now() ? "old-poll" : "new-poll"}} dis-none">
                    @can("delete", $poll)
                        <button poll-id="{{ $poll->id }}" class="poll-delete">&times;</button>
                    @endcan
                    <a href="/polls/{{ $poll->id }}">{{ $poll->title }}</a>
                    <div class="banner-label">Доступно до: <span>{{ $poll->till_date->format("d.m.Y") }}</span></div>
                </div>
            @empty
                <div class="not-found">
                    Нет доступных голосований
                </div>
            @endforelse
        </div>

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
                $('#new-polls').click(function() {
                    $('.old-poll').hide();
                    $('.new-poll').show();
                    $('.button-filter').removeClass("active-button");
                    $(this).addClass("active-button");
                }).click();
                $('#old-polls').click(function() {
                    $('.new-poll').hide();
                    $('.old-poll').show();
                    $('.button-filter').removeClass("active-button");
                    $(this).addClass("active-button");
                });
            </script>
        @endpush
    </div>

@endsection
