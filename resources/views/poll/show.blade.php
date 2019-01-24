
@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <h1>{{ $poll->title}}</h1>
    <p>
        {{ $poll->content }}
    </p>

    <ul>
        @php($var_voted = $poll->get_user_vote(Auth::user()))
        @foreach ($poll->get_variants() as $id => $v)
            <li>
                {{ $v["value"] }}
                @can("see_result", $poll)
                    : {{ $v["count"] }}
                @endcan
                @can("vote", $poll)
                    <button variant-id="{{$id}}" poll-id="{{$poll->id}}" class="poll-vote">
                        {{ $id === $var_voted ? "-" : '+'}}
                    </button>
                @endcan
            </li>
        @endforeach
    </ul>

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
