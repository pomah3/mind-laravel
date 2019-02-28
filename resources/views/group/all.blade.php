@extends('layout.logined')

@section('title')
    {{ __('group.all.title') }}
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
            @component("group.table", [
                "users" => $group["users"],
                "balance" => $group["balance"],
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
@endpush
