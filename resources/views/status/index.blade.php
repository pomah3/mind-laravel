@extends('layout.logined')

@php($user = Auth::user())
@php($days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"])

@section('title')
    {{ __('status.index.title') }}
@endsection

@section('content')
    <div class="container">
        <div class="buttons">
            <div class="button-filter active-button par" id="all">Все классы</div>
            @foreach ($pars as $par)
                <div class="button-filter par" id="{{$par}}-par">{{$par}} классы</div>
            @endforeach
            <div class="help-block">
                <div class="help">?</div>
                <span class="tip">
                    @foreach ($status_r->get_all_statuses() as $status)
                        <strong>{{ $status }}</strong> - {{ __('status.types.'.$status) }}<br>
                    @endforeach
                </span>
            </div>
        </div>
        @foreach ($groups as $group)
            @component("status.table", [
                "users" => $group["users"],
                "group" => $group["group"],
                "status_r" => $status_r
            ])
            @endcomponent
        @endforeach
    </div>
@endsection

@push("scripts")
    <script>
        @foreach ($pars as $par)
            $('#{{$par}}-par').on('click', function() {
                $('.group-status').hide();
                $('.{{$par}}-par').show();
                $('.par').removeClass("active-button");
                $('#all').removeClass("active-button");
                $(this).addClass("active-button");
            });
        @endforeach
        $('#all').on('click', function() {
            $('.group-status').show();
            $('.par').removeClass("active-button");
            $('#all').addClass("active-button");
        });
    </script>

    <script>
        $(".status-set-button").click(function() {
            let that = this;
            let user = $(that).attr("user-id");
            let status = $(that).attr("status");

            $.ajax({
                method: "POST",
                url: "/status/" + user + "/" + status
            })
            // .done(function() {
                $(that).parent().parent().find(".status-set-button").removeClass("status-set-has");
                $(that).parent().parent().find(".status-set-button").addClass("status-set-hasnt");
                $(that).parent().parent().find(".status-set-button").html("-");

                $(that).removeClass("status-set-hasnt");
                $(that).addClass("status-set-has");
                $(that).html("+");
            // });
        });
    </script>
@endpush
