
@extends('layout.logined')

@section('title')
    {{ $poll->title }}
@endsection

@section('content')
    <div class="container container-points">
        <h2><strong>{{ $poll->title }}</strong></h2>
        <p>
            Автор: @user(["user" => $poll->creator])
        </p>
        <p>
            {{ $poll->content }}
        </p>

        @php($var_voted = $poll->get_user_vote(Auth::user()))
        <div class="one-poll">
            @foreach ($poll->get_variants() as $id => $v)
                <div class="one-poll-elem {{ $id === $var_voted ? "vote-this" : "vote-not-this" }}">
                    {{ $v["value"] }}
                    @can("vote", $poll)
                        <button variant-id="{{$id}}" poll-id="{{$poll->id}}" class="poll-vote">
                            {!! $id === $var_voted ? "&times;" : '+' !!}
                        </button>
                    @endcan
                    @can("see_result", $poll)
                        <span class="vote-count">{{ $v["count"] }}</span>
                    @endcan
                </div>
            @endforeach
        </div>
    </div>
    @push('scripts')
        <script>
            $(".poll-vote").click(function() {
                let variant_id = $(this).attr('variant-id');
                let poll_id = $(this).attr('poll-id');

                $.ajax({
                    method: "POST",
                    url: `/polls/${poll_id}/vote/${variant_id}`,
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
