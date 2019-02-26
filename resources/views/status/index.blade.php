@extends('layout.logined')

@php($user = Auth::user())
@php($days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"])

@section('title')
    Timetable
@endsection

@section('content')
    <div class="container">
        <div class="buttons">
            <div class="button-filter active-button par" id="all">Все классы</div>
            @foreach ($pars as $par)
                <div class="button-filter par" id="{{$par}}-par">{{$par}} классы</div>
            @endforeach
        </div>
        @foreach ($groups as $group)
            @component("status.table", [
                "users" => $group["users"],
                "group" => $group["group"]
            ])
            @endcomponent
        @endforeach
    </div>
@endsection



@push("scripts")
    <script>
        @foreach ($pars as $par)
            $('#{{$par}}-par').on('click', function() {
                $('.one-group').hide();
                $('.{{$par}}-par').show();
                $('.par').removeClass("active-button");
                $('#all').removeClass("active-button");
                $(this).addClass("active-button");
            });
        @endforeach
        $('#all').on('click', function() {
            $('.one-group').show();
            $('.par').removeClass("active-button");
            $('#all').addClass("active-button");
        });
    </script>

    <script>
        $(".status-set-button").click(function() {
            let status = $(this).parent().find(".status-set-area").val();
            let user = $(this).attr("user-id");
            $.ajax({
                method: "POST",
                url: "/status/" + user + "/" + status
            });
        });
    </script>
@endpush
